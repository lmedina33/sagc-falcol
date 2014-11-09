<a class="btn btn-primary pull-left" href="<?= site_url('familias/painel/' . $familia->getId()) ?>">
    <i class="fa fa-dashboard"></i> Painel
</a>
<ul class="dashboard-menu-list">
    <li>
        <a title="Pessoa de Referência" href="<?= site_url('familias/editarresponsavel/' . $familia->getId()) ?>" class="btn btn-warning btn-circle btn-xl"><i class="fa fa-user"></i></a>
    </li>
    <li>
        <a title="Composição Familiar" href="<?= site_url('familias/editarmembros/' . $familia->getId()) ?>" class="btn btn-warning btn-circle btn-xl"><i class="fa fa-users"></i></a>
    </li>
    <li>
        <a title="Endereço da Família" href="<?= site_url('familias/editarendereco/' . $familia->getId()) ?>" class="btn btn-warning btn-circle btn-xl"><i class="glyphicon glyphicon-map-marker"></i></a>
    </li>
    <li>
        <a title="Condições Habitacionais" href="<?= site_url('condicoeshabitacionais/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="glyphicon glyphicon-home"></i></a>
    </li>
    <li>
        <a title="Condições Educacionais" href="<?= site_url('condicoeseducacionais/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-graduation-cap"></i></a>
        <a href="<?= site_url('condicoeseducacionais/index/' . $familia->getId()) ?>" class="rotulo-item"></a>
    </li>
    <li>
        <a title="Condições de Trabalho e Rendimentos" href="<?= site_url('condicoestrabalhorendimentos/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="glyphicon glyphicon-usd"></i></a>
    </li>
    <li>
        <a title="Condições de Saúde" href="<?= site_url('condicoessaude/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-stethoscope"></i></a>
    </li>
    <li>
        <a title="Acesso a Benefícios Eventuais" href="<?= site_url('acessobeneficioseventuais/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-list"></i></a>
    </li>
    <li>
        <a title="Convivência Familiar e Comunitária" href="<?= site_url('convivenciasfamiliarcomunitaria/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-users"></i></a>
    </li>
    <li>
        <a title="Participação em Serviços, Programas ou Projetos" href="<?= site_url('servicosprogramasprojetos/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-sitemap"></i></a>
    </li>
    <li>
        <a title="Situações de Violência e Violações de Direitos" href="<?= site_url('situacaoviolenciaviolacoesdireitos/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-chain-broken"></i></a>
    </li>
    <li>
        <a title="Histórico de Cumprimento de Medidas Socioeducativas" href="<?= site_url('historicocumprimentomedidassocioeducativas/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-history"></i></a>
    </li>
    <li>
        <a title="Histórico de Acolhimento Institucional ou Familiar" href="<?= site_url('historicoacolhimentoinstitucionalfamiliar/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-undo"></i></a>
    </li>
    <li>
        <a title="Planejamento e Evolução do Acompanhamento Familiar" href="<?= site_url('planejamentoevolucaoacompanhamentofamiliar/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-hand-o-right"></i></a>
    </li>
    <li>
        <a title="Controle dos Encaminhamentos Realizados no Processo de Acompanhamento" href="<?= site_url('controleencaminhamentos/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-check-square-o"></i></a>
    </li>
    <li>
        <a title="Regitro Simplificado dos Atendimentos" href="<?= site_url('atendimentossimplificados/index/' . $familia->getId()) ?>" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-archive"></i></a>
    </li>
</ul>