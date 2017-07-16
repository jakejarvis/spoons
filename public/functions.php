<?php

function logSMS($message, $response, $number, $conn) {
  mysqli_query($conn, 'INSERT INTO texts (message, response, phone_number) VALUES ("' . mysqli_real_escape_string($conn, $message) . '", "' . mysqli_real_escape_string($conn, $response) . '", "' . mysqli_real_escape_string($conn, $number) . '")');
}

function getNumTotalSpooners($conn) {
  $result = mysqli_query($conn, "SELECT id FROM spooners");
  return mysqli_num_rows($result);
}

function getNumActiveSpooners($conn) {
  $result = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0");
  return mysqli_num_rows($result);
}

function getNumActiveCamperSpooners($conn) {
  $result = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 AND staff = 0");
  return mysqli_num_rows($result);
}

function getNumActiveStaffSpooners($conn) {
  $result = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 AND staff = 1");
  return mysqli_num_rows($result);
}

function getLowestOrderNum($conn) {
  $result = mysqli_query($conn, "SELECT order_num FROM spooners WHERE spooned = 0 ORDER BY order_num ASC LIMIT 1");
  $spooner = mysqli_fetch_array($result);
  return $spooner['order_num'];
}

function getHighestOrderNum($conn) {
  $result = mysqli_query($conn, "SELECT order_num FROM spooners WHERE spooned = 0 ORDER BY order_num DESC LIMIT 1");
  $spooner = mysqli_fetch_array($result);
  return $spooner['order_num'];
}

function getCamperIDs($conn){
  $camper_ids = array();

  $result = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 AND staff = 0 ORDER BY id");
  while($spooner = mysqli_fetch_array($result)) {
    array_push($camper_ids, $spooner['id']);
  }
  return $camper_ids;
}

function getStaffIDs($conn){
  $staff_ids = array();

  $result = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 AND staff = 1 ORDER BY id");
  while($spooner = mysqli_fetch_array($result)) {
    array_push($staff_ids, $spooner['id']);
  }
  return $staff_ids;
}

function shuffleSpooners($conn) {
  $camper_ids = getCamperIDs($conn);
  $staff_ids = getStaffIDs($conn);

  shuffle($camper_ids);
  shuffle($staff_ids);

  //An array to put the ids for the new shuffled list
  $random_ids = array();

  //Determine the number of campers between each staff
  $spacing = round(count($camper_ids)/count($staff_ids))+1;


  while(count($random_ids) < getNumActiveSpooners($conn)){
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


  $result = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 ORDER BY id");

  for ($i=0; $spooner = mysqli_fetch_array($result); $i++) { 
    mysqli_query($conn, "UPDATE spooners SET order_num = " . $i . " WHERE id = " . $random_ids[$i]);
  }
}

function getIDByLooseName($subject, $conn) {
  $subject = trim($subject);
  $subject = strtolower($subject);
  $subject = str_replace(".", "", $subject);  // remove periods
  
  // subject only contains one word
  if(substr_count($subject, " ") == 0) {    
    $result = mysqli_query($conn, 'SELECT id FROM spooners WHERE LOWER(first) = "' . $subject . '"');
    if(mysqli_num_rows($result) == 1) {
      $spooner = mysqli_fetch_array($result);
      return $spooner['id'];   // MATCH!
    } else if(mysqli_num_rows($result) > 1) {
      return "multiple";       // more than one found
    }
  } else if(substr_count($subject, " ") == 1) {       // one space, let's assume first space last
    $first = substr($subject, 0, strpos($subject, " "));
    $last = substr($subject, strpos($subject, " ") + 1);
    if(strlen($last) == 1) {   // last initial
      $result = mysqli_query($conn, 'SELECT id FROM spooners WHERE LOWER(first) = "' . $first . '" AND LOWER(SUBSTRING(last, 1, 1)) = "' . $last . '"');
      if(mysqli_num_rows($result) > 0) {
        $spooner = mysqli_fetch_array($result);
        return $spooner['id'];   // MATCH!
      }
    } else {    // full last name
      $result = mysqli_query($conn, 'SELECT id FROM spooners WHERE LOWER(first) = "' . $first . '" AND LOWER(last) = "' . $last . '"');
      if(mysqli_num_rows($result) > 0) {
        $spooner = mysqli_fetch_array($result);
        return $spooner['id'];   // MATCH!
      }
    }
    
    // still not found, take whole subject and compare to concatenated first + last in database
    $result = mysqli_query($conn, 'SELECT id FROM spooners WHERE LOWER(CONCAT_WS(" ", first, last)) = "' . $subject . '"');
    if(mysqli_num_rows($result) > 0) {
      $spooner = mysqli_fetch_array($result);
      return $spooner['id'];
    }
  }
  
  return "none";
}

function getNameByID($id, $conn) {
  if($id) {
    $result = mysqli_query($conn, "SELECT first, last FROM spooners WHERE id = " . $id) or die(mysqli_error());
    if(mysqli_num_rows($result) == 1) {
      $spooner = mysqli_fetch_array($result);
      $name = $spooner['first'];
      if($spooner['last']) $name .= ' ' . $spooner['last'];
      return $name;
    } else {
      return NULL;
    }
  }
}

function getFirstNameByID($id, $conn) {
  $result = mysqli_query($conn, "SELECT first FROM spooners WHERE id = " . $id);
  $spooner = mysqli_fetch_array($result);
  return $spooner['first'];
}

function getTargetByID($id, $conn) {
  $result = mysqli_query($conn, "SELECT order_num FROM spooners WHERE id = " . $id);
  $spooner = mysqli_fetch_array($result);
  if($spooner['order_num'] == getHighestOrderNum($conn)) {    // if last person in the list
    $result2 = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 AND order_num = " . getLowestOrderNum($conn));
    $spooner2 = mysqli_fetch_array($result2);
    return $spooner2['id'];
  } else {
    $result2 = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 AND order_num > " . $spooner['order_num'] . " ORDER BY order_num ASC LIMIT 1");
    $spooner2 = mysqli_fetch_array($result2);
    return $spooner2['id'];
  }
}

function getReverseTargetByID($id, $conn) {    // aka get the person above the passed in person
  $result = mysqli_query($conn, "SELECT order_num FROM spooners WHERE id = " . $id);
  $spooner = mysqli_fetch_array($result);
  if($spooner['order_num'] == getLowestOrderNum($conn)) {    // if first person in the list
    $result2 = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 AND order_num = " . getHighestOrderNum($conn));
    $spooner2 = mysqli_fetch_array($result2);
    return $spooner2['id'];
  } else {
    $result2 = mysqli_query($conn, "SELECT id FROM spooners WHERE spooned = 0 AND order_num < " . $spooner['order_num'] . " ORDER BY order_num DESC LIMIT 1");
    $spooner2 = mysqli_fetch_array($result2);
    return $spooner2['id'];
  }
}

function checkSpoonedByID($id, $conn) {
  $result = mysqli_query($conn, "SELECT spooned FROM spooners WHERE id = " . $id);
  $spooner = mysqli_fetch_array($result);
  return $spooner['spooned'];
}

function spoonByID($id, $conn) {
  mysqli_query($conn, 'SET time_zone = "' . $timezone_number . '"');
  mysqli_query($conn, "UPDATE spooners SET spooned_by = " . getReverseTargetByID($id, $conn) . ", time_spooned = NOW(), spooned = 1, order_num = -1 WHERE id = " . $id);
}

function reviveByID($id, $conn) {
  mysqli_query($conn, "UPDATE spooners SET spooned = 0, order_num = " . (getHighestOrderNum($conn) + 1) . " WHERE id = " . $id);
}

function getSpoonedByIDByID($id, $conn) {
  $result = mysqli_query($conn, "SELECT spooned_by FROM spooners WHERE id = " . $id);
  $spooner = mysqli_fetch_array($result);
  return $spooner['spooned_by'];
}

function getTimeSpoonedByID($id, $conn) {
  $result = mysqli_query($conn, "SELECT time_spooned FROM spooners WHERE id = " . $id);
  $spooner = mysqli_fetch_array($result);
  return $spooner['time_spooned'];
}

?>