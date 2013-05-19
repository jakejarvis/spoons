<?php

function getNumTotalSpooners() {
  $result = mysql_query("SELECT id FROM spooners");
  return mysql_num_rows($result);
}

function getNumActiveSpooners() {
  $result = mysql_query("SELECT id FROM spooners WHERE spooned = 0");
  return mysql_num_rows($result);
}

function getLowestOrderNum() {
  $result = mysql_query("SELECT order_num FROM spooners WHERE spooned = 0 ORDER BY order_num ASC LIMIT 1");
  $spooner = mysql_fetch_array($result);
  return $spooner['order_num'];
}

function getHighestOrderNum() {
  $result = mysql_query("SELECT order_num FROM spooners WHERE spooned = 0 ORDER BY order_num DESC LIMIT 1");
  $spooner = mysql_fetch_array($result);
  return $spooner['order_num'];
}

function shuffleSpooners() {
  $random_array = range(0, getNumActiveSpooners() - 1);   // create array containing numbers 0 to # of spooners remaining - 1, inclusive
  
  shuffle($random_array);     // shuffle said array
  
  // update order of spooners based on array
  $result = mysql_query("SELECT id FROM spooners WHERE spooned = 0 ORDER BY id");
  
  $i = 0;
  while($spooner = mysql_fetch_array($result)) {
    mysql_query("UPDATE spooners SET order_num = " . $random_array[$i] . " WHERE id = " . $spooner['id']);
    $i++;
  }
}

function getIDByLooseName($subject) {
  $subject = trim($subject);
  $subject = strtolower($subject);
  $subject = str_replace(".", "", $subject);  // remove periods
  if(substr_count($subject, " ") == 0) {    // subject only contains one name
    $result = mysql_query('SELECT id FROM spooners WHERE LOWER(first) = "' . $subject . '"');
    if(mysql_num_rows($result) == 1) {
      $spooner = mysql_fetch_array($result);
      return $spooner['id'];   // MATCH!
    } else if(mysql_num_rows($result) > 1) {
      return "multiple";       // more than one found
    }
  } else if(substr_count($subject, " ") == 1) {       // one space, let's assume first space last
    $first = substr($subject, 0, strpos($subject, " "));
    $last = substr($subject, strpos($subject, " ") + 1);
    if(strlen($last) == 1) {   // last initial
      $result = mysql_query('SELECT id FROM spooners WHERE LOWER(first) = "' . $first . '" AND LOWER(SUBSTRING(last, 1, 1)) = "' . $last . '"');
      if(mysql_num_rows($result) > 0) {
        $spooner = mysql_fetch_array($result);
        return $spooner['id'];   // MATCH!
      }
    } else {    // full last name
      $result = mysql_query('SELECT id FROM spooners WHERE LOWER(first) = "' . $first . '" AND LOWER(last) = "' . $last . '"');
      if(mysql_num_rows($result) > 0) {
        $spooner = mysql_fetch_array($result);
        return $spooner['id'];   // MATCH!
      }
    }
  }
  
  return "none";
}

function getNameByID($id) {
  if($id) {
    $result = mysql_query("SELECT first, last FROM spooners WHERE id = " . $id) or die(mysql_error());
    if(mysql_num_rows($result) == 1) {
      $spooner = mysql_fetch_array($result);
      $name = $spooner['first'];
      if($spooner['last']) $name .= ' ' . $spooner['last'];
      return $name;
    } else {
      return NULL;
    }
  }
}

function getFirstNameByID($id) {
  $result = mysql_query("SELECT first FROM spooners WHERE id = " . $id);
  $spooner = mysql_fetch_array($result);
  return $spooner['first'];
}

function getTargetByID($id) {
  $result = mysql_query("SELECT order_num FROM spooners WHERE id = " . $id);
  $spooner = mysql_fetch_array($result);
  if($spooner['order_num'] == getHighestOrderNum()) {    // if last person in the list
    $result2 = mysql_query("SELECT id FROM spooners WHERE spooned = 0 AND order_num = " . getLowestOrderNum());
    $spooner2 = mysql_fetch_array($result2);
    return $spooner2['id'];
  } else {
    $result2 = mysql_query("SELECT id FROM spooners WHERE spooned = 0 AND order_num > " . $spooner['order_num'] . " ORDER BY order_num ASC LIMIT 1");
    $spooner2 = mysql_fetch_array($result2);
    return $spooner2['id'];
  }
}

function getReverseTargetByID($id) {    // aka get the person above the passed in person
  $result = mysql_query("SELECT order_num FROM spooners WHERE id = " . $id);
  $spooner = mysql_fetch_array($result);
  if($spooner['order_num'] == getLowestOrderNum()) {    // if first person in the list
    $result2 = mysql_query("SELECT id FROM spooners WHERE spooned = 0 AND order_num = " . getHighestOrderNum());
    $spooner2 = mysql_fetch_array($result2);
    return $spooner2['id'];
  } else {
    $result2 = mysql_query("SELECT id FROM spooners WHERE spooned = 0 AND order_num < " . $spooner['order_num'] . " ORDER BY order_num DESC LIMIT 1");
    $spooner2 = mysql_fetch_array($result2);
    return $spooner2['id'];
  }
}

function checkSpoonedByID($id) {
  $result = mysql_query("SELECT spooned FROM spooners WHERE id = " . $id);
  $spooner = mysql_fetch_array($result);
  return $spooner['spooned'];
}

function spoonByID($id) {
  mysql_query('SET time_zone = "' . $timezone_number . '"');
  mysql_query("UPDATE spooners SET spooned_by = " . getReverseTargetByID($id) . ", time_spooned = NOW(), spooned = 1, order_num = -1 WHERE id = " . $id);
}

function reviveByID($id) {
  mysql_query("UPDATE spooners SET spooned = 0, order_num = " . (getHighestOrderNum() + 1) . " WHERE id = " . $id);
}

function getSpoonedByIDByID($id) {
  $result = mysql_query("SELECT spooned_by FROM spooners WHERE id = " . $id);
  $spooner = mysql_fetch_array($result);
  return $spooner['spooned_by'];
}

function getTimeSpoonedByID($id) {
  $result = mysql_query("SELECT time_spooned FROM spooners WHERE id = " . $id);
  $spooner = mysql_fetch_array($result);
  return $spooner['time_spooned'];
}

?>