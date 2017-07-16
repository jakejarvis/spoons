<?php
include('config.php');
include('functions.php');
include('db_connect.php');

header("content-type: text/xml");

$text = $_REQUEST['Body'];
//$text = "Spoon caJun.";

$text = str_replace("?", "", $text);    // ignore question marks
$text = trim($text);

if(strpos($text, " ") !== false)
  $command = substr($text, 0, strpos($text, " "));
else
  $command = $text;

if(strlen($text) > strlen($command)) {
  $subject = substr($text, strlen($command) + 1);
  $subject_id = getIDByLooseName($subject, $conn);
}

$help = 'List of commands:' . "\n" . '"Spoon (name)" to spoon.' . "\n" . '"Status (name)" to check.' . "\n" . '"Remaining" for number of alive spooners.';

if($subject && $subject_id == "multiple") {
  $response = "There are multiple " . $subject . "s in the system. Please specify last name or last initial.";
} else if($subject && $subject_id == "none") {
  $response = "There were no spooners by the name " . $subject . " found in the system. Sorry (but not really).";
} else if($subject && strcasecmp($command, "spoon") == 0) {
  spoonByID($subject_id, $conn);
  $response = getNameByID($subject_id, $conn) . ' has been spooned! ' . getNameByID(getSpoonedByIDByID($subject_id, $conn), $conn) . '\'s new target is ' . getNameByID(getTargetByID(getSpoonedByIDByID($subject_id, $conn), $conn), $conn) . '.';
} else if($subject && strcasecmp($command, "status") == 0) {
  if(checkSpoonedByID($subject_id, $conn)) {
    $response = getNameByID($subject_id, $conn) . ' was spooned by ' . getNameByID(getSpoonedByIDByID($subject_id, $conn), $conn) . ' on ' . date('l', strtotime(getTimeSpoonedByID($subject_id, $conn))) . ' at ' . date('g:i A', strtotime(getTimeSpoonedByID($subject_id, $conn))) . '.';
  } else {
    $response = getNameByID($subject_id, $conn) . ' has not been spooned. ' . getFirstNameByID($subject_id, $conn) . '\'s target is ' . getNameByID(getTargetByID($subject_id, $conn), $conn) . ' and is targeted by ' . getNameByID(getReverseTargetByID($subject_id, $conn), $conn) . '.';
  }
} else if(strcasecmp($command, "remaining") == 0) {
  $response = "There are " . getNumActiveSpooners($conn) . " of " . getNumTotalSpooners($conn) . " spooners remaining. (" . getNumActiveCamperSpooners($conn) . " campers, " . getNumActiveStaffSpooners($conn) . " staff)";
} else if(strcasecmp($command, "commands") == 0 || strcasecmp($command, "command") == 0) {
  $response = $help;
} else {
  $response = "Invalid command. " . $help;
}

logSMS($_REQUEST['Body'], $response, $_REQUEST['From'], $conn);

mysqli_close($conn);

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<Response>
  <Sms><?php echo $response ?></Sms>
</Response>