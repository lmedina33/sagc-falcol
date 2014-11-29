<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'E-mail ou login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'E-mail';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
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
<html lang="pt-br" style="height: 100%">
	<head>
		<? require APPPATH . "views/layout/head.php"; ?>
	</head>
	<body id="login" class="animated fadeInDown smart-style-2">
		<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
		<header id="header">
			<!--<span id="logo"></span>-->

			<div id="logo-group">
                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo" style="width: 30px"> <img style="width: 23px; height: 23px" src="<?= site_url("") ?>/assets/img/presence.png" alt="SmartAdmin"> </span>
                <!-- END LOGO PLACEHOLDER -->
                <span class="label" style="height: 10px; padding-top: 17px; font-size: 15px;padding-left: 0px;">Presence</span>
            </div>

		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                                            <h1 style="display: none;" class="txt-color-red login-header-big">AFC</h1>
						<div style="display: none;" class="hero">

							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header">It's Okay to be Smart. Experience the simplicity of SmartAdmin, everywhere you go!</h4>
								<div class="login-app-icons">
									<a href="javascript:void(0);" class="btn btn-danger btn-sm">Frontend Template</a>
									<a href="javascript:void(0);" class="btn btn-danger btn-sm">Find out more</a>
								</div>
							</div>
							
							<img src="<?= base_url("assets/img/demo/iphoneview.png"); ?>" class="pull-right display-image" alt="" style="width:210px">

						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="<?= site_url("auth/login"); ?>" accept-charset="utf-8" method="post" id="login-form" class="smart-form client-form">
								<header>
									Entrar
								</header>

								<fieldset style="padding-left: 20px; padding-right: 20px;">
									
									<section>
										<?php echo form_label($login_label, $login['id']); ?>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<?php echo form_input($login, NULL, 'class="login username-field"'); ?>
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Insira seu endereço de e-mail ou nome de usuário</b>
										</label>
										<div style="color: red; margin-bottom: 9px; margin-top: -5px;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></div>
									</section>

									<section>
										<?php echo form_label('Senha', $password['id']); ?>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<?php echo form_password($password, NULL, 'class="login password-field"'); ?>
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Insira sua senha</b>
										</label>
										<div style="color: red; margin-bottom: 9px; margin-top: -5px;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></div>
										<div class="note">
											<a href="<?= site_url('/auth/forgot_password/'); ?>">Esqueceu a senha?</a>
										</div>
									</section>
									

									<section>
										<label class="checkbox">
											<?php echo form_checkbox($remember); ?>
											<i></i>Manter-me logado</label>
									</section>
									
									<?php if ($show_captcha) {
										if ($use_recaptcha) { ?>
											<div class="field">
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
											</div>
										<?php } else { ?>
											<div class="field">
												<p style="margin-bottom: 5px;">Digite o código exatamente como ele parece:</p>
												<?php echo $captcha_html; ?>
												<?php echo form_label('Código de Confirmação', $captcha['id'], array('style' => 'margin-top: 5px;')); ?>
												<?php echo form_input($captcha, NULL, 'class="login input-xlarge"'); ?>
												<div style="color: red; margin-bottom: 9px; margin-top: -5px;"><?php echo form_error($captcha['name']); ?></div>
											</div>
										<?php }
									} ?>
								</fieldset>
								<footer>
									<?php echo form_submit('submit', 'Entrar', 'class="btn btn-primary"'); ?>
								</footer>
							</form>

						</div>
					</div>
				</div>
			</div>

		</div>

		<!--================================================== -->	

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script src="<?= base_url("assets/js/plugin/pace/pace.min.js"); ?>"></script>

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="<?= base_url("assets/js/libs/jquery-2.0.2.min.js"); ?>"><\/script>');} </script>

	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="<?= base_url("assets/js/libs/jquery-ui-1.10.3.min.js"); ?>"><\/script>');} </script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
		<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->		
		<script src="<?= base_url("assets/js/bootstrap/bootstrap.min.js"); ?>"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?= base_url("assets/js/notification/SmartNotification.min.js"); ?>"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?= base_url("assets/js/smartwidgets/jarvis.widget.min.js"); ?>"></script>
		
		<!-- EASY PIE CHARTS -->
		<script src="<?= base_url("assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"); ?>"></script>
		
		<!-- SPARKLINES -->
		<script src="<?= base_url("assets/js/plugin/sparkline/jquery.sparkline.min.js"); ?>"></script>
		
		<!-- JQUERY VALIDATE -->
		<script src="<?= base_url("assets/js/plugin/jquery-validate/jquery.validate.min.js"); ?>"></script>
		
		<!-- JQUERY MASKED INPUT -->
		<script src="<?= base_url("assets/js/plugin/masked-input/jquery.maskedinput.min.js"); ?>"></script>
		
		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?= base_url("assets/js/plugin/select2/select2.min.js"); ?>"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?= base_url("assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"); ?>"></script>
		
		<!-- browser msie issue fix -->
		<script src="<?= base_url("assets/js/plugin/msie-fix/jquery.mb.browser.min.js"); ?>"></script>
		
		<!-- FastClick: For mobile devices -->
		<script src="<?= base_url("assets/js/plugin/fastclick/fastclick.js"); ?>"></script>
		
		<!--[if IE 7]>
			
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
			
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="<?= base_url("assets/js/app.js"); ?>"></script>

		<script type="text/javascript">
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						email : {
							required : true,
							email : true
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
							required : 'Please enter your email address',
							email : 'Please enter a VALID email address'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

	</body>
</html>