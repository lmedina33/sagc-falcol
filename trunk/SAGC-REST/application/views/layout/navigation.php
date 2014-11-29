<!-- NAVIGATION : This navigation is also responsive

To make this navigation dynamic please make sure to link the node
(the reference to the nav > ul) after page load. Or the navigation
will not initialize.
-->
<nav>
    <!-- 
    NOTE: Notice the gaps after each icon usage <i></i>..
    Please note that these links work a bit different than
    traditional href="" links. See documentation for details.
    -->

    <ul>
        <li class="">
            <a href="inicio" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
        </li>                    
        <li>
            <a href="#"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Administrativo</span></a>
            <ul>
                <? if ($this->usuarioLogado->temPermissao('turmas')) { ?>
                <li>
                    <a href="turmas"><i class="fa  fa-group"></i> Turmas</a>
                </li> 
                <?}?>
                <? if ($this->usuarioLogado->temPermissao('alunos')) { ?>
                <li>
                    <a href="alunos"><i class="fa  fa-graduation-cap"></i> Alunos</a>
                </li>
                <?}?>
                <? if ($this->usuarioLogado->temPermissao('usuarios')) { ?>
                <li>
                    <a href="usuarios"><i class="fa fa-user"></i> Usuários</a>
                </li> 
                <?}?>
                <? if ($this->usuarioLogado->temPermissao('perfilAcesso')) { ?>
                <li>
                    <a href="perfisacesso"><i class="fa fa-key"></i> Perfil de Acesso</a>
                </li>
                <?}?>
            </ul>
        </li>                     
    </ul>
</nav>
