<!-- END PAGE CONTENT -->

      <hr>

      <div class="footer">
        <div class="row hidden-phone">
            <div class="span4 align-left visible-desktop">
              <p>Baked with <span style="color:#79ad36">&hearts;</span> by <a href="https://jakejarvis.com" target="_blank">Scrabble</a>.&nbsp;&nbsp;&nbsp;<a href="https://github.com/jakejarvis/spoons/issues" target="_blank">Report an issue.</a></p>
            </div>
            <div class="span4 align-left visible-tablet">
              <p>Baked with <span style="color:#79ad36">&hearts;</span> by <a href="https://jakejarvis.com" target="_blank">Scrabble</a>.</p>
            </div>
            <div class="span4 align-center">
              <a href="https://jakejarvis.com" target="_blank"><img src="<?php echo $site_url ?>/assets/img/scrabble-40.jpg" alt="scrabble"></a>
            </div>
            <div class="span4 align-right">
              <p><a href="#">Back to top!</a></p>
            </div>
        </div>
        
        <div class="row visible-phone">
            <div class="span12 align-center">
              <p>Baked with <span style="color:#79ad36">&hearts;</span> by <a href="https://jakejarvis.com" target="_blank">Scrabble</a>.</p>
            </div>
            <div class="span12 align-center">
              <p><a href="https://jakejarvis.com" target="_blank"><img src="<?php echo $site_url ?>/assets/img/scrabble-40.jpg" alt="scrabble"></a></p>
            </div>
        </div>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-transition.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-tab.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-popover.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-button.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-collapse.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-carousel.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/bootstrap-typeahead.js"></script>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-1563964-34', 'scrabblerocks.com');
      ga('send', 'pageview');
    </script>

  </body>
</html>

<?php
  mysqli_close($conn);
?>