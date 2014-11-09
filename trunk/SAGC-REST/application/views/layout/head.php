<meta charset="utf-8">
<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

<title>SGM</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Use the correct meta names below for your web application
         Ref: http://davidbcalhoun.com/2010/viewport-metatag 
         
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">-->

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Basic Styles -->
<link rel="stylesheet" type="text/css" media="all" href="<?= base_url("assets/css/bootstrap.min.css"); ?>">	
<link rel="stylesheet" type="text/css" media="all" href="<?= base_url("assets/css/font-awesome.min.css"); ?>">

<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
<link rel="stylesheet" type="text/css" media="all" href="<?= base_url("assets/css/smartadmin-production.css"); ?>">
<link rel="stylesheet" type="text/css" media="all" href="<?= base_url("assets/css/smartadmin-skins.css"); ?>">	

<!-- SmartAdmin RTL Support is under construction
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.css"> -->

<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
<? /* <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url("assets/css/demo.css"); ?>"> */ ?>

<link rel="stylesheet" type="text/css" media="all" href="<?= base_url("assets/css/your_style.css"); ?>">

<!-- FAVICONS -->
<link rel="shortcut icon" href="<?= base_url("assets/img/favicon/1favicon.ico"); ?>" type="image/x-icon">
<link rel="icon" href="<?= base_url("assets/img/favicon/1favicon.ico"); ?>" type="image/x-icon">

<!-- GOOGLE FONT -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

<!-- Specifying a Webpage Icon for Web Clip 
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
<link rel="apple-touch-icon" href="<?= base_url("assets/img/splash/sptouch-icon-iphone.png"); ?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url("assets/img/splash/touch-icon-ipad.png"); ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url("assets/img/splash/touch-icon-iphone-retina.png"); ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url("assets/img/splash/touch-icon-ipad-retina.png"); ?>">

<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Startup image for web apps -->
<link rel="apple-touch-startup-image" href="<?= base_url("assets/img/splash/ipad-landscape.png"); ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
<link rel="apple-touch-startup-image" href="<?= base_url("assets/img/splash/ipad-portrait.png"); ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
<link rel="apple-touch-startup-image" href="<?= base_url("assets/img/splash/iphone.png"); ?>" media="screen and (max-device-width: 320px)">

<!-- Uploadifive -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/js/plugin/uploadifive/uploadifive.css">

<!-- Jcrop -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jquery.Jcrop.min.css">

<link rel="stylesheet" type="text/css" media="print" href="<?= base_url("assets/css/print.css"); ?>">

<?
    if (function_exists("pageHeader")) {
        pageHeader();
    }
?>