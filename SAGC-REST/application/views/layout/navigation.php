<!-- NAVIGATION : This navigation is also responsive

To make this navigation dynamic please make sure to link the node
(the reference to the nav > ul) after page load. Or the navigation
will not initialize.
-->
<nav>
    <!-- NOTE: Notice the gaps after each icon usage <i></i>..
    Please note that these links work a bit different than
    traditional href="" links. See documentation for details.
    -->

    <ul>
        <li class="<?= in_array('inicio', $menuAtivo)?'active':''; ?>">
            <a href="<?= site_url("inicio"); ?>" title="Início"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Início</span></a>
        </li>
        <li class="<?= in_array('administracao', $menuAtivo)?'active':''; ?>">
            <a href="#"><i class="fa-lg fa-fw glyphicon glyphicon-credit-card"></i> <span class="menu-item-parent">Administração</span></a>
            <ul>
                <li class="<?= in_array('administracao/perfisacesso', $menuAtivo)?'active':''; ?>">
                    <a href="<?= site_url("perfisacesso"); ?>"><i class="fa fa-lg fa-fw fa-key"></i> <span class="menu-item-parent">Perfis de Acesso</span></a>
                </li>
                <li class="<?= in_array('administracao/prefeituras', $menuAtivo)?'active':''; ?>">
                    <a href="<?= site_url("prefeituras"); ?>"><i class="fa fa-lg fa-fw fa-institution"></i> <span class="menu-item-parent">Prefeituras</span></a>
                </li>
                <li class="<?= in_array('administracao/redessocioassistenciais', $menuAtivo)?'active':''; ?>">
                    <a href="<?= site_url("redessocioassistenciais"); ?>"><i class="fa fa-lg fa-fw fa-child"></i> <span class="menu-item-parent">Redes Socioassistenciais</span></a>
                </li>
                <li class="<?= in_array('administracao/secretarias', $menuAtivo)?'active':''; ?>">
                    <a href="<?= site_url("secretarias"); ?>"><i class="fa fa-lg fa-fw fa-sitemap"></i> <span class="menu-item-parent">Secretarias</span></a>
                </li>
                <li class="<?= in_array('administracao/unidades', $menuAtivo)?'active':''; ?>">
                    <a href="<?= site_url("unidades"); ?>"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent">Unidades</span></a>
                </li>                
                
                <li class="<?= in_array('administracao/usuarios', $menuAtivo)?'active':''; ?>">
                    <a href="<?= site_url("usuarios"); ?>"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Usuários</span></a>
                </li>
            </ul>
        </li>        
    </ul>
</nav>