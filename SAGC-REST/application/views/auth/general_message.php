<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <? require APPPATH . "views/layout/head.php"; ?>
    </head>
    <body id="login" class="smart-style-3 animated fadeInDown">
        <!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
        <header id="header">
            <img class="logo-lti" src="<?= base_url() ?>assets/images/lti_logo.png"/>
            <img class="logo-sistema" src="<?= base_url() ?>assets/img/logo.png" />
            <h1 class="nome-sistema" >                        
                - Sistema de Gestão Municipal
            </h1>
        </header>

        <div id="main" role="main">
            <p style="margin-top: 20px; text-align: center; background: #fff; padding: 10px;">
                <?php echo $message; ?>
            </p>
        </div>

        <? require APPPATH . "views/layout/foot.php"; ?>
    </body>
</html>