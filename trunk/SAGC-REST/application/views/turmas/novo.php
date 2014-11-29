<section id="widget-grid">
    <div class="row">
        <article class="col col-xs-12 col-md-12 col-lg-12">
            <div class="jarviswidget">
                <header>
                    <span class="widget-icon"><i class="fa fa-group"></i></span>
                    <h2>Turmas</h2>                    
                </header>
                <div>
                    <div class="widget-body no-padding">

                        <form class="smart-form" id="turma-form" action="<?= site_url("turmas/novo"); ?>" method="POST">
                            <fieldset>                                
                                <div class="row">
                                    <section class="col col-xs-2">
                                        <label class="label">Codigo</label>
                                        <label class="input">
                                            <input type="text" name="codigo">
                                        </label>
                                    </section>
                                    <section class="col col-xs-8">
                                        <label class="label">Nome</label>
                                        <label class="input">
                                            <input type="text" name="nome"
                                        </label>
                                    </section>
                                    <section class="col col-xs-2">
                                        <label class="label">Ano</label>
                                        <label class="input">
                                            <input type="number" name="ano">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-xs-2">
                                        <label class="label">Data Inicio</label>
                                        <label class="input">
                                            <input type="text" id="dataInicio" name="dataInicio">
                                        </label>
                                    </section>
                                    <section class="col col-xs-2">
                                        <label class="label">Data Termino</label>
                                        <label class="input">
                                            <input type="text" id="dataTermino" name="dataTermino">
                                        </label>
                                    </section>
                                    <section class="col col-xs-2">
                                        <label class="label">Vagas</label>
                                        <label class="input">
                                            <input type="number" name="vagas">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-xs-12">
                                        <label class="label">Descrição</label>
                                        <label class="textarea">
                                            <textarea row="10" name="descricao"></textarea>
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

<script>

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
                        sucessDialogAlert("Turma Cadastrado", "Informações foram salvas com sucesso.");
                        location.replace("#usuarios");
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
</script>


