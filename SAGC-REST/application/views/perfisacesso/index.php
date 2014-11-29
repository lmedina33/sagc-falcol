<? if (isset($_GET["mensagem"])): ?>
    <div class="alert alert-success">
        <a class="close" data-dismiss="alert" href="#">×</a>
        <p>
            <?= $_GET["mensagem"] ?>
        </p>
    </div>
<? endif; ?>
<div id="perfisacesso-index">
    <? if ($usuarioLogado->temPermissao('perfisacesso', true)) { ?>
        <a href="#perfisacesso/novo" class="btn btn-info btn-md pull-right header-btn hidden-mobile"><i class="icon-plus"></i> Novo Perfil de Acesso</a>
    <? } ?>
    <h1>Todos os Perfis de Acesso</h1>
    <div class="form-actions filtros" style="margin: 20px 0 10px; padding: 10px; border: none; background: #f0f0f0;">
        <form class="form-inline" method="get" action="<?= site_url("perfisacesso"); ?>">
            <label>Nome: <input type="text" class="form-control" name="nome" value="<?= empty($_GET['nome']) ? '' : $_GET['nome'] ?>"></label> 
            <button class="btn btn-default" type="submit"><i class="icon-filter"></i> Filtrar</button>
        </form>
    </div>
    <? if (count($perfisacesso) == 0) { ?>
        <p>Não foi encontrado nenhum resultado para esta consulta.</p>
    <? } elseif (count($perfisacesso) == 1) { ?>
        <p>Foi encontrado um resultado para esta consulta.</p>
    <? } else { ?>
        <p>Foram encontrados <?= count($perfisacesso); ?> resultados para esta consulta.</p>
    <? } ?>
    <table class="table table-striped tablesorter">
        <thead>
            <tr>
                <th class="header">Perfil</th>
                <th class="header" width="160">Ações</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($perfisacesso as $perfilacesso):
                ?>
                <tr>
                    <td><?= $perfilacesso->getNome(); ?></td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-default" href="#perfisacesso/editar/<?= $perfilacesso->getId() ?>">
                                <?
                                if ($usuarioLogado->temPermissao('perfisacesso', true)) {
                                    print 'Editar';
                                } else {
                                    print 'Visualizar';
                                }
                                ?>
                            </a>
                            <? if ($usuarioLogado->temPermissao('perfisacesso', true)) { ?>
                                <a class="btn btn-xs btn-danger excluir" data-id="<?= $perfilacesso->getId(); ?>">Excluir</a>
                            <? } ?>
                        </div>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="paginacao"><?= $this->pagination->create_links(); ?></th>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    function onReady() {
        $('.excluir').click(function (e) {
            var tr = $(this).parent().parent().parent();
            var id = $(this).data('id');

            $.SmartMessageBox({
                title: "<i class='fa fa-question-circle txt-color-orangeDark'></i> Excluir Perfil de Acesso?",
                buttons: '[Não][Sim]'

            }, function (ButtonPressed) {
                if (ButtonPressed == "Sim") {
                    $.post('<?= site_url("perfisacesso/excluir") ?>', {id: id}, function (dados) {
                        if (dados.erro) {
                            $.SmartMessageBox({
                                title: "<i class='fa fa-warning txt-color-orangeDark'></i> Aviso!",
                                content: "" + dados.mensagem + "",
                                buttons: '[Ok]'
                            });
                        } else {
                            $('#alert-box').hide();
                            tr.remove();
                            $('#alert-box').addClass('alert-success');
                            $('.nota').html('<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Sucesso!</h4>' + dados.mensagem + '');
                            $('#alert-box').slideDown('slow');
                            setTimeout(function () {
                                $('#alert-box').slideUp('slow');
                                $('.nota').html("");
                            }, 15000);
                        }
                    }, 'json');
                }
            });
            e.preventDefault();
        });
    }
</script>
