<?

function pageHeader() { ?>
    <style>
        .telefones .input input + input{ margin-top: 5px; }
        .jcrop-keymgr{ visibility: hidden; }
    </style>
<? } ?>



<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-10">
            <div class="jarviswidget" role="widget">
                <header role="heading">
                    <div class="jarviswidget-ctrls" role="menu">
                        <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Tela cheia">
                            <i class="fa fa-expand "></i>
                        </a>
                    </div>
                    <span class="widget-icon"><i class="fa fa-user"></i></span>
                    <h2> 
                        <?
                        if ($usuarioLogado->temPermissao('administracao/alunos', true)) {
                            print "Editar";
                        } else {
                            print "Visualizar";
                        }
                        ?> Usuário
                    </h2>
                </header>                
                <div role="content">
                    <? if (isset($mensagem)): ?>
                        <div class="alert alert-block <?php
                        if ($erro) {
                            print "alert-danger";
                        } else {
                            print "alert-success";
                        }
                        ?>">
                            <a class="close" data-dismiss="alert" href="#">×</a>
                            <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Validação</h4>
                            <p>
                                <?= $mensagem; ?>
                            </p>
                        </div>
                    <? endif; ?>
                    <div class="widget-body no-padding">
                        <form action="<?= site_url("alunos/editar/" . $aluno->getId()); ?>" id="checkout-form" method="post" class="smart-form" novalidate="novalidate">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-xs-12 col-md-4">
                                        <label class="control-label" for="input-foto">Foto</label>
                                        <div id="foto-controls" class="controls">
                                            <? if (isset($_POST['foto']) || $aluno->getFoto() != ''): ?>
                                                <div class="thumbnail" style="width:150px; border-radius: 0px;">
                                                    <input type="hidden" name="foto" value="<?
                                                    if (!empty($_POST['foto'])) {
                                                        print $_POST['foto'];
                                                    } else {
                                                        print $aluno->getFoto();
                                                    }
                                                    ?>">
                                                    <img src="<?
                                                    print base_url("uploads/alunos");
                                                    print "/";
                                                    if (!empty($_POST['foto'])) {
                                                        print $_POST['foto'];
                                                    } else {
                                                        print $aluno->getFoto();
                                                    }
                                                    ?>" alt="">
                                                    <div class="caption">
                                                        <a id="excluir-foto" class="btn btn-danger" style="padding: 1px 4px;">Remover</a>
                                                    </div>
                                                </div>
                                            <? else: ?>
                                                <input class="input-file" id="input-foto" type="file" name="foto">
                                            <? endif; ?>
                                        </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-xs-12 col-md-12 requerido">
                                        <label class="label">Nome</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-user"></i>
                                            <input type="text" name="nome" value="<?= isset($_POST["nome"]) ? $_POST["nome"] : $aluno->getNome() ?>">
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-xs-12 col-md-3 requerido">
                                        <label class="label">Nascimento</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-calendar"></i>
                                            <input type="text" id="dataNasc" data-mask="99/99/9999" name="dataNascimento" value="<?= isset($_POST["dataNascimento"]) ? $_POST["dataNascimento"] : $aluno->getDataNascimento()->format('d/m/Y') ?>">
                                        </label>
                                    </section>  
                                    <section class="col col-xs-12 col-md-3 requerido">
                                        <label class="label">CPF</label>
                                        <label class="input">
                                            <input type="text" name="cpf" placeholder="CPF" data-mask="999.999.999-99" data-mask-placeholder="_" value="<?= isset($_POST["cpf"]) ? $_POST["cpf"] : $aluno->getCpf() ?>"> 
                                        </label>
                                    </section>
                                    <section class="col col-xs-3">
                                        <label class="label">RG</label>
                                        <label class="input">
                                            <input type="text" name="rgNumero" placeholder="RG" value="<?=  $aluno->getRg()?>">
                                        </label>
                                    </section>
                                    <section class="col col-xs-2">
                                        <label class="label">Orgão Emissor</label>
                                        <label class="input">
                                            <input type="text" name="rgOrgaoEmissor" placeholder="Orgão Emissor" value="<?= $aluno->getRgOrgaoEmissor()?>">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-xs-2">
                                        <label class="label">CNH Nº</label>
                                        <label class="input">
                                            <input type="text" name="cnhNumero" value="<?= $aluno->getCnh()?>">
                                        </label>
                                    </section>
                                    <section class="col col-xs-2">
                                        <label class="label">CNH Categoria</label>
                                        <label class="input">
                                            <select style=" width:100%" class="select2" name="cnhCategoria">
                                                <option value="">Selecionar</option>
                                                <? foreach (cnhCategorias() as $key => $value): ?>
                                                    <option value="<?= $key ?>" <?=($aluno->getCnhCategoria()==$key)?"selected":""?>><?= $value ?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-xs-6 col-md-4">
                                        <label class="label">Telefone</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-phone"></i>
                                            <input type="text" name="telefone" value="<?= isset($_POST["telefone"]) ? $_POST["telefone"] : $aluno->getTelefone() ?>" data-mask="(99)9999-9999">
                                        </label>                                        
                                    </section>
                                    <section class="col col-xs-6 col-md-4">
                                        <label class="label">Celular</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-phone"></i>
                                            <input type="text" name="celular" value="<?= isset($_POST["celular"]) ? $_POST["celular"] : $aluno->getCelular() ?>" data-mask="(99)9999-9999">
                                        </label>                                        
                                    </section>
                                    <section class="col col-md-4 requerido">
                                        <label class="label">Email</label>
                                        <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
                                            <input type="email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : $aluno->getEmail() ?>">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-xs-4">
                                        <label class="label">Participa de Cooperativa de Taxistas?</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="cooperativa" value="1" <?=(!is_null($aluno->getCooperativa()) && ($aluno->getCooperativa()==true))?"checked":""?>>
                                            <i></i> Sim
                                            
                                        </label>                                        
                                    </section>
                                    <section class="col col-xs4">
                                        <label class="label">Nome da Cooperativa</label>
                                        <label class="input">                                            
                                            <input type="text" name="cooperativaNome" value="<?= $aluno->getCooperativaNome()?>">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>                                
                                <div class="row">
                                    <section class="col col-xs-12 col-md-10 requerido">
                                        <label class="label">Logradouro</label>
                                        <label class="input"> 										
                                            <input type="text" name="logradouro" value="<?= isset($_POST["logradouro"]) ? $_POST["logradouro"] : $aluno->getEndereco()->getLogradouro() ?>">
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-2 requerido">
                                        <label class="label">Nº</label>
                                        <label class="input">
                                            <input type="text" name="numero" value="<?= isset($_POST["numero"]) ? $_POST["numero"] : $aluno->getEndereco()->getNumero() ?>">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-xs-12 col-md-6 requerido">
                                        <label class="label">Bairro</label>
                                        <label class="input">
                                            <input type="text" name="bairro" value="<?= isset($_POST["bairro"]) ? $_POST["bairro"] : $aluno->getEndereco()->getBairro() ?>" >
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-6 requerido">
                                        <label class="label">Estado</label>
                                        <label class="input">
                                            <select class="select2" data-select-search="true" name="estadoId">
                                                <option value="0" selected="" disabled="">Selecione o estado</option>
                                                <?php foreach ($estados as $estado): ?>
                                                    <option value="<?= $estado->getId(); ?>"
                                                    <?
                                                    if (isset($_POST['estadoId'])) {
                                                        if ($estado->getId() == $_POST['estadoId']) {
                                                            print 'selected';
                                                        }
                                                    } else {
                                                        if ($estado->getId() == $estadoId) {
                                                            print 'selected';
                                                        }
                                                    }
                                                    ?>
                                                            ><?= $estado->getNome(); ?></option>
                                                        <?php endforeach; ?>                                                
                                            </select>
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-xs-12 col-md-6">
                                        <label class="label">Complemento</label>
                                        <label class="input">
                                            <input type="text" name="complemento" value="<?= isset($_POST["complemento"]) ? $_POST["complemento"] : $aluno->getEndereco()->getComplemento() ?>"> 
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-6 requerido">
                                        <label class="label">Cidade</label>
                                        <label class="input">
                                            <select name="cidadeId" class="select2" data-select-search="true">
                                                <option value="" selected="" >Selecione a cidade</option>
                                                <?php foreach ($cidades as $cidade): ?>
                                                    <option value="<?= $cidade->getId(); ?>" <?
                                                    if (isset($_POST['cidadeId'])) {
                                                        if ($cidade->getId() == $_POST['cidadeId']) {
                                                            print 'selected';
                                                        }
                                                    } else {
                                                        if (!is_null($cidadeId) && $cidade->getId() == $cidadeId) {
                                                            print 'selected';
                                                        }
                                                    }
                                                    ?>><?= $cidade->getNome(); ?></option>                                                
                                                        <?php endforeach; ?>
                                            </select>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">                                  
                                    <section class="col col-xs-12 col-md-6">
                                        <label class="label">CEP</label>
                                        <label class="input">
                                            <input type="text" name="cep" data-mask="99999-999" data-mask-placeholder="_" value="<?= isset($_POST["cep"]) ? $_POST["cep"] : $aluno->getEndereco()->getCep() ?>">
                                        </label>
                                    </section>
                                </div>  
                            </fieldset>
                            <footer>
                                <small>Cadastrado em: <?= $aluno->getDataRegistro()->format('d') . ' de ' . mesNumeroParaNome($aluno->getDataRegistro()->format('m')) . ' de ' . $aluno->getDataRegistro()->format('Y') ?></small>
                                <? if ($usuarioLogado->temPermissao('administracao/alunos', true)) { ?>
                                    <button type="submit" class="btn btn-primary">                                    
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                <? } ?>
                            </footer>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
    
    <div id="recortar-foto" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow: auto;">
    <div class="modal-dialog" style="margin: 25px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 style="margin: 0;">Recortar Foto</h3>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer" style="margin: 0;">
                <a id="recortar-foto-cancelar" href="#" class="btn btn-default">Cancelar</a>
                <button id="recortar-foto-salvar" type="button" class="btn btn-primary" autocomplete="off" data-loading-text="Carregando...">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
    <?php $timestamp = time(); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/js/plugin/uploadifive/uploadifive.css")?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/jquery.Jcrop.min.css")?>">

<script type="text/javascript">
    pageSetUp();

    var jcrop_api = null;
    var fotoFilename = null;
    var uuid = createUUID();
    
    loadScript("<?=  base_url("assets/js/plugin/jcrop/jquery.Jcrop.min.js")?>",null);
    loadScript("<?=  base_url("assets/js/plugin/jcrop/jquery.color.min.js")?>",null);
    
    // Load form valisation dependency 
    loadScript("<?= base_url(); ?>assets/js/plugin/uploadifive/jquery.uploadifive.min.js", ativarUploadiFive);
    
    

    function ativarUploadiFive() {
        $("#input-foto").uploadifive({
            uploadScript: '<?= base_url('assets/js/plugin/uploadifive/uploadifive.php'); ?>',
            formData: {targetFileName: uuid,
                targetFolderName: 'alunos',
                timestamp: '<?php echo $timestamp; ?>',
                token: '<?php echo md5('unique_salt' . $timestamp); ?>'},
            multi: false,
            width: 130,
            height: 24,
            fileSizeLimit: '10MB',
            fileExt: '*.jpg;',
            fileDesc: 'Arquivo de foto (.jpg)',
            buttonText: '<i class="fa fa-upload"></i> Selecionar Foto',
            onUploadComplete: function (file) {
                $("#loading-label").css('display', 'block');
                var ext = file.name.match(/(\..+?)$/)[1];
                var image = new Image();
                fotoFilename = uuid + ext;

                image.src = "<?= base_url("uploads/alunos"); ?>/" + uuid + ext + "?t=" + new Date().getTime();

                image.onload = function () {
                    $("#loading-label").css('display', 'none');
                    var maxWidth = window.innerWidth - 60;
                    var maxHeight = window.innerHeight - 170;

                    var width = image.width;
                    var height = image.height;

                    while (width > maxWidth || height > maxHeight) {
                        height = height * (width - 10) / width;
                        width -= 10;
                    }

                    $(image).css('width', width);
                    $(image).css('height', height);
                    image.width = width;
                    image.height = height;

                    $("#recortar-foto .modal-dialog").css('width', width);
                    $("#recortar-foto .modal-body").css('padding', 0);
                    $("#recortar-foto .modal-body").css('max-height', 'none');
                    $("#recortar-foto .modal-body").css('overflow', 'hidden');
                    $("#recortar-foto .modal-body").html(image);
                    $("#recortar-foto").modal('show');
                }
            }
        });
    }

    function createUUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        }) + '-' + new Date().getTime();
    }

    $(document).on('click', '#excluir-foto', function () {
        $("#foto-controls").html('<input class="input-file" id="input-foto" type="file" name="foto">');
        ativarUploadiFive();
    });
    
    $("#recortar-foto").modal({
        keyboard: false,
        show: false
    });
    
    $("#recortar-foto").on('show.bs.modal', function () {
        $("#recortar-foto .modal-body > img").Jcrop({
            setSelect: [20, 20, parseInt($("#recortar-foto .modal-body > img").css("width"), 10) - 20, parseInt($("#recortar-foto .modal-body > img").css("height"), 10) - 20],
            aspectRatio: 150 / 150,
            minSize: [150, 150]
        }, function () {
            jcrop_api = this;
        });
    });
    
    $("#recortar-foto-cancelar").click(function () {
        $("#recortar-foto").modal('hide');
    });
    
    $("#recortar-foto-salvar").click(function () {
        $(this).button('loading');
        $("#recortar-foto-cancelar").hide();
        var jcropSelect = jcrop_api.tellSelect();
        var molduraWidth = parseInt($("#recortar-foto .modal-body > img").css("width"), 10);
        var molduraHeight = parseInt($("#recortar-foto .modal-body > img").css("height"), 10);
        var realWidth = $("#recortar-foto .modal-body > img")[0].naturalWidth;
        var f = $("#recortar-foto .modal-body > img")[0].naturalWidth / molduraWidth;
        $.post("<?= site_url('alunos/recortarRedimensionarFotoJson') ?>", {filename: fotoFilename, top: f * jcropSelect.y, right: f * (molduraWidth - jcropSelect.x2), bottom: f * (molduraHeight - jcropSelect.y2), left: f * jcropSelect.x}, function (retorno) {
            $("#recortar-foto-salvar").button('reset');
            $("#recortar-foto-cancelar").show();
            if (retorno.sucesso) {
                $("#recortar-foto").modal('hide');
                $("#foto-controls").html("<div class=\"thumbnail\" style=\"width:150px; border-radius: 0px;\">\
                                <input type=\"hidden\" name=\"foto\" value=\"" + fotoFilename + "\">\
                                <img src=\"<?= base_url("uploads/alunos") ?>/" + fotoFilename + "?t=" + new Date().getTime() + "\" alt=\"\">\
                                <div class=\"caption\">\
                                    <a id=\"excluir-foto\" class=\"btn btn-danger\" style=\"padding: 1px 4px;\">Remover</a>\
                                </div>\
                            </div>");
            }
        }, 'json');
    });

<? if (!$usuarioLogado->temPermissao('administracao/usuarios', true)) { ?>
        desabilitarFormulario();
<? } ?>


    // Load form valisation dependency 
    loadScript("<?= base_url(); ?>assets/js/plugin/jquery-form/jquery-form.min.js", runFormValidation);

    // Registration validation script
    function runFormValidation() {

        var $checkoutForm = $('#checkout-form').validate({
            // Rules for form validation
            rules: {
                nome: {
                    required: true
                },
                dataNascimento: {
                    required: true
                },
                telefone: {
                    required: true
                },
                celular: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                cpf: {
                    required: true
                },
                rgNumero: {
                    required: true
                },
                rgOrgaoEmissor: {
                    required: true
                },
                cnhNumero: {
                    required: true
                },
                cnhCategoria: {
                    required: true
                },
                cooperativa: {
                    required: false
                },
                cooperativaNome: {
                    reuiqred: false
                },
                logradouro: {
                    required: true
                },
                numero: {
                    required: true
                },
                bairro: {
                    required: true
                },
                estadoId: {
                    required: true
                },
                cidadeId: {
                    required: true
                },
                cep: {
                    required: false
                }

            },
            // Messages for form validation
            messages: {
                nome: {
                    required: "Por favor, digite o nome"
                },
                dataNascimento: {
                    required: "Por favor, digite a data de nascimento do Aluno"
                },
                telefone: {
                    required: "Por favor, digite um telefone para contato"
                },
                celular: {
                    required: "Por favor, digite um celular para contato"
                },
                email: {
                    required: "Por favor, digite o e-mail do Aluno",
                    email: "Por favor, digite um e-mail válido"
                },
                cpf: {
                    required: "Por favor, digite o CPF do Aluno"
                },
                rgNumero: {
                    required: "Por favor,digite o Nº do RG do Aluno"
                },
                rgOrgaoEmissor: {
                    required: "Por favor, digite o orgão emissor do RG"
                },
                cnhNumero: {
                    required: "Por favor, digite o Nº do CNH"
                },
                cnhCategoria: {
                    required: "Por favor, selecione a categoria do CNH"
                },
                logradouro: {
                    required: "Por favor, digite o logradouro em que o Aluno reside"
                },
                numero: {
                    required: "Por favor, digite o número da residência em que o Aluno reside"
                },
                bairro: {
                    required: "Por favor, digite o bairro em que o Aluno reside"
                },
                estadoId: {
                    required: "Por favor, digite o estado em que o Aluno reside"
                },
                cidadeId: {
                    required: "Por favor, digite a cidade em que o Aluno reside"
                }
            },
            submitHandler: function (form) {
                $.post($(form).attr('action'), $(form).serialize(), function (retorno) {
                    if (!retorno.erro) {
                        sucessDialogAlert("Usuário Atualizado", "Informações atualizadas com sucesso.");
                    } else {
                        erroDialogAlert("Falha!", "As informações não poderam ser atualizadas devidos há um erro.");
                    }
                }, "json");
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
        // START AND FINISH DATE
        $('#dataNasc').datepicker({
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
    }

</script>
