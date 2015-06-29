<?php
include('config.php');
include('db_connect.php');
include('functions.php');

if($_POST) {
  $order = getHighestOrderNum() + 1;
  for($i = 0; $i < $_POST['num']; $i++) {
    if($_POST['first-' . $i] != "") {
      if(!$_POST['staff-' . $i]) $_POST['staff-' . $i] = 0;
      mysql_query('INSERT INTO spooners (first, last, order_num, staff) VALUES ("' . mysql_real_escape_string($_POST['first-' . $i]) . '", "' . mysql_real_escape_string($_POST['last-' . $i]) . '", ' . $order . ', ' . mysql_real_escape_string($_POST['staff-' . $i]) . ')') or die(mysql_error());
      $order++;
    }
  }
  header("Location:" . $site_url . "/");
} else if(!isset($_GET['num']) || $_GET['num'] <= 0) {
  header("Location:" . $site_url . "/");
}

$page = "Add Spooners";
include('header.php');

?>

<style>
  td, th {
    line-height: 30px !important;
    font-size: 17px;
    cursor: default !important;
  }
  
  button.btn, a.btn {
    font-size: 15px !important;
  }
  
  form {
    margin: 0px !important;
  }
  
  input[type="text"] {
    margin-bottom: 0px !important;
  }
</style>

<h4>Adding <?php echo $_GET['num'] ?> spooner<?php if($_GET['num'] > 1) echo 's' ?></h4>

<small><strong>Note:</strong> You do not have to fill every row, and you can always add more spooners later if you run out.</small>

<hr>

<form action="<?php echo $site_url ?>/add.php" method="POST">
  <input type="hidden" name="num" value="<?php echo $_GET['num'] ?>">
  <table class="table">
    <thead>
      <tr>
        <th class="span1"> </th>
        <th class="span3"><strong>Last name</strong></th>
        <th class="span3"><strong>First name (or nickname)</strong></th>
        <th class="span5"><strong>Staff?</strong>&nbsp;&nbsp;&nbsp;&nbsp;<small>(Last name optional if staff.)</small></th>
      </tr>
    </thead>
    <tbody>
<?php
  for($i = 0; $i < $_GET['num']; $i++) {
?>
      <tr>
        <td style="text-align:right;">
          <?php echo $i + 1; ?>.
        </td>
        <td>
          <input type="text" name="last-<?php echo $i ?>" placeholder="Last name">
        </td>
        <td>
          <input type="text" name="first-<?php echo $i ?>" placeholder="First name (or nickname)">
        </td>
        <td>
          <input type="checkbox" name="staff-<?php echo $i ?>" value="1" tabindex="-1">
        </td>
      </tr>
<?php } ?>
    </tbody>
  </table>
  
  <hr>
  
  <div class="align-right">
    <button type="submit" class="btn btn-large btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Do it!&nbsp;&nbsp;&raquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
  </div>
</form>


<?php include('footer.php') ?>