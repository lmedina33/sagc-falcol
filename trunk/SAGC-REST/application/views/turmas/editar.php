<section id="widget-grid">
    <div class="row">
        <article class="col col-xs-12 col-md-12 col-lg-12">
            <div class="jarviswidget" role="widget">
                <header>
                    <div class="jarviswidget-ctrls" role="menu">
                        <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Tela cheia">
                            <i class="fa fa-expand "></i>
                        </a>
                    </div>
                    <span class="widget-icon"><i class="fa fa-group"></i></span>
                    <h2>Turmas</h2>
                    <ul id="widget-tab-1" class="nav nav-tabs pull-right">
                        <li class="active">
                            <a data-toggle="tab" href="#hr1"> <i class="fa fa-lg fa-file"></i> <span class="hidden-mobile hidden-tablet"> Turma </span> </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#hr2"> <i class="fa fa-lg fa-calendar"></i> <span class="hidden-mobile hidden-tablet"> Agenda </span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#hr3"> <i class="fa fa-lg fa-user"></i> <span class="hidden-mobile hidden-tablet"> Alunos </span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#hr4"> <i class="fa fa-lg fa-check-square-o"></i> <span class="hidden-mobile hidden-tablet"> Presenças </span></a>
                        </li>
                    </ul>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="hr1">
                                <form id="turma-form" class="smart-form"  action="<?= base_url("turmas/editar/".$turma->getId())?>" method="post">
                                    <fieldset>                                
                                        <div class="row">
                                            <section class="col col-xs-2">
                                                <label class="label">Codigo</label>
                                                <label class="input">
                                                    <input type="text" name="codigo" value="<?= $turma->getCodigo() ?>">
                                                </label>
                                            </section>
                                            <section class="col col-xs-8">
                                                <label class="label">Nome</label>
                                                <label class="input">
                                                    <input type="text" name="nome" value="<?= $turma->getNome() ?>">
                                                </label>
                                            </section>
                                            <section class="col col-xs-2">
                                                <label class="label">Ano</label>
                                                <label class="input">
                                                    <input type="number" name="ano" value="<?= $turma->getAno() ?>">
                                                </label>
                                            </section>

                                        </div>
                                        <div class="row">
                                            <section class="col col-xs-2">
                                                <label class="label">Data Inicio</label>
                                                <label class="input">
                                                    <input type="text" id="dataInicio" mask="99/99/999" data-mask-placeholder="_" name="dataInicio" value="<?= dataObjectToStr($turma->getDataInicio()) ?>">
                                                </label>
                                            </section>
                                            <section class="col col-xs-2">
                                                <label class="label">Data Termino</label>
                                                <label class="input">
                                                    <input type="text" id="dataTermino" mask="99/99/9999" data-mask-placeholder="_" name="dataTermino" value="<?= dataObjectToStr($turma->getDataTermino()) ?>">
                                                </label>
                                            </section>
                                            <section class="col col-xs-2">
                                                <label class="label">Vagas</label>
                                                <label class="input">
                                                    <input type="number" name="vagas" value="<?= $turma->getVagas() ?>">
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-xs-12">
                                                <label class="label">Descrição</label>
                                                <label class="textarea">
                                                    <textarea row="10" name="descricao" value="<?= $turma->getDescricao() ?>"><?= $turma->getDescricao() ?></textarea>
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>
                                    <footer>
                                        <button type="submit" class="btn btn-primary">                                    
                                            <i class="fa fa-save"></i> Salvar
                                        </button>                                
                                    </footer>
                                </form>
                            </div>
                            <div class="tab-pane fade in" id="hr2" >
                                <div class="widget-body-toolbar">
                                    <div class="row">                                        
                                        <div class="col-xs-3 col-sm-7 col-md-7 col-lg-7 text-right pull-right">
                                            <button class="btn btn-success" id="button-add-aula">
                                                <i class="fa fa-plus"></i> <span class="hidden-mobile"> Aula</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <table id="aulaTable" class="table table-bordered">
                                        <thead>
                                            <tr>                                                
                                                <th>Data</th>
                                                <th>Conteúdo    </th>
                                                <th>Inicio</th>
                                                <th>Termino</th>
                                                <th>Carga Horaria</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>                                                
                                                <td>10/03/13</td>
                                                <td>Aula Introdutoria</td>
                                                <td>08:00</td>
                                                <td>16:00</td>
                                                <td>2h</td>
                                                <td>
                                                    <div class="btn-group btn-xs">
                                                        <button class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Editar</button>
                                                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Excluir</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>                                        
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="hr3">
                                <div class="widget-body-toolbar">
                                    <div class="row">                                        
                                        <div class="col-xs-3 col-sm-7 col-md-7 col-lg-7 text-right pull-right">
                                            <button class="btn btn-success" id="button-add-aluno">
                                                <i class="fa fa-plus"></i> <span class="hidden-mobile">Aluno</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-scroll table-responsive" style="height:290px; overflow-y: scroll;">
                                    <table id="alunoTable" class="table table-bordered">
                                        <thead>
                                            <tr>                                                
                                                <th>Nome</th>
                                                <th>Data Nas.</th>
                                                <th>CPF</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>                                                
                                                <td>Carlos</td>
                                                <td>24/03/1985</td>
                                                <td>070.058.194-74</td>
                                                <td>
                                                    <div class="btn-group btn-xs">
                                                        <button class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Editar</button>
                                                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Excluir</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane fade in" id="hr4" >
                                <form class="smart-form">
                                    <table id="presenca-table" style="border: 0px;">                                    
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table id=aluno-side" class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="height: 83px"><p>Alunos</p></th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                            <? foreach ($turma->getAlunos() as $aluno): ?>
                                                <tr><td><?= $aluno->getNome() ?></td></tr>
                                            <? endforeach; ?>                                                        
                                        </tbody>
                                    </table>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <table id="presenca-side" class="table table-hover">                                                    
                                            <thead>
                                                <tr class="presenca-header">
                                                    <? $totalAulas = 0 ?>
                                                    <? foreach ($turma->getAulas() as $aula): ?>
                                                        <th><span class="date"><?= dataObjectToStr($aula->getData(), false) ?></span></th>
                                                        <?$totalAulas += $aula->getCargaHoraria()?>
                                                    <? endforeach; ?>
                                                    <th>%</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? foreach ($turma->getAlunos() as $aluno): ?>
                                                    <tr>
                                                        <? $totalPresente = 0; ?>
                                                        <? foreach ($turma->getAulas() as $aula): ?>
                                                            <? $presente = ($aula->isPresente($aluno)) ? true : false; ?>
                                                            <td><label class="checkbox"><input type="checkbox" <?= ($presente) ? "checked" : "" ?> disabled><i></i></label></td>
                                                            <?
                                                            if ($presente) {
                                                                $totalPresente += $aula->getCargaHoraria();
                                                            }
                                                            ?>
                                                        <? endforeach; ?>
                                                        <td><?= number_format(($totalPresente / $totalAulas) * 100, 0) ?></td>
                                                    </tr>
                                                <? endforeach; ?>                                                        
                                            </tbody>
                                        </table> 
                                    </td>
                                    </tr>                                        
                                    </tbody>
                                    </table>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </article>
    </div>
</section>

<div id="aula-modal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow: auto;">
    <div class="modal-dialog" style="margin: 25px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 style="margin: 0;">Adicionar Aula</h3>
            </div>
            <div class="modal-body">
                <form class="smart-form" id="aula-form" action="<?= base_url("turmas/addAula") ?>" method="POST" >
                    <fieldset>
                        <div class="row">
                            <input name="turmaId" value="<?= $turma->getId() ?>" hidden>                            
                            <section class="col col-xs-4">
                                <label class="label">Data</label>
                                <label class="input">
                                    <input id="aulaData" type="text" name="data" data-mask="99/99/9999" data-mask-placeholder="_">
                                </label>
                            </section>
                            <section class="col col-xs-4">
                                <label class="label">Hora Inicio</label>
                                <label class="input">
                                    <input class="form-control" type="text" id="aulaHoraInicio" data-mask="99:99" data-mask-placeholder="_" name="inicio" data-autoclose="true">
                                </label>
                            </section>
                            <section class="col col-xs-4">
                                <label class="label">Hora Termino</label>
                                <label class="input">
                                    <input class="form-control" type="text" id="aulaHoraTermino" data-mask="99:99" data-mask-placeholder="_" name="termino" data-autoclose="true">
                                </label>
                            </section>
                        </div>
                        <div class="row">
                            <section class="col col-xs-12">
                                <label class="label">Conteúdo</label>
                                <label class="input">
                                    <input type="text" name="conteudo">
                                </label>
                            </section>
                            <section class="col col-xs-2">
                                <label class="label">Carga Horaria</label>
                                <label class="input">
                                    <input type="number" name="cargaHoraria">
                                </label>
                            </section>
                        </div>

                    </fieldset>                     
                </form>
            </div>
            <div class="modal-footer" style="margin: 0;">
                <button id="button-aula-cancelar" data-dismiss="modal" class="btn">Cancelar</button>
                <button id="button-aula-salvar" type="button" onclick="$('#aula-form').submit()" class="btn btn-primary" autocomplete="off" data-loading-text="Carregando...">Adicionar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="aula-edit-modal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow: auto;">
    <div class="modal-dialog" style="margin: 25px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 style="margin: 0;">Editar Aula</h3>
            </div>
            <div class="modal-body">
                <form class="smart-form" id="aula-edit-form" action="<?= base_url("turmas/editAula") ?>" method="POST" >
                    <fieldset>
                        <div class="row">
                            <input type="hidden" name="turmaId" value="<?= $turma->getId() ?>">
                            <input type="hidden" name="aulaId" value="">
                            <section class="col col-xs-4">
                                <label class="label">Data</label>
                                <label class="input">
                                    <input id="aulaEditData" type="text" name="data" data-mask="99/99/9999" data-mask-placeholder="_">
                                </label>
                            </section>
                            <section class="col col-xs-4">
                                <label class="label">Hora Inicio</label>
                                <label class="input">
                                    <input class="form-control" type="text" id="aulaEditHoraInicio" data-mask="99:99" data-mask-placeholder="_" name="inicio" data-autoclose="true">
                                </label>
                            </section>
                            <section class="col col-xs-4">
                                <label class="label">Hora Termino</label>
                                <label class="input">
                                    <input class="form-control" type="text" id="aulaEditHoraTermino" data-mask="99:99" data-mask-placeholder="_" name="termino" data-autoclose="true">
                                </label>
                            </section>
                        </div>
                        <div class="row">
                            <section class="col col-xs-12">
                                <label class="label">Conteúdo</label>
                                <label class="input">
                                    <input type="text" name="conteudo">
                                </label>
                            </section>
                            <section class="col col-xs-2">
                                <label class="label">Carga Horaria</label>
                                <label class="input">
                                    <input type="number" name="cargaHoraria">
                                </label>
                            </section>
                        </div>

                    </fieldset>                     
                </form>
            </div>
            <div class="modal-footer" style="margin: 0;">
                <button id="button-aula-cancelar" data-dismiss="modal" class="btn">Cancelar</button>
                <button id="button-aula-salvar" type="button" onclick="$('#aula-edit-form').submit()" class="btn btn-primary" autocomplete="off" data-loading-text="Carregando...">Editar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="aluno-modal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow: auto;">
    <div class="modal-dialog" style="margin: 25px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 style="margin: 0;">Aicionar Aluno</h3>
            </div>
            <div class="modal-body">
                <form class="smart-form" id="aluno-form" action="<?= base_url("turmas/addAluno") ?>" method="POST">
                    <fieldset>
                        <div class="row">
                            <input name="turmaId" value="<?= $turma->getId() ?>" hidden> 
                            <section class="col col-xs-12">
                                <label class="label">Aluno</label>
                                <label class="input">
                                    <select id="alunoSearch" class="select2" name="aluno" style="width: 100%">
                                        <option value="" disabled selected="">Selecionar</option>
                                        <? foreach ($alunos as $aluno): ?>
                                            <option value="<?= $aluno->getId() ?>"><?= $aluno->getNome() ?></option>
                                        <? endforeach; ?>
                                    </select>
                                </label>
                            </section>                            
                        </div>                        

                    </fieldset>                                
                </form>
            </div>
            <div class="modal-footer" style="margin: 0;">
                <button id="button-aula-cancelar" data-dismiss="modal" class="btn">Cancelar</button>
                <button id="recortar-foto-salvar" type="button" onclick="$('#aluno-form').submit()" class="btn btn-primary" autocomplete="off" data-loading-text="Carregando...">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    pageSetUp();

    function editarAulaAction() {
        $(".aula-editar").on("click", function () {
            var id = $(this).parents("tr").data("id");

            $.post("<?= base_url("turmas/getAula") ?>", {aulaId: id}, function (retorno) {
                if (!retorno.erro) {
                    $modal = $("#aula-edit-modal");
                    $form = $("#aula-edit-form");
                    
                    $form.find("input[name=aulaId]").val(retorno.dados.id);
                    $form.find("input[name=data]").val(retorno.dados.data);
                    $form.find("input[name=conteudo]").val(retorno.dados.conteudo);
                    $form.find("input[name=inicio]").val(retorno.dados.inicio);
                    $form.find("input[name=termino]").val(retorno.dados.termino);
                    $form.find("input[name=cargaHoraria]").val(retorno.dados.cargaHoraria);
                    
                    $modal.modal("show");
                } else {
                    erroDialogAlert("Falha!", "As informações da aula não foram obtidas." + retorno.mensagem);
                }
            }, "json");
        });
    }

    function removerAlunoAction() {
        $(".aluno-excluir").on("click", function () {
            var id = $(this).parents("tr").data("id");

            $.post("<?= base_url("turmas/excluirAluno") ?>", {alunoId: id, turmaId:<?= $turma->getId() ?>}, function (retorno) {
                if (!retorno.erro) {
                    sucessDialogAlert("Aluno removida", "Informações foram alteradas com sucesso.");
                    carregarAlunos();
                } else {
                    erroDialogAlert("Falha!", "As informações não poderam ser atualizadas devidos há um erro.<br>" + retorno.mensagem);
                }
            }, "json");
        });
    }

    function excluirAulaAction() {
        $(".aula-excluir").on("click", function () {
            var id = $(this).parents("tr").data("id");

            $.post("<?= base_url("turmas/excluirAula") ?>", {aulaId: id, turmaId:<?= $turma->getId() ?>}, function (retorno) {
                if (!retorno.erro) {
                    sucessDialogAlert("Aula removida", "Informações foram alteradas com sucesso.");
                    carregarAulas();
                } else {
                    erroDialogAlert("Falha!", "As informações não poderam ser atualizadas devidos há um erro.<br>" + retorno.mensagem);
                }
            }, "json");
        });
    }



    function carregarAulas() {
        $.get("<?= base_url("turmas/getAulas/" . $turma->getId()) ?>", function (retorno) {
            if (!retorno.erro) {
                var $table = $("#aulaTable tbody");
                $table.html("");
                for (i = 0; i < retorno.dados.length; i++) {
                    row = '<tr data-id="' + retorno.dados[i].id + '">';
                    row += "<td>" + retorno.dados[i].data + "</td>";
                    row += "<td>" + retorno.dados[i].conteudo + "</td>";
                    row += "<td>" + retorno.dados[i].inicio + "</td>";
                    row += "<td>" + retorno.dados[i].termino + "</td>";
                    row += "<td>" + retorno.dados[i].cargaHoraria + "</td>";
                    row += '<td>\n\
                <div class="btn-group btn-xs">\n\
                        <button class="btn btn-default btn-xs aula-editar"><i class="fa fa-pencil-square"></i> Editar</button>\n\
                        <button class="btn btn-danger btn-xs aula-excluir"><i class="fa fa-trash-o"></i> Excluir</button>\n\
                        </div></td>';
                    row += "</tr>";
                    $table.append(row);
                }
                excluirAulaAction();
                editarAulaAction();
            } else {
                erroDialogAlert("Falha!", "Não foi possivel carregar a lista de aulas");
            }
        }, "json");
    }

    function carregarAlunos() {
        $.get("<?= base_url("turmas/getAlunos/" . $turma->getId()) ?>", function (retorno) {
            if (!retorno.erro) {
                var $table = $("#alunoTable tbody");
                $table.html("");
                for (i = 0; i < retorno.dados.length; i++) {
                    row = '<tr data-id="' + retorno.dados[i].id + '">';
                    row += "<td>" + retorno.dados[i].nome + "</td>";
                    row += "<td>" + retorno.dados[i].dataNasc + "</td>";
                    row += "<td>" + retorno.dados[i].cpf + "</td>";
                    row += '<td>\n\
                <div class="btn-group btn-xs">\n\
                    <button class="btn btn-danger btn-xs aluno-excluir"><i class="fa fa-trash-o"></i> Remover</button>\n\
                        </div></td>';
                    row += "</tr>";
                    $table.append(row);
                }
                removerAlunoAction();
            } else {
                erroDialogAlert("Falha!", "Não foi possivel carregar a lista de alunos");
            }
        }, "json");
    }

    function resetAulaForm() {
        $form = $("#aula-form");
        $form.find("input[name!=turmaId]").val("");


    }

    function resetAlunoForm() {
        $form = $("#aluno-form");
        $form.find("select").select2().val(0);
    }


// Load form valisation dependency 
    loadScript("<?= base_url(); ?>assets/js/plugin/jquery-form/jquery-form.min.js", runFormValidation);
    // Registration validation script
    function runFormValidation() {

        var $turmaForm = $('#turma-form').validate({
            // Rules for form validation
            rules: {
                codigo: {
                    required: true
                },
                nome: {
                    required: true
                },
                ano: {
                    required: true
                },
                dataIncio: {
                    reuired: true
                },
                dataTermino: {
                    required: true
                },
                vagas: {
                    required: true
                },
                descricao: {
                    required: true
                }
            },
            messages: {
                codigo: {
                    required: "Preencha o codigo da turma"
                },
                nome: {
                    required: "Preencha o nome da turma"
                },
                ano: {
                    required: "Preencha o ano da turma"
                },
                dataIncio: {
                    reuired: "Prencha a data de Inicio"
                },
                dataTermino: {
                    required: "Preencha da data de termino"
                },
                vagas: {
                    required: "Preencha a quantidade de vagas"
                },
                descricao: {
                    required: "Preencha a descrição da turma"
                }
            },
            submitHandler: function (form) {
                $.post($(form).attr('action'), $(form).serialize(), function (retorno) {
                    if (!retorno.erro) {
                        sucessDialogAlert("Turma Editada", "Informações foram salvas com sucesso.");
                    } else {
                        erroDialogAlert("Falha!", "As informações não poderam ser atualizadas devidos há um erro.<br>" + retorno.mensagem);
                    }
                }, "json");
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });

        var $aulaForm = $('#aula-form').validate({
            rules: {
                turmaId: {
                    required: true
                },
                data: {
                    required: true
                },
                inicio: {
                    required: true
                },
                termino: {
                    required: true
                },
                cargaHoraria: {
                    required: true
                },
                conteudo: {
                    required: true
                }
            },
            messages: {
                turmaId: {
                    required: "Id da turma"
                },
                data: {
                    required: "Preencha a data da aula"
                },
                inicio: {
                    required: "Preencha a hora de inicio"
                },
                termino: {
                    required: "Preencha a hora de termino"
                },
                cargaHoraria: {
                    required: "Preencha a carga horaria"
                },
                conteudo: {
                    required: "Preencha o conteúdo"
                }
            },
            submitHandler: function (form) {
                $.post($(form).attr('action'), $(form).serialize(), function (retorno) {
                    if (!retorno.erro) {
                        sucessDialogAlert("Aula Cadastrado", "Informações foram salvas com sucesso.");
                        carregarAulas();
                        resetAulaForm();
                        $("#aula-modal").modal('toggle');
                    } else {
                        erroDialogAlert("Falha!", "As informações não poderam ser atualizadas devidos há um erro.<br>" + retorno.mensagem);
                    }
                }, "json");
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
        
        var $aulaEditForm = $('#aula-edit-form').validate({
            rules: {
                turmaId: {
                    required: true
                },
                aulaid:{
                    required:true
                },
                data: {
                    required: true
                },
                inicio: {
                    required: true
                },
                termino: {
                    required: true
                },
                cargaHoraria: {
                    required: true
                },
                conteudo: {
                    required: true
                }
            },
            messages: {
                turmaId: {
                    required: "Id da turma"
                },
                aulaId:{
                    required:"id da aula"
                },
                data: {
                    required: "Preencha a data da aula"
                },
                inicio: {
                    required: "Preencha a hora de inicio"
                },
                termino: {
                    required: "Preencha a hora de termino"
                },
                cargaHoraria: {
                    required: "Preencha a carga horaria"
                },
                conteudo: {
                    required: "Preencha o conteúdo"
                }
            },
            submitHandler: function (form) {
                $.post($(form).attr('action'), $(form).serialize(), function (retorno) {
                    if (!retorno.erro) {
                        sucessDialogAlert("Aula Editada", "Informações foram salvas com sucesso.");
                        carregarAulas();
                        resetAulaForm();
                        $("#aula-edit-modal").modal('toggle');
                    } else {
                        erroDialogAlert("Falha!", "As informações não poderam ser atualizadas devidos há um erro.<br>" + retorno.mensagem);
                    }
                }, "json");
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });

        var $alunoForm = $('#aluno-form').validate({
            rules: {
                aluno: {
                    required: true
                }
            },
            messages: {
                aluno: {
                    required: ""
                }
            },
            submitHandler: function (form) {
                $.post($(form).attr('action'), $(form).serialize(), function (retorno) {
                    if (!retorno.erro) {
                        sucessDialogAlert("Aluno Cadastrado", "Informações foram salvas com sucesso.");
                        resetAlunoForm();
                        carregarAlunos();
                        $("#aluno-modal").modal('toggle');
                    } else {
                        erroDialogAlert("Falha!", "As informações não poderam ser atualizadas devidos há um erro.<br>" + retorno.mensagem);
                    }
                }, "json");
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
    }

    loadScript("<?= base_url(); ?>assets/js/plugin/clockpicker/clockpicker.min.js", runClockPicker);
    function runClockPicker() {
        $('#aulaHoraInicio').clockpicker({
            placement: 'bottom',
            donetext: 'Done'
        });
        $('#aulaHoraTermino').clockpicker({
            placement: 'bottom',
            donetext: 'Done'
        });
        
        $('#aulaEditHoraInicio').clockpicker({
            placement: 'bottom',
            donetext: 'Done'
        });
        $('#aulaEditHoraTermino').clockpicker({
            placement: 'bottom',
            donetext: 'Done'
        });
    }




    $("#button-add-aula").on("click", function () {
        $("#aula-modal").modal("show");
    });

    $("#button-add-aluno").on("click", function () {
        $("#aluno-modal").modal("show");
    });

    $('#aulaData').datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        minDate: "01/01/1900",
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        onSelect: function (selectedDate) {
            $('#finishdate').datepicker('option', 'minDate', selectedDate);
        }
    });
    
    $('#aulaEditData').datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        minDate: "01/01/1900",
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        onSelect: function (selectedDate) {
            $('#finishdate').datepicker('option', 'minDate', selectedDate);
        }
    });

    $('#dataInicio').datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        minDate: "01/01/1900",
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        onSelect: function (selectedDate) {
            $('#finishdate').datepicker('option', 'minDate', selectedDate);
        }
    });

    $('#dataTermino').datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        minDate: "01/01/1900",
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        onSelect: function (selectedDate) {
            $('#finishdate').datepicker('option', 'minDate', selectedDate);
        }
    });
    
    

    carregarAulas();
    carregarAlunos();

</script>

<style>

    #presenca-table{
        width: 100%
    }

    #aluno-side tr th{
        height: 100px
    }

    #aluno-side tr td{
        height: 21px

    }

    #presenca-side {}

    #presenca-side .presenca-header{
        height: 100px;
    }
    #presenca-side .presenca-header th{
        width: 20px;
    }

    #presenca-side tr td{
        height: 18px
    }

    #presenca-side .presenca-header .date{ 

        position: absolute;
        top: 84px;

        /* Safari */
        -webkit-transform-origin: 0 0;
        -webkit-transform: rotate(-90deg);            


        /* Firefox */
        -moz-transform: rotate(-90deg);

        /* IE */
        -ms-transform: rotate(-90deg);

        /* Opera */
        -o-transform: rotate(-90deg);

        /* Internet Explorer */
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);

        font-family: Arial;
    }
</style>