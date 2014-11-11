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
        <li class="<?= in_array('inicio', $menuAtivo) ? 'active' : ''; ?>">
            <a href="<?= site_url("inicio"); ?>"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Início</span></a>
        </li>
        <?php
        if ($this->usuarioLogado->temPermissao('profissionais') || $this->usuarioLogado->temPermissao('departamentos') || $this->usuarioLogado->temPermissao('perfisacesso')) {
            ?>
            <li class="<?= in_array('rh', $menuAtivo) ? 'active' : ''; ?>">
                <a href="#"><i class="fa fa-lg fa-fw fa-group"></i> <span class="menu-item-parent">Recursos Humanos</span></a>
                <ul>
                    <?php if ($this->usuarioLogado->temPermissao('profissionais')) { ?>
                        <li class="<?= in_array('profissionais', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("profissionais"); ?>"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Profissionais</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('departamentos')) { ?>
                        <li class="<?= in_array('departamentos', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("departamentos"); ?>"><i class="fa fa-lg fa-fw fa-suitcase"></i> <span class="menu-item-parent">Departamentos</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('perfisacesso')) { ?>
                        <li class="<?= in_array('perfisacesso', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("perfisacesso"); ?>"><i class="fa fa-lg fa-fw fa-key"></i> <span class="menu-item-parent">Perfis de Acesso</span></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php
        if ($this->usuarioLogado->temPermissao('tiposproblema') || $this->usuarioLogado->temPermissao('equipamentos') || $this->usuarioLogado->temPermissao('tiposequipamento') || $this->usuarioLogado->temPermissao('checklists') || $this->usuarioLogado->temPermissao('tickets') || $this->usuarioLogado->temPermissao('manutencoesPreventivas')) {
            ?>
            <li class="<?= in_array('manutencoes', $menuAtivo) ? 'active' : ''; ?>">
                <a href="#"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">Manutenções</span></a>
                <ul>
                    <?php if ($this->usuarioLogado->temPermissao('tiposproblema')) { ?>
                        <li class="<?= in_array('tiposproblema', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("tiposproblema"); ?>"><i class="fa fa-lg fa-fw fa-bug"></i> <span class="menu-item-parent">Tipos de Problema</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('equipamentos')) { ?>
                        <li class="<?= in_array('equipamentos', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("equipamentos"); ?>"><i class="fa fa-lg fa-fw fa-barcode"></i> <span class="menu-item-parent">Equipamentos</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('tiposequipamento')) { ?>
                        <li class="<?= in_array('tiposequipamento', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("tiposequipamento"); ?>"><i class="fa fa-lg fa-fw fa-tag"></i> <span class="menu-item-parent">Tipos de Equipamento</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('checklists')) { ?>
                        <li class="<?= in_array('checklists', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("checklists"); ?>"><i class="fa fa-lg fa-fw fa-check-square-o"></i> <span class="menu-item-parent">Checklists</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('tickets')) { ?>
                        <li class="<?= in_array('tickets', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("tickets"); ?>"><i class="fa fa-lg fa-fw fa-ticket"></i> <span class="menu-item-parent">Tickets</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('manutencoesPreventivas')) { ?>
                        <li class="<?= in_array('agendaManutencoes', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("manutencoesPreventivas/agenda"); ?>"><i class="fa fa-lg fa-fw fa-calendar-o"></i> <span class="menu-item-parent">Agenda</span></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if ($this->usuarioLogado->temPermissao('licencas')) { ?>
            <li class="<?= in_array('licencas', $menuAtivo) ? 'active' : ''; ?>">
                <a href="<?= site_url("licencas"); ?>"><i class="fa fa-lg fa-fw fa-certificate"></i> <span class="menu-item-parent">Licenças/Documentos</span></a>
            </li>
        <?php } ?>
        <?php
        if ($this->usuarioLogado->temPermissao('entradassaidasefluentes') || $this->usuarioLogado->temPermissao('tiposresiduo') || $this->usuarioLogado->temPermissao('transportadoras') || $this->usuarioLogado->temPermissao('caminhoes') || $this->usuarioLogado->temPermissao('geradoras') || $this->usuarioLogado->temPermissao('receptores') || $this->usuarioLogado->temPermissao('clientes') || $this->usuarioLogado->temPermissao('romaneios') || $this->usuarioLogado->temPermissao('relatoriosefluentes/efluentes') || $this->usuarioLogado->temPermissao('relatoriosefluentes/tiposResiduoPorReceptor') || $this->usuarioLogado->temPermissao('relatoriosefluentes/entradasPorClienteGeradora') || $this->usuarioLogado->temPermissao('relatoriosefluentes/entradasPorOperador') || $this->usuarioLogado->temPermissao('relatoriosefluentes/producao') || $this->usuarioLogado->temPermissao('relatoriosefluentes/monitoramentoDqo') || $this->usuarioLogado->temPermissao('relatoriosefluentes/faturamentoPendente')) {
            ?>
            <li class="<?= in_array('efluentes', $menuAtivo) ? 'active' : ''; ?>">
                <a href="#"><i class="fa fa-lg fa-fw fa-flask"></i> <span class="menu-item-parent">Efluentes</span></a>
                <ul>
                    <?php if ($this->usuarioLogado->temPermissao('entradassaidasefluentes')) { ?>
                        <li class="<?= in_array('entradassaidasefluentes/entrada', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("entradassaidasefluentes/index/entrada"); ?>"><i class="fa fa-lg fa-fw fa-exchange"></i> <span class="menu-item-parent">Entradas de Efluentes</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('entradassaidasefluentes')) { ?>
                        <li class="<?= in_array('entradassaidasefluentes/saida', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("entradassaidasefluentes/index/saida"); ?>"><i class="fa fa-lg fa-fw fa-exchange"></i> <span class="menu-item-parent">Saídas de Residuos</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('tiposresiduo')) { ?>
                        <li class="<?= in_array('tiposresiduo', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("tiposresiduo"); ?>"><i class="fa fa-lg fa-fw fa-tag"></i> <span class="menu-item-parent">Tipos de Resíduo</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('transportadoras')) { ?>
                        <li class="<?= in_array('transportadoras', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("transportadoras"); ?>"><i class="fa fa-lg fa-fw fa-truck"></i> <span class="menu-item-parent">Transportadoras</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('caminhoes')) { ?>
                        <li class="<?= in_array('caminhoes', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("caminhoes"); ?>"><i class="fa fa-lg fa-fw fa-truck"></i> <span class="menu-item-parent">Caminhões</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('geradoras')) { ?>
                        <li class="<?= in_array('geradoras', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("geradoras"); ?>"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Geradoras</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('receptores')) { ?>
                        <li class="<?= in_array('receptores', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("receptores"); ?>"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Receptores</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('clientes')) { ?>
                        <li class="<?= in_array('clientes', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("clientes"); ?>"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Clientes</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('romaneios')) { ?>
                        <li class="<?= in_array('romaneios', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("romaneios"); ?>"><i class="fa fa-lg fa-fw fa-inbox"></i> <span class="menu-item-parent">Romaneios</span></a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($this->usuarioLogado->temPermissao('relatoriosefluentes/efluentes') || $this->usuarioLogado->temPermissao('relatoriosefluentes/tiposResiduoPorReceptor') || $this->usuarioLogado->temPermissao('relatoriosefluentes/entradasPorClienteGeradora') || $this->usuarioLogado->temPermissao('relatoriosefluentes/entradasPorOperador') || $this->usuarioLogado->temPermissao('relatoriosefluentes/producao') || $this->usuarioLogado->temPermissao('relatoriosefluentes/monitoramentoDqo') || $this->usuarioLogado->temPermissao('relatoriosefluentes/faturamentoPendente')) {
                        ?>
                        <li class="<?= in_array('relatoriosefluentes', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="#"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Relatórios</span></a>
                            <ul>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosefluentes/efluentes')) { ?>
                                    <li class="<?= in_array('relatoriosefluentes/efluentes', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosefluentes/efluentes"); ?>"><i class="fa fa-lg fa-fw fa-exchange"></i> <span class="menu-item-parent">Efluentes</span></a>
                                    </li>
                                <?php } ?>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosefluentes/tiposResiduoPorReceptor')) { ?>
                                    <li class="<?= in_array('relatoriosefluentes/tiposResiduoPorReceptor', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosefluentes/tiposResiduoPorReceptor"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-tags"></i> Tipos de residuo por Receptor</span></a>
                                    </li>
                                <?php } ?>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosefluentes/entradasPorClienteGeradora')) { ?>
                                    <li class="<?= in_array('relatoriosefluentes/entradasPorClienteGeradora', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosefluentes/entradasPorClienteGeradora"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-building"></i> Entradas por Cliente e Geradora</span></a>
                                    </li>
                                <?php } ?>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosefluentes/entradasPorOperador')) { ?>
                                    <li class="<?= in_array('relatoriosefluentes/entradasPorOperador', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosefluentes/entradasPorOperador"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-user"></i> Entradas por Operador</span></a>
                                    </li>
                                <?php } ?>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosefluentes/producao')) { ?>
                                    <li class="<?= in_array('relatoriosefluentes/producao', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosefluentes/producao"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-user"></i> Produção</span></a>
                                    </li>
                                <?php } ?>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosefluentes/monitoramentoDqo')) { ?>
                                    <li class="<?= in_array('relatoriosefluentes/monitoramentoDqo', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosefluentes/monitoramentoDqo"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-inbox"></i> Monitoramento DQO</span></a>
                                    </li>
                                <?php } ?>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosefluentes/faturamentoPendente')) { ?>
                                    <li class="<?= in_array('relatoriosefluentes/faturamentoPendente', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosefluentes/faturamentoPendente"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-inbox"></i> Faturamento Pendente</span></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php
        if ($this->usuarioLogado->temPermissao('acoes') || $this->usuarioLogado->temPermissao('acoescategorias') || $this->usuarioLogado->temPermissao('relatoriosacoes/acoesPorEnvolvido') || $this->usuarioLogado->temPermissao('relatoriosacoes/acoesPorCategoriaPeriodo')) {
            ?>
            <li class="<?= in_array('acoesmodulo', $menuAtivo) ? 'active' : ''; ?>">
                <a href="#"><i class="fa fa-lg fa-fw fa-bolt"></i> <span class="menu-item-parent">Ações</span></a>
                <ul>
                    <?php if ($this->usuarioLogado->temPermissao('acoes')) { ?>
                        <li class="<?= in_array('acoes', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("acoes"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-bolt"></i> Ações</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('acoescategorias')) { ?>
                        <li class="<?= in_array('acoescategorias', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("acoescategorias"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-tag"></i> Categorias</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('relatoriosacoes/acoesPorEnvolvido') || $this->usuarioLogado->temPermissao('relatoriosacoes/acoesPorCategoriaPeriodo')) {
                        ?>
                        <li class="<?= in_array('relatoriosacoes', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="#"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Relatórios</span></a>
                            <ul>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosacoes/acoesPorEnvolvido')) { ?>
                                    <li class="<?= in_array('relatoriosacoes/acoesPorEnvolvido', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosacoes/acoesPorEnvolvido"); ?>"><i class="fa fa-lg fa-fw fa-exchange"></i> <span class="menu-item-parent">Ações por Envolvido</span></a>
                                    </li>
                                <?php } ?>
                                <?php if ($this->usuarioLogado->temPermissao('relatoriosacoes/acoesPorCategoriaPeriodo')) { ?>
                                    <li class="<?= in_array('relatoriosacoes/acoesPorCategoriaPeriodo', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("relatoriosacoes/acoesPorCategoriaPeriodo"); ?>"><i class="fa fa-lg fa-fw fa-exchange"></i> <span class="menu-item-parent">Ações por Categoria</span></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php
        if ($this->usuarioLogado->temPermissao('monitoramentovazoesete') || $this->usuarioLogado->temPermissao('monitoramentodiarioete') || $this->usuarioLogado->temPermissao('monitoramentoriachoalgodoais') || $this->usuarioLogado->temPermissao('autocontroleefluentesliquidos') || $this->usuarioLogado->temPermissao('monitoramentosolidossuspensao') || $this->usuarioLogado->temPermissao('monitoramentoconsumoenergia') || $this->usuarioLogado->temPermissao('declaracaocargapoluidora') || $this->usuarioLogado->temPermissao('monitoramentoconsumoaguapotavel')) {
            ?>
            <li class="<?= in_array('qualidade', $menuAtivo) ? 'active' : ''; ?>">
                <a href="#"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> <span class="menu-item-parent">Qualidade</span></a>
                <ul>
                    <?php if ($this->usuarioLogado->temPermissao('resumoqualidade/index') || $this->usuarioLogado->temPermissao('resumoqualidade/dadosconstrutivosete')) { ?>
                        <li class="<?= in_array('resumoqualidade', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="#"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Resumo</span></a>
                            <ul>
                                <?php if ($this->usuarioLogado->temPermissao('resumoqualidade/index')) { ?>
                                    <li class="<?= in_array('resumoqualidade/index', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url('resumoqualidade/index'); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-table"></i> Resumo da ETE</span></a>
                                    </li>
                                <?php } ?>
                                <?php if ($this->usuarioLogado->temPermissao('resumoqualidade/dadosconstrutivosete')) { ?>
                                    <li class="<?= in_array('resumoqualidade/dadosconstrutivosete', $menuAtivo) ? 'active' : ''; ?>">
                                        <a href="<?= site_url("resumoqualidade/dadosconstrutivosete"); ?>"><i class="fa fa-lg fa-fw fa-table"></i> <span class="menu-item-parent">Dados Construtivos</span></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('monitoramentovazoesete')) { ?>
                        <li class="<?= in_array('monitoramentovazoesete', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("monitoramentovazoesete"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> Monitoramento de Vazões da ETE</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('monitoramentodiarioete')) { ?>
                        <li class="<?= in_array('monitoramentodiarioete', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("monitoramentosdiarioete"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> Monitoramento Diário da ETE</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('monitoramentoriachoalgodoais')) { ?>
                        <li class="<?= in_array('monitoramentoriachoalgodoais', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("monitoramentosriachoalgodoais"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> Monitoramento Riacho dos Algodoais</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('autocontroleefluentesliquidos')) { ?>
                        <li class="<?= in_array('autocontroleefluentesliquidos', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("autocontrolesefluentesliquidos"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> Autocontrole de Efluentes Líquidos</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('monitoramentosolidossuspensao')) { ?>
                        <li class="<?= in_array('monitoramentosolidossuspensao', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("monitoramentossolidossuspensao"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> Monitoramento de Sólidos em Suspenção</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('monitoramentoconsumoenergia')) { ?>
                        <li class="<?= in_array('monitoramentoconsumoenergia', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("monitoramentosconsumoenergia"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> Monitoramento de Consumo de Energia</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('declaracaocargapoluidora')) { ?>
                        <li class="<?= in_array('declaracaocargapoluidora', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("declaracoescargapoluidora"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> Declaração de Carga Poluidora</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($this->usuarioLogado->temPermissao('monitoramentoconsumoaguapotavel')) { ?>
                        <li class="<?= in_array('monitoramentoconsumoaguapotavel', $menuAtivo) ? 'active' : ''; ?>">
                            <a href="<?= site_url("monitoramentosconsumoaguapotavel"); ?>"><span class="menu-item-parent"><i class="fa fa-lg fa-fw fa-thumbs-o-up"></i> Monitoramento de Consumo de Água Potavel</span></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
    </ul>
</nav>