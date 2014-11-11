<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email ou login';
} else {
	$login_label = 'Email';
}
?>
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

			<!-- MAIN CONTENT -->
			<div id="content" class="container">
                                <div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm"></div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                                            <div class="well no-padding">
                                                <form action="<?= site_url($this->uri->uri_string()); ?>" accept-charset="utf-8" method="post" class="smart-form client-form">
                                                    <header>
                                                            Esqueci minha senha
                                                    </header>
                                                    
                                                    <fieldset style="padding-left: 20px; padding-right: 20px;">
                                                        <section>
                                                            <?php echo form_label($login_label, $login['id']); ?>
                                                            <label class="input">
                                                                <?php echo form_input($login, NULL, 'class="login username-field input-xlarge"'); ?>
                                                            </label>
                                                          <div style="color: red; margin-bottom: 9px;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></div>
                                                        </section> <!-- /.field -->

                                                    </fieldset><!-- /.login-fields -->

                                                    <footer>
                                                        <?php echo form_submit('reset', 'Obter uma nova senha', 'class="button btn btn-large btn-primary btn-madmin"'); ?>
                                                    </footer><!-- /.login-actions -->

                                                    
                                                </form>
                                            </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <? require APPPATH . "views/layout/foot.php"; ?>
	</body>
</html>