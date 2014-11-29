
<div class="alert alert-block <?= isset($_GET["sucesso"]) ? "alert-success" : "" ?>" id="alert-box" <?= isset($_GET["sucesso"]) ? '' : 'style="display:none;"' ?> >
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="nota">
        <? if (isset($_GET["mensagem"])) : ?>
            <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Sucesso!</h4>
            <?= $_GET["mensagem"] ?>
        <? endif; ?>
    </div>
</div>

<section id="widget-grid" class="">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-sortable" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false" data-widget-custombutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"><i class="fa fa-user"></i></span>
                    <h2>Alunos</h2>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar bg-color-white">
                            <div class="row">
                                <div class="col-sm-12 col-md-10">
                                    <form class="form-inline" role="form" action="<?= site_url('alunos') ?>" method="get">
                                        <div class="form-group">
                                            <label class="sr-only">NOME</label>
                                            <input type="text" value="<?= isset($_GET['nome']) ? $_GET['nome'] : ""; ?>"class="form-control input-sm" name="nome" placeholder="NOME">
                                        </div>                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-info">
                                                <i class="fa fa-search"></i> FILTRAR
                                            </button>
                                        </div>
                                    </form>
                                    <p class="resultText"><?= buscaQuantText($alunos) ?></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2 text-align-right">
                                    <? if ($usuarioLogado->temPermissao('administracao/alunos', true)) { ?>
                                        <a href="#alunos/novo" class="btn btn-primary btn-md pull-right header-btn hidden-mobile">
                                            <i class="fa fa-plus-circle"></i> Adicionar</a>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr> 
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>                                    
                                    <th>CPF</th>
                                    <th>CNH</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($alunos as $aluno): ?>
                                    <tr>
                                        <td><?= $aluno->getId();?></td>
                                        <td><?= $aluno->getNome(); ?></td>
                                        <td><?= $aluno->getEmail(); ?></td>
                                        <td><?= $aluno->getCpf()?></td>
                                        <td><?= $aluno->getCnh()?></td>
                                        <td><?= cnhCategorias()[$aluno->getCnhCategoria()]?></td>                                        
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-default" href="<?="#alunos/editar/{$aluno->getId()}"?>">
                                                    <?
                                                    if ($usuarioLogado->temPermissao('administracao/alunos', true)) {
                                                        print '<i class="fa fa-pencil"></i> Editar';
                                                    } else {
                                                        print '<i class="fa fa-eye"></i> Visualizar';
                                                    }
                                                    ?>
                                                </a>
                                                <? if ($usuarioLogado->temPermissao('administracao/alunos', true)) { ?>
                                                    <a class="excluir btn btn-sm btn-danger" data-id="<?= $aluno->getId() ?>"><i class="fa fa-trash-o"></i> Excluir</a>
                                                <? } ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" class="paginacao"><?= $this->pagination->create_links(); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                        <? if (count($alunos) <= 0): ?>
                            <div class="col col-12">
                                <p class="text-align-center">Não há resultados</p>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<script>
    pageSetUp();

    var url = '<?= site_url('alunos/excluir'); ?>';

    $(document).ready(function () {
        $('.excluir').click(function (e) {
            tr = $(this).parent().parent().parent();
            id = $(this).data('id');

            $.SmartMessageBox({
                title: "<i class='fa fa-question-circle txt-color-orangeDark'></i> Excluir Usuário<span class='txt-color-orangeDark'><strong>" +
                        $('#show-shortcut')
                        .text() + "</strong></span> ?",
                buttons: '[Não][Sim]'

            }, function (ButtonPressed) {
                if (ButtonPressed == "Sim") {
                    $.post(url, {id: id}, function (dados) {
                        if (dados.erro) {
                            $.SmartMessageBox({
                                title: "<i class='fa fa-warning txt-color-orangeDark'></i> Aviso<span class='txt-color-orangeDark'><strong>" +
                                        $('#show-shortcut')
                                        .text() + "</strong></span>!",
                                content: "" + dados.mensagem + "",
                                buttons: '[Ok]'
                            });
                        } else {
                            $('#alert-box').hide();
                            tr.remove();
                            $('#alert-box').addClass('alert-success');
                            $('.nota').html('<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Sucesso!</h4>\
                                                     ' + dados.mensagem + '');
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

    });
</script>