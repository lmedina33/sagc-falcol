<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'e-mail ou login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'E-mail';
}
$password = array(
        'type' => 'password',
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
        'autocomplete' => 'off'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

        <title>SGM</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- http://davidbcalhoun.com/2010/viewport-metatag -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/css/bootstrap.min.css">	
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/css/font-awesome.min.css">

        <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/css/smartadmin-production.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/css/smartadmin-skins.css">	

        <!-- SmartAdmin RTL Support is under construction
                <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.css"> -->

        <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
<!--        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/css/demo.css">-->
        
        <link rel="stylesheet" type="text/css" media="all" href="<?= base_url("assets/css/your_style.css"); ?>">

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon/1favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= base_url() ?>assets/img/favicon/1favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        
        <link href="<?= base_url() ?>assets/libs/jquery.pageslide/jquery.pageslide.css" rel="stylesheet">
      <!-- jQuery Table Sorter Plugin -->
      <link href="<?= base_url() ?>assets/libs/jquery.tablesorter/themes/blue/style.css" rel="stylesheet">
      <link href="<?= base_url() ?>assets/libs/jquery.tablesorter/addons/pager/jquery.tablesorter.pager.css" rel="stylesheet">
      <!-- jQuery Choosen -->
      <link href="<?= base_url() ?>assets/libs/chosen/chosen.css" rel="stylesheet">
      <!-- jQuery iButton -->
      <link href="<?= base_url() ?>assets/libs/jquery.ibutton/css/jquery.ibutton.min.css" rel="stylesheet">
      <!-- uploadify -->
      <link href="<?= base_url() ?>assets/libs/uploadify/uploadify.css" rel="stylesheet">
      <!-- jCrop -->
      <link href="<?= base_url() ?>assets/libs/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet">
      <!-- Bootstrap WYSIHTML5 Master -->
      <link href="<?= base_url() ?>assets/libs/bootstrap-wysihtml5-master/dist/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">

    </head>
    <body id="login" class="smart-style-3 animated fadeInDown">
		<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
		<header id="header">
                    <img class="logo-lti" src="<?=  base_url()?>assets/images/lti_logo.png"/>
                    <img class="logo-sistema" src="<?=  base_url()?>assets/img/logo.png" />
                    <h1 class="nome-sistema" >                        
                        - Sistema de Gestão Municipal
                    </h1>
		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                                            <h1 class="txt-color-red login-header-big">&nbsp;</h1>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                                            <div class="well no-padding">
                                                <form action="<?php print site_url($this->uri->uri_string()); ?>" id="login-form" method="post" class="smart-form client-form">
                                                    <header>Entrar</header>
                                                    <fieldset>
                                                        <section>
                                                            <?php echo form_label(ucfirst($login_label), $login['id'], array("class" => "label")); ?>
                                                            <label class="input <?php if(isset($errors[$login['name']])){ print "state-error"; } ?>"> <i class="icon-append fa fa-user"></i>
                                                                <?php echo form_input($login, NULL); ?>
                                                                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Insira seu <?= $login_label ?></b>
                                                            </label>
                                                            <em for="<?= $login['id']; ?>" class="invalid"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></em>
                                                        </section>
                                                        <section>
                                                            <?php echo form_label('Senha', $password['id'], array("class" => "label")); ?>
                                                            <label class="input <?php if(isset($errors[$password['name']])){ print "state-error"; } ?>"> <i class="icon-append fa fa-lock"></i>
                                                                <?php echo form_password($password, NULL); ?>
                                                                <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Insira sua senha</b>
                                                            </label>
                                                            <em for="<?= $password['id']; ?>" class="invalid"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></em>
                                                            <div class="note">
                                                                <?php echo anchor('/auth/forgot_password/', 'Esqueci minha senha'); ?>
                                                            </div>
                                                        </section>
                                                        <?php /*
                                                        <section>
                                                            <label class="checkbox">
                                                                <?php echo form_checkbox($remember); ?>
                                                                <i></i>Mantenha-me Conectado
                                                            </label>
                                                        </section> */ ?>
                                                        <?php if ($show_captcha) {
                                                            if ($use_recaptcha) { ?>
                                                                <section>
                                                                    <style>#recaptcha_image{width: 280px !important;}</style>
                                                                    <div id="recaptcha_image"></div>
                                                                    <a href="javascript:Recaptcha.reload()">Obter outro CAPTCHA</a>
                                                                    <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Obter um CAPTCHA de áudio</a></div>
                                                                    <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Obter um CAPTCHA de imagem</a></div>

                                                                    <label class="recaptcha_only_if_image" for="recaptcha_response_field">Digite as palavras acima</label>
                                                                    <label class="recaptcha_only_if_audio" for="recaptcha_response_field">Digite os números que você ouve</label>

                                                                    <input class="login input-xlarge" type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                                                                    <div style="color: red; margin-bottom: 9px; margin-top: -5px;"><?php echo form_error('recaptcha_response_field'); ?></div>
                                                                    <?php echo $recaptcha_html; ?>
                                                                </section>
                                                            <?php } else { ?>
                                                                <section>
                                                                    <p style="margin-bottom: 5px;">Digite o código exatamente como ele parece:</p>
                                                                    <label for="<?php print $captcha['id']; ?>" class="label text-center">
                                                                        <?php echo $captcha_html; ?>
                                                                    </label>
                                                                    <label class="input <?php if(form_error($captcha['name'])){ print "state-error"; } ?>">
                                                                        <?php echo form_input($captcha, NULL); ?>
                                                                        <b class="tooltip tooltip-top-right">Código de Confirmação</b>
                                                                    </label>
                                                                    <em for="<?= $password['id']; ?>" class="invalid"><?php echo form_error($captcha['name']); ?></em>
                                                                    
                                                                </section>
                                                            <?php }
                                                          } ?>
                                                    </fieldset>
                                                    <footer>
                                                        <?php echo form_submit('submit', 'Entrar', 'class="btn btn-primary btn-login-entrar"'); ?>
                                                    </footer>
                                                </form>
                                            </div>
					</div>
				</div>
			</div>

		</div>

		<!--================================================== -->	

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script> if (!window.jQuery) {
                        document.write('<script src="<?= base_url() ?>assets/js/libs/jquery-2.0.2.min.js"><\/script>');
                    }</script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> if (!window.jQuery.ui) {
                        document.write('<script src="<?= base_url() ?>assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
                    }</script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->		
<script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?= base_url() ?>assets/js/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="<?= base_url() ?>assets/js/smartwidgets/jarvis.widget.min.js"></script>

<!-- EASY PIE CHARTS -->
<script src="<?= base_url() ?>assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<!-- SPARKLINES -->
<script src="<?= base_url() ?>assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="<?= base_url() ?>assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?= base_url() ?>assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="<?= base_url() ?>assets/js/plugin/select2/select2.min.js"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="<?= base_url() ?>assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

<!-- browser msie issue fix -->
<script src="<?= base_url() ?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- uploadify -->
<script src="<?= base_url() ?>assets/libs/uploadify/jquery.uploadify-3.1.min.js"></script>

<!-- jCrop -->
<script src="<?= base_url() ?>assets/libs/jcrop/js/jquery.Jcrop.js"></script>

<!--[if IE 7]>
        
        <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        
<![endif]-->

<!-- Demo purpose only -->
<!--<script src="<?= base_url() ?>assets/js/demo.js"></script>-->

<!-- MAIN APP JS FILE -->
<script src="<?= base_url() ?>assets/js/app.js"></script>

                <script type="text/javascript">
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						email : {
							required : true
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						email : {
							required : 'Por favor, insira seu <?= $login_label ?>'
						},
						password : {
							required : 'Por favor, insira sua senha'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

<!-- Your GOOGLE ANALYTICS CODE Below -->

<?php if (function_exists("pageFooter")) {
    pageFooter();
} ?>

</body>	

</html>