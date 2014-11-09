<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <? require APPPATH . "views/layout/head.php"; ?>
    </head>
    <body class="fixed-header fixed-ribbon fixed-navigation smart-style-3">
        <!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width
                 You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->

        <!-- HEADER -->
        <header id="header">
            <div id="logo-group">

                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo"> <img src="<?= base_url("assets/img/logo-pale.png"); ?>" alt="SmartAdmin"> </span>
                <!-- END LOGO PLACEHOLDER -->

                <span id="activity" class="activity-dropdown active"> <i class="fa fa-user"></i> <b class="badge bounceIn animated <?= ($notificacoesPendentes > 0) ? "bg-color-red" : ""; ?>"><?= $notificacoesPendentes; ?></b> </span>

                <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
                <div class="ajax-dropdown">

                    <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
                    <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="ajax/notify/mail.html">
                            Mensagens (0) </label>
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="<?= site_url('notificacoes/listarAjax'); ?>">
                            Notificações (<?= $notificacoesPendentes; ?>) </label>                        
                    </div>

                    <!-- notification content -->
                    <div class="ajax-notifications custom-scroll">

                        <div class="alert alert-transparent">
                            <h4>Click a button to show messages here</h4>
                            This blank page message helps protect your privacy, or you can show the first message here automatically.
                        </div>

                        <i class="fa fa-lock fa-4x fa-border"></i>

                    </div>
                    <!-- end notification content -->

                    <!-- footer: refresh area -->
                    <span> Ultima atualização em: 12/12/2013 9:43AM
                        <button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Carregando..." class="btn btn-xs btn-default pull-right">
                            <i class="fa fa-refresh"></i>
                        </button> </span>
                    <!-- end footer -->

                </div>
                <!-- END AJAX-DROPDOWN -->
            </div>

            <!-- projects dropdown -->
            <div id="project-context">
                <?
                $entidadePublica = new models\negocio\EntidadePublicaBLL();
                $entidadeAtual = $entidadePublica->buscarPorId($this->usuarioLogado->getEntidadePublicaAtualId());
                ?>

                <span class="label">Visualização</span>
                <span id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown"><?= is_null($entidadeAtual)? '' : $entidadeAtual->getNome(); ?> <i class="fa fa-angle-down"></i></span>

                <!-- Suggestion: populate this list with fetch and push technique -->
                <ul class="dropdown-menu">
                    <?
                    $secretariasUsuario = $this->usuarioLogado->getSecretarias();
                    $unidadesUsuario = $this->usuarioLogado->getUnidades();
                    foreach ($secretariasUsuario as $secretaria):
                        ?>
                        <li>
                            <a href="<?= site_url(); ?>/usuarios/trocarentidadepublicaatual/<?= $secretaria->getId() ?>">Secretaria: <?= $secretaria->getNome() ?></a>
                        </li>                         
                        <?
                    endforeach;
                    foreach ($unidadesUsuario as $unidade):
                        ?>
                        <li>
                            <a href="<?= site_url(); ?>/usuarios/trocarentidadepublicaatual/<?= $unidade->getId() ?>">Unidade: <?= $unidade->getNome() ?></a>
                        </li>                        
                        <?
                    endforeach;
                    ?>                

                    <li class="divider"></li>
                    <li>
                        <select name="visualizacao-selecao" class="select2" data-select-search="true">
                            <? foreach ($secretariasUsuario as $secretaria): ?>
                                <option value="0">Secretaria: <?= $secretaria->getNome() ?></option>
                                <?
                            endforeach;
                            foreach ($unidadesUsuario as $unidade):
                                ?>
                                <option value="0">Unidade: <?= $unidade->getNome() ?></option>
                                <?
                            endforeach;
                            ?>
                        </select>
                    </li>
                </ul>
                <!-- end dropdown-menu-->

            </div>
            <!-- end projects dropdown -->

            <!-- pulled right: nav area -->
            <div class="pull-right">

                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->

                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="<?= site_url("auth/logout") ?>" title="Logout" data-logout-msg="Você está prestes a realizar logout no sistema"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->

                <!-- search mobile button (this is hidden till mobile view port) -->
                <div id="search-mobile" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
                </div>
                <!-- end search mobile button -->

                <!-- input: search field -->
                <form action="<?php echo site_url('familias') ?>" class="header-search pull-right" method="post">
                    <input type="text" name="termo" placeholder="Nome, CPF ou NIS" id="search-fld">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
                </form>
                <!-- end input: search field -->

                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" onclick="launchFullscreen(document.documentElement);" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->

            </div>
            <!-- end pulled right: nav area -->

        </header>
        <!-- END HEADER -->

        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <aside id="left-panel">

            <!-- User info -->
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 

                    <a>
                        <img src="<?= base_url("uploads/usuarios")."/".$this->usuarioLogado->getFoto(); ?>" alt="me" class="online" /> 
                        <span>
                            <?= substr($this->usuarioLogado->getNome(), 0, strpos($this->usuarioLogado->getNome(), " ") ? strpos($this->usuarioLogado->getNome(), " ") : strlen($this->usuarioLogado->getNome())); ?>
                        </span>
                    </a> 

                </span>
            </div>
            <!-- end user info -->

            <? require APPPATH . "views/layout/navigation.php"; ?>

            <span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>

        </aside>

        <!-- MAIN PANEL -->
        <div id="main" role="main">

            <!-- RIBBON -->
            <div id="ribbon">

                <!-- breadcrumb -->
                <ol class="breadcrumb">
                    <!-- This is auto generated -->
                </ol>
                <!-- end breadcrumb -->

                <!-- You can also add more buttons to the
                ribbon for further usability

                Example below:

                <span class="ribbon-button-alignment pull-right">
                <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
                <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
                <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
                </span> -->

            </div>
            <!-- END RIBBON -->

            <!-- MAIN CONTENT -->
            <div id="content"><?php
                if (isset($pageContent)) {
                    print $pageContent;
                }
                ?></div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->
<?php /* TODO: remover
        <!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
        Note: These tiles are completely responsive,
        you can add as many as you like
        -->
        <div id="shortcut">
            <ul>
                <li>
                    <a href="#ajax/inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
                </li>
                <li>
                    <a href="#ajax/calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
                </li>
                <li>
                    <a href="#ajax/gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
                </li>
                <li>
                    <a href="#ajax/invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
                </li>
                <li>
                    <a href="#ajax/gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
                </li>
                <li>
                    <a href="#ajax/profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
                </li>
            </ul>
        </div>
        <!-- END SHORTCUT AREA -->
*/ ?>
        <!--================================================== -->

        <? require APPPATH . "views/layout/foot.php"; ?>

        
        <div id="over-carregando" style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; z-index: 999999; background-color: rgba(0,0,0,0.8); display: none;">
            <div style="width: 64px; position: absolute; bottom: 50%; left: 50%; margin: -32px 0 0 -49px; text-align: center;">
                <img src="<?= base_url('assets/img/carregando.gif') ?>" style="width: 64px;"/>
                <img src="<?= base_url('assets/img/sgm.png') ?>" style="width: 64px; margin-top: 12px"/>
            </div>
        </div>
    </body>  
    
</html>