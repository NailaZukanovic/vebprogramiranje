<?php
// error_reporting(0);
// include("dbconnection.php");
// $dt = date("Y-m-d");
// $tim = date("H:i:s");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!-- Document Title -->
<title>HMS</title>

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
<!-- Fonts Online -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="Styles/global.css"/>
  <style>
    .iconbox {
display: flex;
    position: relative;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    text-align: center;
    border: 10px solid #E8E9F1;
    box-sizing: border-box;
    margin-left:20px;
    margin-right:20px;
}
.contents p {
    padding: 5px;
    margin-bottom: 10px;
    color: #000;
    font-size: 18px;
    line-height: 24px;
}

.contents h3 {
  font-size: 22px;
    margin-bottom: 10px !important;
    display: inline-block;
    margin: 0 0 0.7em;
    font-size: 24px;
    line-height: 1.5em;
    color: #007acc !important;
}

.btn-link {

font-weight: 700 !important;
text-transform: uppercase !important;
    color: #007acc;
}
.info .row {

display: flex;
flex-wrap: wrap;
margin-right: -12px;
margin-left: -12px;


}
    header {
      width: 100%;
      z-index: 999;
      background: none;
      padding: 0px 0;
      position: relative;
      padding-top: 30px;
      position: relative;
      background: #fff;
      padding: 25px 0;
    }

    header .container {
       position: relative;
    }

    header .logo {
      float: left;
      position: relative;
      -webkit-transition: 0.2s ease-in-out;
      -moz-transition: 0.2s ease-in-out;
      -ms-transition: 0.2s ease-in-out;
      -o-transition: 0.2s ease-in-out;
      transition: 0.2s ease-in-out;
    }

    .head-info {
      float: right;
    }
    .head-info li {
      list-style: none;
      display: inline-block;
      float: left;
      margin-left: 35px;
    }
    .head-info li i {
      height: 33px;
      width: 33px;
      border-radius: 50%;
      display: table-cell;
      vertical-align: top;
      background: #2b96cc;
      text-align: center;
      line-height: 33px;
      color: #fff;
      margin-right: 10px;
      float: left;
      margin-top: 0px;
      font-size: 12px;
    }

    i {
      height: 33px;
      width: 33px;
      border-radius: 50%;
      display: table-cell;
      vertical-align: top;
      background: #2b96cc;
      text-align: center;
      line-height: 33px;
      color: #fff;
      margin-right: 10px;
      float: left;
      margin-top: 0px;
      font-size: 12px;
    }

    .index * {
      margin-top: 10px;
    }
    .head-info li p {
      font-weight: 400;
      font-size: 12px;
      line-height: 16px;
      display: table-cell;
    }
    .head-info li p span {
      display: inline-block;
      width: 100%;
    }

    footer {
      width:100%;
      background: #212121;
      position: relative;
      z-index: 99;
    }

    footer p {
      color: #757575;
    }
    footer p a {
      color: #f7f7f7;
    }
    footer ul li {
      margin-bottom: 20px;
    }
    footer span {
      color: #3dc5df;
    }
    footer li {
      list-style: none;
    }

    footer p {
      color: #cbcbcb;
      line-height: 26px;
    }

    .footer-2 {
      padding: 100px 0;
      padding-bottom: 50px;
    }
    .footer-2 h6 {
      color: #fff;
      text-transform: uppercase;
      font-weight: 400;
      margin: 0px;
      font-size: 18px;
      margin-bottom: 30px;
    }

    .index li {
      list-style:none;
      margin-bottom:20px;
    }
    .index ul {
      margin-bottom: 40px;
    }
    nav {
      width: 100%;
      background-color: #007acc;
    }

    .index {
      background-color:#e6ffff;
    }

    .index .main-banner div {
      text-align: center;
    }

    .index img {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }

  </style>
<!-- JavaScripts
<script src="js/vendors/modernizr.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css"> -->
</head>
<body style="display: grid; place-items: center; background-color: #ccffff">  
  <!-- Header -->
  <header class="header-style-2">
    <div class="container">
      <div class="logo"> <a href="index.php"><img src="Assets//Hospital_logo.png" alt="" style="height: 51px;"></a> </div>
      <div class="head-info">
        <ul>
          <li> <i class="fa fa-phone"></i>
            <p>1010 2020 36360<br>
              9-269-690-HMS</p>
          </li>
          <li> <i class="fa fa-envelope-o"></i>
            <p>hospital@gmail.com<br>
              info@hospital.com</p>
          </li>
          <li> <i class="fa fa-map-marker"></i>
            <p>1942  Poe Lane<br>
             Kansas City</p>
          </li>
        </ul>
      </div>
    </div>
    
    <!-- Nav -->
  </header>