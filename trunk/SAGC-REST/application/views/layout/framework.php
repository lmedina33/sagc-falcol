<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <? require APPPATH . "views/layout/head.php"; ?>
    </head>
    <body class="smart-style-2">

        <header id="header">
            <div id="logo-group">
                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo" style="width: 30px"> <img style="width: 23px; height: 23px" src="<?=  site_url("")?>/assets/img/presence.png" alt="SmartAdmin"> </span>
                <!-- END LOGO PLACEHOLDER -->
                <span class="label" style="height: 10px; padding-top: 17px; font-size: 15px;padding-left: 0px;">Presence</span>
            </div>
            

            <!-- #TOGGLE LAYOUT BUTTONS -->
            <!-- pulled right: nav area -->
            <div class="pull-right">

                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->

                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
                            <img src="img/avatars/sunny.png" alt="John Doe" class="online" />  
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#ajax/profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="login.html" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="auth/logout" title="Sign Out" data-action="userLogout" data-logout-msg="Tem certeza que deseja realizar logout do sistema?"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->

                <!-- search mobile button (this is hidden till mobile view port) -->
                <div id="search-mobile" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
                </div>
                <!-- end search mobile button -->

                
                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->

                                

            </div>
            <!-- end pulled right: nav area -->

        </header>
        <!-- END HEADER -->

        <!-- #NAVIGATION -->
        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
        <aside id="left-panel">

            <!-- User info -->
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as is --> 

                    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="<?= base_url()?>assets/img/user.jpg" alt="me" class="online" /> 
                        <span>
                            <?=$usuarioLogado->getNome();?>
                        </span>                        
                    </a> 

                </span>
            </div>
            <!-- end user info -->

            <!-- NAVIGATION : This navigation is also responsive

            To make this navigation dynamic please make sure to link the node
            (the reference to the nav > ul) after page load. Or the navigation
            will not initialize.
            -->
            <? require APPPATH . "views/layout/navigation.php"; ?>


            <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

        </aside>
        <!-- END NAVIGATION -->

        <!-- #MAIN PANEL -->
        <div id="main" role="main">

            <!-- RIBBON -->
            <div id="ribbon">

                <span class="ribbon-button-alignment"> 
                    <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true" data-reset-msg="Would you like to RESET all your saved widgets and clear LocalStorage?"><i class="fa fa-refresh"></i></span> 
                </span>

                <!-- breadcrumb -->
                <ol class="breadcrumb">
                    <!-- This is auto generated -->
                </ol>
                <!-- end breadcrumb -->

                <!-- You can also add more buttons to the
                ribbon for further usability

                Example below:

                <span class="ribbon-button-alignment pull-right" style="margin-right:25px">
                        <a href="#" id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa fa-grid"></i> Change Grid</a>
                        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa fa-plus"></i> Add</span>
                        <button id="search" class="btn btn-ribbon" data-title="search"><i class="fa fa-search"></i> <span class="hidden-mobile">Search</span></button>
                </span> -->

            </div>
            <!-- END RIBBON -->

            <!-- #MAIN CONTENT -->
            <div id="content">

            </div>

            <!-- END #MAIN CONTENT -->

        </div>
        <!-- END #MAIN PANEL -->

        <!-- #PAGE FOOTER -->
        <div class="page-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <span class="txt-color-white">Presence 0.5 <span class="hidden-xs"> - LTI Soluções Web</span> © 2014-2015</span>
                </div>

                <div class="col-xs-6 col-sm-6 text-right hidden-xs">
                    <div class="txt-color-white inline-block">
<!--                        <i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
                        <div class="btn-group dropup">
                            <button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
                                <i class="fa fa-link"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right text-left">
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Download Progress</p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-success" style="width: 50%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Server Load</p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-success" style="width: 20%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li >
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <button class="btn btn-block btn-default">refresh</button>
                                    </div>
                                </li>
                            </ul>
                        </div>-->
                        <!-- end btn-group-->
                    </div>
                    <!-- end div-->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- END FOOTER -->
        

        <? require APPPATH . "views/layout/foot.php"; ?>

    </body>
</html>