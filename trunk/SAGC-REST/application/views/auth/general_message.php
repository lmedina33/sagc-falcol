<!DOCTYPE html>
<html lang="pt-br">
<head>
    <? require APPPATH . "views/layout/head.php"; ?>
</head>
<body id="login" class="animated fadeInDown">
    <!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
    <header id="header">
            <!--<span id="logo"></span>-->

            <div id="logo-group">
                    <span id="logo"> <img src="<?= base_url("assets/img/logo.png"); ?>" alt="SmartAdmin"> </span>

                    <!-- END AJAX-DROPDOWN -->
            </div>

    </header>

    <div id="main" role="main">
        <p style="margin-top: 20px; text-align: center; background: #fff; padding: 10px;">
            <?php echo $message; ?>
        </p>
    </div>
    
    <? require APPPATH . "views/layout/foot.php"; ?>
</body>
</html>