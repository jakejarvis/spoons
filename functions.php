<?php

function logSMS($message, $response, $number) {
  mysql_query('INSERT INTO texts (message, response, phone_number) VALUES ("' . mysql_real_escape_string($message) . '", "' . mysql_real_escape_string($response) . '", "' . mysql_real_escape_string($number) . '")');
}

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

function getCamperIDs(){
  $camper_ids = array();

  $result = mysql_query("SELECT id FROM spooners WHERE spooned = 0 AND staff = 0 ORDER BY id");
  while($spooner = mysql_fetch_array($result)) {
    array_push($camper_ids, $spooner['id']);
  }
  return $camper_ids;
}

function getStaffIDs(){
  $staff_ids = array();

  $result = mysql_query("SELECT id FROM spooners WHERE spooned = 0 AND staff = 1 ORDER BY id");
  while($spooner = mysql_fetch_array($result)) {
    array_push($staff_ids, $spooner['id']);
  }
  return $staff_ids;
}

function shuffleSpooners() {
  $camper_ids = getCamperIDs();
  $staff_ids = getStaffIDs();

  shuffle($camper_ids);
  shuffle($staff_ids);

  //An array to put the ids for the new shuffled list
  $random_ids = array();

  //Determine the number of campers between each staff
  $spacing = round(count($camper_ids)/count($staff_ids))+1;


  while(count($random_ids) < getNumActiveSpooners()){
    echo "oh no";
    for($i = 0; $i < $spacing-1; $i++){
      array_push($random_ids, array_pop($camper_ids));
    }
    array_push($random_ids, array_pop($staff_ids));

    //This shouldn't happen but it is here just in case
    if(count($staff_ids) == 0){
      while(count($camper_ids) > 0){
        array_push($random_ids, array_pop($camper_ids));
      }
    }
    else{
        //Recalculate the spacing each round to end up with a more even spacing over the entire list.
        $spacing = round(count($camper_ids)/count($staff_ids))+1;
    }
  }


  $result = mysql_query("SELECT id FROM spooners WHERE spooned = 0 ORDER BY id");

  for ($i=0; $spooner = mysql_fetch_array($result); $i++) { 
    mysql_query("UPDATE spooners SET order_num = " . $i . " WHERE id = " . $random_ids[$i]);
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