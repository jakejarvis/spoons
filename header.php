<?php
include_once('config.php');

session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == FALSE) {
  header("Location:" . $site_url . "/login");
}

include_once('functions.php');
include_once('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
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
    
    <meta charset="utf-8">
    <title><?php echo $page ?> &mdash; Spoons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo $site_url ?>/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
        font-size: 18px;
        line-height: 24px;
        overflow-x: hidden;
        /* disable text highlight */
        -moz-user-select: none;
        -webkit-user-select: none;
        cursor:default;
      }
      a, a:hover, strong {
        color: #79ad36;
        font-weight: bold;
      }
      small {
        font-size: 14px;
      }
      .nav-pills {
        font-size:16px;
      }
      .nav-pills .active a, .nav-pills .active a:hover {
        background-color: #79ad36;
      }
      .align-left {
          text-align: left;
      }
      .align-center {
          text-align: center;
      }
      .align-right {
          text-align: right;
      }
      .footer {
        font-size: 13px;
        line-height: 40px;
      }
      td {
        cursor: pointer;
        background-color: #fff;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        margin-bottom: -1px;
      }
    </style>
    
    <!-- Pretty font -->
    <script type="text/javascript" src="http://use.typekit.com/zhe6udw.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    
    <!-- Le JQuery -->
    <script src="<?php echo $site_url ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo $site_url ?>/assets/js/jquery-ui.min.js"></script>
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo $site_url ?>/assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $site_url ?>/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $site_url ?>/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $site_url ?>/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo $site_url ?>/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?php echo $site_url ?>/assets/ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <?php if($page == "Home") { ?><li><a href="<?php echo $site_url ?>/sms">How do I report via SMS?</a></li><?php } ?>
          <?php if($page != "Home") { ?><li><a href="<?php echo $site_url ?>/">&laquo; Back Home</a></li><?php } ?>
          <li style="margin-left:10px;"><a href="<?php echo $site_url ?>/logout">Logout</a></li>
        </ul>
        <h2><a href="<?php echo $site_url ?>/">Spoons Web Reporting</a></h2>
      </div>

      <hr>
      
<!-- START PAGE CONTENT -->