<?php
include('config.php');

session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == FALSE) {
  header("Location:" . $site_url . "/login");
  die();
}

include('db_connect.php');

$result = mysql_query("SELECT first, last FROM spooners WHERE spooned = 0 ORDER BY order_num") or die(mysql_error());

$i = 0;
while($spooner = mysql_fetch_array($result)) {
  $spooners[$i]['name'] = $spooner['first'];
  if($spooner['last']) $spooners[$i]['name'] .= " " . $spooner['last'];
  
  $i++;
}

/* alphabetize by contestant to make sunday night easier */
for ($i = 0; $i < count($spooners); $i++) {
  if ($i == count($spooners) - 1)
    $spooners_2d[$spooners[$i]['name']] = $spooners[0]['name'];
  else
    $spooners_2d[$spooners[$i]['name']] = $spooners[$i + 1]['name'];
}

uksort($spooners_2d, "strnatcasecmp");

$html = '
<style type="text/css">
  div#container, div#container table {
    font-family: sans-serif;
    font-size: 16px;
    line-height: 28px;
    text-align: center;
  }
  div#container h2 {
    font-size: 24px;
    line-height: 24px;
    margin: 0px;
  }
  div#container p {
    margin: 6px 0px;
  }
  div#container table {
    width: 80%;
    border: 3px solid black;
    border-collapse: collapse;
    margin: 0px auto;
  }
  div#container th {
    width:50%;
    padding: 5px 10px;
    text-align: center;
    background: #aaa;
    border: 3px solid black;
  }
  div#container td {
    padding: 8px 25px;
    border: 3px solid black;
    text-align: left;
  }
</style>

<div id="container">
  <h2>Printable Spoons List</h2>
  <p><small><em>Generated on ' . date('l, F jS, Y \a\t g:i A') . '.</em></small></p>
  <table>
    <thead>
      <tr>
        <th>Contestant</th>
        <th>Target</th>
      </tr>
    </thead>
    <tbody>';


    foreach ($spooners_2d as $contestant => $target) {
      $html .= '<tr><td class="contestant">' . $contestant . '</td><td class="target">' . $target . '</td></tr>';
    }

$html .= '</tbody>
</table>
</div>';

include("mpdf/mpdf.php");

$mpdf = new mPDF('c');

$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

?>