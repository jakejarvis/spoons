<?php
include('init.php');

// needs to be at top so we can redirect to prevent double-shuffling or double-clearing
if(isset($_GET['shuffle']) && isset($_GET['confirmed'])) {
  shuffleSpooners();
  header("Location:" . $site_url . "/shuffle/done");
} else if(isset($_GET['clear']) && isset($_GET['confirmed'])) {
  mysql_query("TRUNCATE spooners");
  header("Location:" . $site_url . "/clear/done");
}

$page = "Home";
include('header.php');

?>

<style>
  table {
    width: 100%;
  }

  td, th {
    line-height: 30px !important;
    font-size: 17px;
    white-space: nowrap;
    overflow: hidden;
  }
  
  button.btn, a.btn {
    font-size: 15px !important;
  }
  
  td a.btn {
    padding: 4px 0px !important;
    font-weight: normal;
    width: 110px;
  }
  td.drag {
    cursor: pointer;
  }
  
  td.align-center, th.align-center {
    text-align: center !important;
  }
  
  div.row div.span2 a {
    padding: 4px 25px !important;
    width: 75px !important;
    height: 21px !important;
    text-align: center;
    font-weight: normal;
  }
  div.row div.span2 a i, td a img, td a i {
    vertical-align: text-top;
    margin:2px 4px 0px -8px;
  }
  
  form {
    margin: 0px !important;
  }
  
  div.alert {
    font-size:14px;
    padding-top:20px;
    padding-bottom:20px;
  }
  div.alert a, div.alert strong {
    color: #c09853;
  }
  div.alert-error a, div.alert-error strong {
    color: #b94a48;
  }
  div.alert a.btn {
    color: #333;
    padding: 4px 20px !important;
  }
  div.alert a.btn-success {
    color: #fff;
  }
  div.alert a.btn i {
    margin:2px 4px 0px -8px;
  }
  div.alert p {
    margin: 10px 0px;
  }
@media (max-width: 767px) {
  td,tr .visible-phone {
    display: table-cell !important;
    line-height: 20px !important;
  }
}
</style>

<?php

/*********** SPOONING **********/
if(isset($_GET['spoon'])) {
  spoonByID($_GET['spoon']);
?>
<div class="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><strong><?php echo getNameByID($_GET['spoon']) ?></strong> has been spooned! <?php echo getNameByID(getSpoonedByIDByID($_GET['spoon'])) ?></strong>'s new target is <?php echo getNameByID(getTargetByID(getSpoonedByIDByID($_GET['spoon']))) ?>.</h4>
</div>
<?php
}

if(isset($_GET['revive'])) {
  reviveByID($_GET['revive']);
?>
<div class="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><strong><?php echo getNameByID($_GET['revive']) ?></strong> has been revived, but note that he or she has been added to the end of the list.</h4>
  <p>It's recommended to drag the revived spooner below a staff member so that you don't have to tell a camper that his or her target has changed for no reason.</p>
</div>
<?php 
}


/*********** SHUFFLING **********/
if(isset($_GET['shuffle']) && !isset($_GET['confirmed']) && !isset($_GET['done'])) { ?>
<div class="alert alert-error">
  <a type="button" class="close" data-dismiss="alert">&times;</a>
  <h4>Are you sure you wanna do that...?</h4>
  <p>Shuffling is permanent, and your head <strong>will</strong> roll if you do this at the wrong time. You might wanna <a href="<?php echo $site_url ?>/print.pdf">save a PDF</a> of the current order first.</p>
  <a href="<?php echo $site_url ?>/shuffle/confirmed" class="btn btn-success"><i class="icon-ok icon-white"></i> Yes, I'm positive.</a>
  <a href="<?php echo $site_url ?>/" class="btn" style="margin-left:16px;"><i class="icon-remove"></i> No, please forgive me!</a>
</div>
<?php } else if(isset($_GET['shuffle']) && isset($_GET['done'])) { ?>
<div class="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Spooners have been successfully shuffled.</h4>
</div>
<?php } ?>

<?php
/*********** CLEARING ALL **********/
if(isset($_GET['clear']) && !isset($_GET['confirmed']) && !isset($_GET['done'])) { ?>
<div class="alert alert-error">
  <a type="button" class="close" data-dismiss="alert">&times;</a>
  <h4>Are you sure you wanna do that...?</h4>
  <p>Clearing the list is permanent, and your head <strong>will</strong> roll if you do this at the wrong time. You might wanna <a href="<?php echo $site_url ?>/print.pdf">save a PDF</a> of the current list first.</p>
  <a href="<?php echo $site_url ?>/clear/confirmed" class="btn btn-success"><i class="icon-ok icon-white"></i> Yes, I'm positive.</a>
  <a href="<?php echo $site_url ?>/" class="btn" style="margin-left:16px;"><i class="icon-remove"></i> No, please forgive me!</a>
</div>
<?php } else if(isset($_GET['clear']) && isset($_GET['done'])) { ?>
<div class="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>All spooners have been successfully deleted.</h4>
</div>
<?php } ?>

<div class="row" style="padding:16px 0px;">
  <div class="span6" style="font-size:16px;line-height:30px;">
    <form action="<?php echo $site_url ?>/add" method="GET">I want to add <input type="text" name="num" style="width:40px;margin:0px 4px;"> spooners. <button type="submit" class="btn btn-success" style="padding:4px 10px !important;margin:0px 8px;">&nbsp;&nbsp;Leggo!&nbsp;&nbsp;&raquo;&nbsp;&nbsp;</button></form>
  </div>
  <div class="span2 visible-desktop">
    <a href="<?php echo $site_url ?>/print.pdf" target="_blank" class="btn btn-primary"><i class="icon-print icon-white"></i> Print</a>
  </div>
  <div class="span2 visible-desktop">
    <a href="<?php echo $site_url ?>/shuffle" class="btn btn-warning"><i class="icon-random icon-white"></i> Shuffle</a>
  </div>
  <div class="span2 visible-desktop">
    <a href="<?php echo $site_url ?>/clear" class="btn btn-danger"><i class="icon-remove-circle icon-white"></i> Clear All</a>
  </div>
</div>

<hr>

<script>
$(document).ready(function() {
  // Return a helper with preserved width of cells
  var fixHelper = function(e, ui) {
  	ui.children().each(function() {
  		$(this).width($(this).width());
  	});
  	return ui;
  };

  $(".table-active tbody").sortable({
  	helper: fixHelper,
  	handle: ".drag",
  	update: function(event, ui) {
                var newOrder = $(this).sortable('toArray').toString();
                $.post('sort_save.php', {order:newOrder});
            }
  }).disableSelection();
});
</script>

<?php
$result = mysql_query("SELECT id, first, last, staff FROM spooners WHERE spooned = 0 ORDER BY order_num") or die(mysql_error());
?>

<h4>Active Spooners (<?php echo mysql_num_rows($result) ?>)</h4>

<?php if(mysql_num_rows($result) > 0) { ?>
<table class="table table-active">
  <thead>
    <tr class="row">
      <th class="span2"> </th>
      <th class="span3"><strong>First name</strong></th>
      <th class="span6"><strong>Last name</strong></th>
      <th class="span1 align-center"><small>Sort</small></th>
    </tr>
  </thead>
  <tbody>
<?php
  while($spooner = mysql_fetch_array($result)) {
    echo '    <tr id="' . $spooner['id'] . '" class="row';
    if($spooner['staff']) echo ' success'; // highlight staff with green row
    echo '">
        <td class="align-center"><a href="' . $site_url . '/spoon/' . $spooner['id'] . '" class="btn btn-danger hidden-phone"><img src="' . $site_url . '/assets/img/spoon-white-14px.png"> Spoon</a><a href="' . $site_url . '/spoon/' . $spooner['id'] . '" class="btn btn-danger visible-phone" style="padding:4px !important; width:40px !important;"><img src="' . $site_url . '/assets/img/spoon-white-14px.png" style="margin:2px 0px !important;"></a></td>
        <td>' . $spooner['first'] . '</td>
        <td>' . $spooner['last'] . '</td>
        <td class="drag align-center"><i class="icon-list"></i></td>
      <!--  <td><small>Targeting ' . getNameByID(getTargetByID($spooner['id'])) . ', targeted by ' . getNameByID(getReverseTargetByID($spooner['id'])) . '</small></td>  -->
      </tr>
  ';
  }
?>
  </tbody>
</table>
<?php } else { ?>
  <h2 style="margin:25px 0px;color:#ccc;text-align:center;">Nothing to see here!</h2>
<?php } ?>

<hr>

<?php
$result = mysql_query("SELECT id, first, last, staff, spooned_by, time_spooned FROM spooners WHERE spooned = 1 ORDER BY time_spooned DESC") or die(mysql_error());
?>

<h4>Dead Spooners (<?php echo mysql_num_rows($result) ?>)</h4>

<?php if(mysql_num_rows($result) > 0) { ?>
<table class="table table-inactive">
  <thead>
    <tr class="row">
      <th class="span2"> </th>
      <th class="span3"><strong>Name</strong></th>
      <th class="span7"><strong>Details</strong></th>
      <th class="span1 visible-phone"> </th>
    </tr>
  </thead>
  <tbody>
<?php
  while($spooner = mysql_fetch_array($result)) {
    echo '        <tr id="' . $spooner['id'] . '" class="row';
    if($spooner['staff']) echo ' success'; // highlight staff with green row
    echo '">
        <td class="align-center" style="min-width:40px;"><a href="' . $site_url . '/revive/' . $spooner['id'] . '" class="btn hidden-phone" type="submit"><i class="icon-arrow-up"></i> Revive</a><a href="' . $site_url . '/revive/' . $spooner['id'] . '" class="btn visible-phone" style="padding-left:10px !important; width:40px !important;">  <i class="icon-arrow-up"></i></a></td>
        <td>' . $spooner['first'] . ' ' . $spooner['last'] . '</td>
        <td class="hidden-phone"><small>Spooned by <strong>' . getNameByID($spooner['spooned_by']) . '</strong> on <strong>' . date('l', strtotime($spooner['time_spooned'])) . '</strong> at <strong>' . date('g:i A', strtotime($spooner['time_spooned'])) . '</strong>.</small></td>
        <td class="visible-phone"><small>Spooned by <strong>' . getNameByID($spooner['spooned_by']) . '</strong></br> on <strong>' . date('l', strtotime($spooner['time_spooned'])) . '</strong> at <strong>' . date('g:i A', strtotime($spooner['time_spooned'])) . '</strong>.</small></td>

      </tr>
  ';
  }
?>
  </tbody>
</table>
<?php } else { ?>
  <h2 style="margin:25px 0px;color:#ccc;text-align:center;">Nothing to see here!</h2>
<?php } ?>

<?php include('footer.php') ?>