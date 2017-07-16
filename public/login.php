<?php
include('config.php');

session_start();

if($_SESSION['logged_in']) {
  header("Location:" . $site_url . "/");
  die();
}

if(isset($_POST['password'])) {
  if($_POST['password'] == $site_password) {
    $_SESSION['logged_in'] = TRUE;
    header("Location:" . $site_url . "/");
    die();
  } else {
    $failure = TRUE;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <title>Sign in &middot; Spoons</title>

    <!--
     _   _                                                             _           
    | \ | |                                                           (_)          
    |  \| | _____   _____ _ __    __ _  ___  _ __  _ __   __ _    __ _ ___   _____ 
    | . ` |/ _ \ \ / / _ \ '__|  / _` |/ _ \| '_ \| '_ \ / _` |  / _` | \ \ / / _ \
    | |\  |  __/\ V /  __/ |    | (_| | (_) | | | | | | | (_| | | (_| | |\ V /  __/
    \_| \_/\___| \_/ \___|_|     \__, |\___/|_| |_|_| |_|\__,_|  \__, |_| \_/ \___|
                                  __/ |                           __/ |            
                                 |___/                           |___/             
                                         _   _                     
                                        | \ | |                    
     _   _  ___  _   _   _   _ _ __     |  \| | _____   _____ _ __ 
    | | | |/ _ \| | | | | | | | '_ \    | . ` |/ _ \ \ / / _ \ '__|
    | |_| | (_) | |_| | | |_| | |_) |   | |\  |  __/\ V /  __/ |   
     \__, |\___/ \__,_|  \__,_| .__( )  \_| \_/\___| \_/ \___|_|   
      __/ |                   | |  |/                              
     |___/                    |_|                                  
                                     _      _                       
                                    | |    | |                      
      __ _  ___  _ __  _ __   __ _  | | ___| |_   _   _  ___  _   _ 
     / _` |/ _ \| '_ \| '_ \ / _` | | |/ _ \ __| | | | |/ _ \| | | |
    | (_| | (_) | | | | | | | (_| | | |  __/ |_  | |_| | (_) | |_| |
     \__, |\___/|_| |_|_| |_|\__,_| |_|\___|\__|  \__, |\___/ \__,_|
      __/ |                                        __/ |            
     |___/                                        |___/             
         _                        _   _                     
        | |                      | \ | |                    
      __| | _____      ___ __    |  \| | _____   _____ _ __ 
     / _` |/ _ \ \ /\ / / '_ \   | . ` |/ _ \ \ / / _ \ '__|
    | (_| | (_) \ V  V /| | | |  | |\  |  __/\ V /  __/ |   
     \__,_|\___/ \_/\_/ |_| |_|  \_| \_/\___| \_/ \___|_|   



      __ _  ___  _ __  _ __   __ _   _ __ _   _ _ __  
     / _` |/ _ \| '_ \| '_ \ / _` | | '__| | | | '_ \ 
    | (_| | (_) | | | | | | | (_| | | |  | |_| | | | |
     \__, |\___/|_| |_|_| |_|\__,_| |_|   \__,_|_| |_|
      __/ |                                           
     |___/                                            
                                     _                   _ 
                                    | |                 | |
      __ _ _ __ ___  _   _ _ __   __| |   __ _ _ __   __| |
     / _` | '__/ _ \| | | | '_ \ / _` |  / _` | '_ \ / _` |
    | (_| | | | (_) | |_| | | | | (_| | | (_| | | | | (_| |
     \__,_|_|  \___/ \__,_|_| |_|\__,_|  \__,_|_| |_|\__,_|


         _                     _                       
        | |                   | |                      
      __| | ___  ___  ___ _ __| |_   _   _  ___  _   _ 
     / _` |/ _ \/ __|/ _ \ '__| __| | | | |/ _ \| | | |
    | (_| |  __/\__ \  __/ |  | |_  | |_| | (_) | |_| |
     \__,_|\___||___/\___|_|   \__|  \__, |\___/ \__,_|
                                      __/ |            
                                     |___/             
     _   _                                                     
    | \ | |                                                    
    |  \| | _____   _____ _ __    __ _  ___  _ __  _ __   __ _ 
    | . ` |/ _ \ \ / / _ \ '__|  / _` |/ _ \| '_ \| '_ \ / _` |
    | |\  |  __/\ V /  __/ |    | (_| | (_) | | | | | | | (_| |
    \_| \_/\___| \_/ \___|_|     \__, |\___/|_| |_|_| |_|\__,_|
                                  __/ |                        
                                 |___/                         
                     _                                                
                    | |                                               
     _ __ ___   __ _| | _____   _   _  ___  _   _    ___ _ __ _   _   
    | '_ ` _ \ / _` | |/ / _ \ | | | |/ _ \| | | |  / __| '__| | | |  
    | | | | | | (_| |   <  __/ | |_| | (_) | |_| | | (__| |  | |_| |_ 
    |_| |_| |_|\__,_|_|\_\___|  \__, |\___/ \__,_|  \___|_|   \__, ( )
                                 __/ |                         __/ |/ 
                                |___/                         |___/   
     _   _                                                                       
    | \ | |                                                                      
    |  \| | _____   _____ _ __    __ _  ___  _ __  _ __   __ _   ___  __ _ _   _ 
    | . ` |/ _ \ \ / / _ \ '__|  / _` |/ _ \| '_ \| '_ \ / _` | / __|/ _` | | | |
    | |\  |  __/\ V /  __/ |    | (_| | (_) | | | | | | | (_| | \__ \ (_| | |_| |
    \_| \_/\___| \_/ \___|_|     \__, |\___/|_| |_|_| |_|\__,_| |___/\__,_|\__, |
                                  __/ |                                     __/ |
                                 |___/                                     |___/ 
                           _ _                   _   _                     
                          | | |                 | \ | |                    
      __ _  ___   ___   __| | |__  _   _  ___   |  \| | _____   _____ _ __ 
     / _` |/ _ \ / _ \ / _` | '_ \| | | |/ _ \  | . ` |/ _ \ \ / / _ \ '__|
    | (_| | (_) | (_) | (_| | |_) | |_| |  __/  | |\  |  __/\ V /  __/ |   
     \__, |\___/ \___/ \__,_|_.__/ \__, |\___|  \_| \_/\___| \_/ \___|_|   
      __/ |                         __/ |                                  
     |___/                         |___/                                   
                                     _       _ _           _ _      
                                    | |     | | |         | (_)     
      __ _  ___  _ __  _ __   __ _  | |_ ___| | |   __ _  | |_  ___ 
     / _` |/ _ \| '_ \| '_ \ / _` | | __/ _ \ | |  / _` | | | |/ _ \
    | (_| | (_) | | | | | | | (_| | | ||  __/ | | | (_| | | | |  __/
     \__, |\___/|_| |_|_| |_|\__,_|  \__\___|_|_|  \__,_| |_|_|\___|
      __/ |                                                         
     |___/                                                          
                     _   _                _                       
                    | | | |              | |                      
      __ _ _ __   __| | | |__  _   _ _ __| |_   _   _  ___  _   _ 
     / _` | '_ \ / _` | | '_ \| | | | '__| __| | | | |/ _ \| | | |
    | (_| | | | | (_| | | | | | |_| | |  | |_  | |_| | (_) | |_| |
     \__,_|_| |_|\__,_| |_| |_|\__,_|_|   \__|  \__, |\___/ \__,_|
                                                 __/ |            
                                                |___/     
    -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> <!-- Disable mobile pinch zoom -->

    <!-- Le styles -->
    <link href="<?php echo $site_url ?>/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px !important;
        padding-bottom: 40px !important;
        background-color: #f5f5f5;
        /* disable text highlight */
        -moz-user-select: none;
        -webkit-user-select: none;
        cursor:default;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      .form-signin button {
        padding: 11px 0px;
        width: 100%;
      }
      
      img {
        position: relative;
        margin-bottom: -1px;
        z-index: 1;
      }
    </style>
    <link href="<?php echo $site_url ?>/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo $site_url ?>/assets/css/fonts.css" rel="stylesheet">
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo $site_url ?>/assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $site_url ?>/assets/ico/favicon.png">
  </head>

  <body>
    <div class="container">
      <form class="form-signin" action="<?php echo $site_url ?>/login" method="POST">
<?php if($failure) { ?>
        <div class="alert alert-error">
          <strong>Nope!</strong> Try again buddy.
        </div>
<?php } ?>
        <img src="<?php echo $site_url ?>/assets/img/paulblart.png">

        <input type="password" name="password" class="input-block-level" placeholder="Password">

        <button class="btn btn-large btn-success submit" type="submit">Open Sesame!</button>
      </form>

    </div> <!-- /container -->
    
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
