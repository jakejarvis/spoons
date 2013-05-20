<?php
$page = "SMS";
include('header.php');
?>

<style>
q:before, q:after, blockquote:before, blockquote:after {
  content: none !important;
}
blockquote {
  margin: 10px 0px 20px 0px;
}
</style>

<h3>How to use the SMS system</h3>

<p class="hidden-phone" style="color:#79ad36;font-size:70px;line-height:80px;text-align:center;">+1 (407) 4-SPOONS</p>
<p class="hidden-phone" style="color:#999999;font-size:50px;line-height:50px;text-align:center;margin-bottom:20px;">+1 (407) 477-6667</p>

<p class="visible-phone" style="color:#79ad36;font-size:35px;line-height:45px;text-align:center;margin-bottom:10px;font-weight:bold;">+1 (407) 477-6667</p>

<img src="<?php $site_url ?>/assets/img/sms-screenshot.jpg" class="hidden-phone" style="float:right;margin:20px 0px 20px 20px;">
<p style="margin:20px 0px;"><strong>To interact with the spooning management interface via SMS, use the following commands:</strong></p>

<ul>
  <li>
    <strong>Spoon:</strong> To eliminate a player, send <strong>Spoon <em>(name)</em></strong>.
    <blockquote>
      <strong>You:</strong> Spoon Annie P<br>
      <strong>Me:</strong> Annie Princeton has been spooned! Cajun's new target is Harry Bawls.
    </blockquote>
  </li>
  
  <li>
    <strong>Status:</strong> To check the status of a player, send <strong>Status <em>(name)</em></strong>.
    <blockquote>
      <strong>You:</strong> Status Annie<br>
      <strong>Me:</strong> There are multiple Annies in the system. Please specify last name or last initial.<br>
      <strong>You:</strong> Status Annie Princeton<br>
      <strong>Me:</strong> Annie Princeton has not been spooned. Annie's target is Snake and is targeted by Pierce Bawls.
    </blockquote>
  </li>
  
  <li>
    <strong>Remaining:</strong> To find the number of remaining players, send <strong>Remaining</strong>.
    <blockquote>
      <strong>You:</strong> Remaining<br>
      <strong>Me:</strong> There are 6 of 58 spooners remaining.
    </blockquote>
  </li>
  
  <li>
    <strong>Help:</strong> To get a list of commands on-the-go, just send <strong>Help</strong> (or any command not listed here).
  </li>
</ul>

<p style="margin:20px 0px;"><strong>Fun fact:</strong> Commands and names are <strong>NOT</strong> case-sensitive. You may attempt to use the spooner's first name only, and the system will inform you if you need to include the last initial. The trailing period is optional. <small>(aka: screw you, ROFL.)</small></p>

<p style="margin:20px 0px;text-align:center;"><img src="/assets/img/thatsallfolks.gif"></p>

<?php include('footer.php') ?>