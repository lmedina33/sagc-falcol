


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
                    <h2>Novo Usuário</h2>
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
                        <form action="<?= site_url("usuarios/novo"); ?>" id="checkout-form" method="post" class="smart-form" novalidate="novalidate">
                            <fieldset>                                
                                <div class="row">
                                    <section class="col col-xs-12 col-md-12 requerido">
                                        <label class="label">Nome</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-user"></i>
                                            <input type="text" name="nome" value="<?= isset($_POST["nome"]) ? $_POST["nome"] : "" ?>">
                                        </label>
                                    </section>  
                                </div>
                                <div class="row">
                                    <section class="col col-xs-12 col-md-4 requerido">
                                        <label class="label">Nascimento</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-calendar"></i>
                                            <input type="text" id="dataNasc" name="dataNascimento" value="<?= isset($_POST["dataNascimento"]) ? $_POST["dataNascimento"] : "" ?>">
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-4 requerido">
                                        <label class="label">CPF</label>
                                        <label class="input">
                                            <input type="text" name="cpf" placeholder="CPF" data-mask="999.999.999-99" data-mask-placeholder="_" value="<?= isset($_POST["cpf"]) ? $_POST["cpf"] : "" ?>"> 
                                        </label>
                                    </section>
                                </div> 

                                <div class="row">                                    
                                    <section class="col col-xs-6 col-md-4">
                                        <label class="label">Telefone</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-phone"></i>
                                            <input type="text" name="telefone" value="<?= isset($_POST["telefone"]) ? $_POST["telefone"] : "" ?>" data-mask="(99)9999-9999" data-mask-placeholder="_">
                                        </label>                                        
                                    </section>
                                    <section class="col col-xs-6 col-md-4">
                                        <label class="label">Celular</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-phone"></i>
                                            <input type="text" name="celular" value="<?= isset($_POST["celular"]) ? $_POST["celular"] : "" ?>" data-mask="(99)9999-9999" data-mask-placeholder="_">
                                        </label>                                        
                                    </section>
                                    <section class="col col-xs-12 col-md-4 requerido">
                                        <label class="label">Email</label>
                                        <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
                                            <input type="email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>">
                                        </label>
                                    </section>
                                </div>                                
                            </fieldset>

                            <fieldset>
                                <legend>Endereço</legend>
                                <div class="row">
                                    <section class="col col-xs-12 col-md-10 requerido">
                                        <label class="label">Logradouro</label>
                                        <label class="input"> 										
                                            <input type="text" name="logradouro" value="<?= isset($_POST["logradouro"]) ? $_POST["logradouro"] : "" ?>">
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-2 requerido">
                                        <label class="label">Nº</label>
                                        <label class="input">
                                            <input type="text" name="numero" value="<?= isset($_POST["numero"]) ? $_POST["numero"] : "" ?>">
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-xs-12 col-md-6 requerido">
                                        <label class="label">Bairro</label>
                                        <label class="input">
                                            <input type="text" name="bairro" value="<?= isset($_POST["bairro"]) ? $_POST["bairro"] : "" ?>" >
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-6 requerido">
                                        <label class="label">Estado</label>
                                        <label class="input">
                                            <select class="select2" style="width:100%" data-select-search="true" name="estadoId">
                                                <option value="0" selected="" disabled="">Selecione o estado</option>
                                                <?php foreach ($estados as $estado): ?>
                                                    <option value="<?= $estado->getId(); ?>" <?
                                                    if (isset($_POST['estadoId'])) {
                                                        if ($estado->getId() == $_POST['estadoId']) {
                                                            print 'selected';
                                                        }
                                                    }
                                                    ?>><?= $estado->getNome(); ?></option>
                                                        <?php endforeach; ?>                                                
                                            </select>
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-xs-12 col-md-6">
                                        <label class="label">Complemento</label>
                                        <label class="input">
                                            <input type="text" name="complemento" value="<?= isset($_POST["complemento"]) ? $_POST["complemento"] : "" ?>"> 
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-6 requerido">
                                        <label class="label">Cidade</label>
                                        <label class="input">
                                            <select name="cidadeId" class="select2" style="width:100%" data-select-search="true">
                                                <option value="" selected="" disabled="">Selecione a cidade</option>
                                                <?php foreach ($cidades as $cidade): ?>
                                                    <option value="<?= $cidade->getId(); ?>" <?
                                                    if (isset($_POST['cidadeId'])) {
                                                        if ($cidade->getId() == $_POST['cidadeId'])
                                                            print 'selected';
                                                    }else {
                                                        if ($cidadeDaPrefeituraLogada->getId() == $cidade->getId()) {
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
                                            <input type="text" name="cep" data-mask="99999-999" data-mask-placeholder="_" value="<?= isset($_POST["cep"]) ? $_POST["cep"] : "" ?>">
                                        </label>
                                    </section>
                                </div>                                
                            </fieldset>

                            <fieldset>
                                <legend>Usuário</legend>
                                <div class="row">
                                    <section class="col col-xs-12 col-md-4 requerido">
                                        <label class="label">Login</label>
                                        <label for="address" class="input">
                                            <i class="icon-prepend fa fa-user"></i>
                                            <input type="text" name="login" placeholder="login" value="<?= isset($_POST["login"]) ? $_POST["login"] : "" ?>">
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-4 requerido">
                                        <label class="label">Senha</label>
                                        <label class="input">
                                            <i class="icon-prepend fa fa-key"></i>
                                            <input type="password" id="senha" name="senha" placeholder="Senha">
                                        </label>
                                    </section>
                                    <section class="col col-xs-12 col-md-4 requerido">
                                        <label class="label">Confirmar Senha</label>
                                        <label  class="input">
                                            <i class="icon-prepend fa fa-key"></i>
                                            <input type="password" name="senhaConfirmacao" placeholder="Confirma Senha">
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
                </div>
            </div>
        </article>
    </div>
</section>


<script type="text/javascript">

    pageSetUp();



    $("select[name=estadoId]").change(function () {
        $.get("<?= site_url("cidades/buscarPorEstadoJson") ?>/" + $(this).val(), function (cidades) {
            $("select[name=cidadeId]").html("");
            $("select[name=cidadeId]").append('<option value="" selected>Selecione a cidade</option>');
            for (var i in cidades) {
                $("select[name=cidadeId]").append("<option value=\"" + cidades[i].id + "\">" + cidades[i].nome + "</option>");
            }
        }, "json");
    });

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
                },
                login: {
                    required: true
                },
                senha: {
                    required: true,
                    minlength: 4,
                    maxlength: 30
                },
                senhaConfirmacao: {
                    required: true,
                    minlength: 4,
                    maxlength: 30,
                    equalTo: '#senha'
                },
                perfilAcesso: {
                    required: true
                }

            },
            // Messages for form validation
            messages: {
                nome: {
                    required: "Por favor, digite o nome"
                },
                dataNascimento: {
                    required: "Por favor, digite a data de nascimento do Usuário"
                },
                telefone: {
                    required: "Por favor, digite um telefone para contato"
                },
                celular: {
                    required: "Por favor, digite um celular para contato"
                },
                email: {
                    required: "Por favor, digite o e-mail do Usuário",
                    email: "Por favor, digite um e-mail válido"
                },
                cpf: {
                    required: "Por favor, digite o CPF do Usuário"
                },
                logradouro: {
                    required: "Por favor, digite o logradouro em que o Usuário reside"
                },
                numero: {
                    required: "Por favor, digite o número da residência em que o Usuário reside"
                },
                bairro: {
                    required: "Por favor, digite o bairro em que o Usuário reside"
                },
                estadoId: {
                    required: "Por favor, digite o estado em que o Usuário reside"
                },
                cidadeId: {
                    required: "Por favor, digite a cidade em que o Usuário reside"
                },
                login: {
                    required: "Por favor, digite o nome de Usuário"
                },
                senha: {
                    required: "Por favor, digite a senha"
                },
                senhaConfirmacao: {
                    required: "Por favor, digite a confirmação de senha",
                    equalTo: "Por favor, digite a mesma senha do campo da esquerda"

                },
                perfilAcesso: {
                    required: "Por favor, selecione o perfil de acesso do Usuário"
                }
            },
            submitHandler: function (form) {
                $.post($(form).attr('action'), $(form).serialize(), function (retorno) {
                    if (!retorno.erro) {
                        sucessDialogAlert("Usuário Cadastrado", "Informações foram salvas com sucesso.");
                        location.replace("#usuarios");
                    } else {
                        erroDialogAlert("Falha!", "As informações não poderam ser atualizadas devidos há um erro.<br>"+retorno.mensagem);
                    }
                }, "json");
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
    }
    
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

</script>

