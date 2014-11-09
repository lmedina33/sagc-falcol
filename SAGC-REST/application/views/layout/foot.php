<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script src="<?= base_url("assets/js/plugin/pace/pace.min.js"); ?>"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script> if (!window.jQuery) {
        document.write('<script src="<?= base_url("assets/js/libs/jquery-2.0.2.min.js"); ?>"><\/script>');
    }</script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> if (!window.jQuery.ui) {
        document.write('<script src="<?= base_url("assets/js/libs/jquery-ui-1.10.3.min.js"); ?>"><\/script>');
    }</script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->		
<script src="<?= base_url("assets/js/bootstrap/bootstrap.min.js"); ?>"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?= base_url("assets/js/notification/SmartNotification.min.js"); ?>"></script>

<!-- JARVIS WIDGETS -->
<script src="<?= base_url("assets/js/smartwidgets/jarvis.widget.min.js"); ?>"></script>

<!-- EASY PIE CHARTS -->
<script src="<?= base_url("assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"); ?>"></script>

<!-- SPARKLINES -->
<script src="<?= base_url("assets/js/plugin/sparkline/jquery.sparkline.min.js"); ?>"></script>

<!-- JQUERY VALIDATE -->
<script src="<?= base_url("assets/js/plugin/jquery-validate/jquery.validate.min.js"); ?>"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?= base_url("assets/js/plugin/masked-input/jquery.maskedinput.min.js"); ?>"></script>

<!-- MASKMONEY -->
<script src="<?= base_url("assets/js/plugin/jquery.maskMoney.js"); ?>"></script>

<!-- PHP.JS -->
<script src="<?= base_url("assets/js/php.js"); ?>"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="<?= base_url("assets/js/plugin/select2/select2.min.js"); ?>"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="<?= base_url("assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"); ?>"></script>

<!-- browser msie issue fix -->
<script src="<?= base_url("assets/js/plugin/msie-fix/jquery.mb.browser.min.js"); ?>"></script>

<!-- FastClick: For mobile devices -->
<script src="<?= base_url("assets/js/plugin/fastclick/fastclick.js"); ?>"></script>

<!--Uploadifive-->
<script src="<?= base_url() ?>assets/js/plugin/uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script>

<!--Jcrop-->
<script src="<?= base_url() ?>assets/js/plugin/jcrop-1902fbc/jquery.Jcrop.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/js/plugin/jcrop-1902fbc/jquery.color.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/js/plugin/summernote/summernote.js"></script>

<!--[if IE 7]>
        <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="<?= base_url("assets/js/app.js"); ?>"></script>

<script type="text/javascript">
    if (typeof onReady !== "undefined") {
        onReady();
    }
    pageSetUp();

    var _alertarSaida = false;
    var _mensagemAlertaSaida = null;

    $(function() {
        window.onbeforeunload = function() {
            
            $('#over-carregando').fadeIn();            
            
            if(_alertarSaida){
                return _mensagemAlertaSaida;
            }
        };
    });

    function alertarSaida(mensagem) {
        _alertarSaida = true;
        if (typeof mensagem !== 'undefined') {
            _mensagemAlertaSaida = mensagem;
        }
        else {
            _mensagemAlertaSaida = "Você ainda não salvou as alterações.";
        }
    }

    function cancelarAlertaSaida() {
        _alertarSaida = false;
    }

</script>

<!-- Your GOOGLE ANALYTICS CODE Below -->
<script type="text/javascript">
    google.load('visualization', '1.0', {'packages': ['corechart']});
    var data, options, chart = null;

    function graficoPizza(titulo, descricao, seletor, array) {
        data = google.visualization.arrayToDataTable([[titulo, descricao]].concat(array));

        options = {
            backgroundColor: '#F7F7FD'
        };

        chart = new google.visualization.PieChart(document.getElementById(seletor));
        chart.draw(data, options);

    }

    function graficoTorre(titulo, descricao, seletor, array) {
        var data;
        var nome = Array();
        var valor = Array();

        for (var i = 0; i < array.length; i++) {
            nome.push(array[i][0]);
            valor.push(array[i][1]);
        }

        var data = google.visualization.arrayToDataTable([
            [titulo].concat(nome),
            [''].concat(valor),
        ]);

        //data = google.visualization.arrayToDataTable([[titulo, descricao, ]].concat(array));

        options = {
            backgroundColor: '#F7F7FD',
            chartArea: {width: '50%', height: '75%'},
            hAxis: {titleTextStyle: {color: 'red'}}
        };

        chart = new google.visualization.ColumnChart(document.getElementById(seletor));
        chart.draw(data, options);
    }

    $(function() {
        $('.summernote').summernote({
            height: 180,
            focus: false,
            tabsize: 2
        });
        $("input[type='text']:not(.no-changecase), textarea:not(.no-changecase)").on('blur', function() {
            this.value = this.value.toUpperCase();
        });

        $("form").submit(function() {
            $("input[type='text']:not(.no-changecase), textarea:not(.no-changecase)").each(function() {
                this.value = this.value.toUpperCase();
            });
        });

        $("input.money").maskMoney({thousands: '.', decimal: ',', allowZero: true, prefix: 'R$ '});

        $("input.numeros").maskMoney({thousands: '', decimal: '', allowZero: true, prefix: '', precision: 0});
    });

    function simNaoNull(valor) {
        return (valor == null) ? '' : (valor) ? 'Sim' : 'Não';
    }
    function mensagemInfo(titulo, mensagem, elemento, tipo, icone) {

        $(elemento).hide();

        if (tipo === undefined) {
            tipo = 'alert-success';
        }

        if (icone === undefined) {
            icone = ''; //<i class="fa fa-check-square-o"></i> 
        }

        $(elemento).html('<div class="alert alert-block ' + tipo + '" >\
                            <a class="close" data-dismiss="alert" href="#">×</a>\
                            <h4 class="alert-heading">' + icone + titulo + '</h4>\
                            <p>' + mensagem + '</p>\
                        </div>');

        $('html, body').animate({
            scrollTop: 0
        }, 600);

        $(elemento).slideDown();
    }

    function addMembroRow(add) {
        var membroExcluir = $($(add).parent().find('select')).prop("selectedIndex");
        var content = $(add).parent().parent();
        var localSelection = $(add).parent();
        var select = $(add).parent().find('select');
        var model = $(select).parent().parent()[0].outerHTML;

        if ($(content).find('select:last option[style!="display: none;"]').size() > 1) {
            $(add).remove();
            $(localSelection).append('<input class="btn btn-info btn-remove-padding-custom" type="button" value="-" onclick="removeMembroRow(this);">');
            $(content).append(model);
            $(select).attr('disabled', true);
            $(content).attr('excluirIndex', (($(content).attr('excluirIndex') != undefined) ? $(content).attr('excluirIndex') + ',' : '') + membroExcluir);

            var hideIndex = $(content).attr('excluirIndex').split(',');
            for (var i = 0; i < hideIndex.length; i++) {
                $($(content).find('select:last option:nth(' + hideIndex[i] + ')')).css('display', 'none');
            }
            $(content).find('select:last').prop("selectedIndex", $(content).find('select:last option[style!="display: none;"]:first').index());
        }
    }
    function removeMembroRow(remove) {
        var indexRemove = $(remove).parent().find('select').prop('selectedIndex');
        console.log("IndexRemove: " + indexRemove);
        var content = $(remove).parent().parent();
        var hideIndex = $(content).attr('excluirIndex').split(',');
        for (var n = 0; n < hideIndex.length; n++) {
            if (hideIndex[n] == indexRemove) {
                hideIndex.splice(n, 1);
                break;
            }
        }
        if (hideIndex.length > 0) {
            $(content).attr('excluirIndex', hideIndex.join(','));
        } else {
            $(content).removeAttr('excluirIndex');
        }
        for (var i = 0; i < $(content).find('select').size(); i++) {
            $($(content).find('select:nth(' + i + ') option:nth(' + indexRemove + ')')).css('display', 'block');
        }
        $(remove).parent().remove();
    }

    function setSelectedItens(select, array) {
        for (var i = 0; i < array.length; i++) {
            $($(select).find('option[value="' + array[i] + '"]')).prop('selected', true);
            $(select).select2()
        }
    }

    function valida_cpf(cpf) {
        var numeros, digitos, soma, i, resultado, digitos_iguais;
        digitos_iguais = 1;
        if (cpf.length < 11)
            return false;
        for (i = 0; i < cpf.length - 1; i++)
            if (cpf.charAt(i) != cpf.charAt(i + 1))
            {
                digitos_iguais = 0;
                break;
            }
        if (!digitos_iguais)
        {
            numeros = cpf.substring(0, 9);
            digitos = cpf.substring(9);
            soma = 0;
            for (i = 10; i > 1; i--)
                soma += numeros.charAt(10 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;
            numeros = cpf.substring(0, 10);
            soma = 0;
            for (i = 11; i > 1; i--)
                soma += numeros.charAt(11 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;
            return true;
        }
        else
            return false;
    }

    $(".anotacoes-salvar").click(function() {
        var dados = 'anotacoes=' + $('#anotacoes-form textarea[name="anotacoes"]').code() + "&" + $("#anotacoes-form").serialize();
<?php $serverRequestArray = explode("/", str_replace("index.php/", "", "$_SERVER[REQUEST_URI]")); ?>
        $.post('<?= "http://$_SERVER[HTTP_HOST]/" . $serverRequestArray[1] . "/salvarAnotacoesAjax/" . (($serverRequestArray[2] == 'index') ? $serverRequestArray[1] : $serverRequestArray[2]); ?>', dados, function(retorno) {
            if (!retorno.erro) {
                var conteudo = $('.smart-timeline-list')[0].innerHTML;
                var self = '<li>' +
                        '<a class="btn btn-circle btn-danger anotacoes-excluir pull-right" data-id="' + retorno.dados.id + '"><i class="fa fa-trash-o"></i></a>' +
                        '<div class="smart-timeline-icon">' +
                        '<img src="<?= base_url("uploads/usuarios/") . "/"; ?>' + retorno.dados.usuario.foto + '" width="32" height="32" />' +
                        '</div>' +
                        '<div class="smart-timeline-time">' +
                        '<small>' + retorno.dados.data + '</small>' +
                        '</div>' +
                        '<div class="smart-timeline-content">' +
                        '<p>' +
                        '<a href="javascript:void(0);"><strong>' + retorno.dados.usuario.nome + '</strong></a>' +
                        '</p>' +
                        retorno.dados.anotacao +
                        '</div>' +
                        '</li>';
                $('.smart-timeline-list li').remove();
                $('.smart-timeline-list').append(self);
                $('.smart-timeline-list').append(conteudo);
                $('#timeline-content').show();
                $('#anotacoes-form textarea[name="anotacoes"]').code('')
            }
        }, 'json');
    });
    $("body").on('click', ".anotacoes-excluir", function() {
        var id = $(this).data('id');
        $.post('<?= preg_replace('/index\/.*$/', 'excluirAnotacoesAjax', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>', {id: id}, function(retorno) {
            if (!retorno.erro) {
                $('.anotacoes-excluir[data-id="' + id + '"]').parent().remove();
            }
        }, 'json');
    });


//Notificacao
    function notificacaoAction() {
        $(".notificacaoAutorizacao").on("click", ".notificacao-autorizar-button", function() {
            var notificacaoId = $(this).data("notificacao").id;
            var content = $(this).parent().parent();
            content.find(".status").html('<h1><i class="fa fa-cog fa-spin"></i> Aguardando...</h1>');
            content.find(".resposta").hide();
            content.find(".status").show();
            $.get("<?= site_url('familias/confirmarAutorizacaoAjax') ?>/" + notificacaoId, function(retorno) {
                if (!retorno.erro) {
                    content.find(".status").hide();
                    content.find(".status").html('<h6 class="alert alert-success"> Autorizado</h6>');
                    content.find(".status").show();
                } else {
                    content.find(".status").hide();
                    content.find(".status").html('');
                    content.find(".resposta").show();
                    content.find(".status").show();
                    erroDialogAlert("ERRO!", retorno.mensagem);
                }
            }, "json");
        });
        $(".notificacaoAutorizacao").on("click", ".notificacao-negar-button", function() {
            var notificacaoId = $(this).data("notificacao").id;
            var content = $(this).parent().parent();
            content.find(".status").html('<h1><i class="fa fa-cog fa-spin"></i> Aguardando...</h1>');
            content.find(".resposta").hide();
            content.find(".status").show();
            $.get("<?= site_url('familias/negarAutorizacaoAjax') ?>/" + notificacaoId, function(retorno) {
                if (!retorno.erro) {
                    content.find(".status").hide();
                    content.find(".status").html('<h6 class="alert alert-danger"> Negado</h6>');
                    content.find(".status").show();
                } else {
                    content.find(".status").hide();
                    content.find(".status").html('');
                    content.find(".resposta").show();
                    content.find(".status").show();
                    erroDialogAlert("ERRO!", retorno.mensagem);

                }
            }, "json");
        });
        //Transferencia
        $(".notificacaoTransferencia").on("click", ".notificacao-autorizar-button", function() {
            var notificacaoId = $(this).data("notificacao").id;
            var content = $(this).parent().parent();
            content.find(".status").html('<h1><i class="fa fa-cog fa-spin"></i> Aguardando...</h1>');
            content.find(".resposta").hide();
            content.find(".status").show();
            $.get("<?= site_url('familias/confirmarTransferenciaAjax') ?>/" + notificacaoId, function(retorno) {
                if (!retorno.erro) {
                    content.find(".status").hide();
                    content.find(".status").html('<h6 class="alert alert-success"> Autorizado</h6>');
                    content.find(".status").show();
                } else {
                    content.find(".status").hide();
                    content.find(".status").html('');
                    content.find(".resposta").show();
                    content.find(".status").show();
                    erroDialogAlert("ERRO!", retorno.mensagem);

                }
            }, "json");
        });
        $(".notificacaoTransferencia").on("click", ".notificacao-negar-button", function() {
            var notificacaoId = $(this).data("notificacao").id;
            var content = $(this).parent().parent();
            content.find(".status").html('<h1><i class="fa fa-cog fa-spin"></i> Aguardando...</h1>');
            content.find(".resposta").hide();
            content.find(".status").show();
            $.get("<?= site_url('familias/negarTransferenciaAjax') ?>/" + notificacaoId, function(retorno) {
                if (!retorno.erro) {
                    content.find(".status").hide();
                    content.find(".status").html('<h6 class="alert alert-danger"> Negado</h6>');
                    content.find(".status").show();
                } else {
                    content.find(".status").hide();
                    content.find(".status").html('');
                    content.find(".resposta").show();
                    content.find(".status").show();
                    erroDialogAlert("ERRO!", retorno.mensagem);

                }
            }, "json");
        });
    }

    String.prototype.padLeft = function(n, pad) {
        t = '';
        if (n > this.length) {
            for (i = 0; i < n - this.length; i++) {
                t += pad;
            }
        }
        return t + this;
    };

    String.prototype.endsWith = function(suffix) {
        return this.indexOf(suffix, this.length - suffix.length) !== -1;
    };

    function ValidaNis(nis) {
        var multiplicador = Array(3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
        var soma;
        var resto;
        if (nis.trim().length == 0)
            return false;
        var nis = nis.trim();
        nis = nis.replace("-", "").replace(".", "").padLeft(11, '0');
        soma = 0;
        for (var i = 0; i < 10; i++)
            soma += parseInt(nis[i].toString()) * multiplicador[i];
        resto = soma % 11;
        if (resto < 2)
        {
            resto = 0;
        }
        else {
            resto = 11 - resto;
        }
        return nis.endsWith(resto.toString());
    }
</script>

<?
if (function_exists("pageFooter")) {
    pageFooter();
}
?>
