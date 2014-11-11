<div id="departamentos-editar">
    <h1>
        <?
        if ($usuarioLogado->temPermissao('perfisacesso', true)) {
            print "Editar";
        } else {
            print "Visualizar";
        }
        ?> Perfil de Acesso
    </h1>
<? if (isset($mensagem)): ?>
        <div class="alert <?= $erro ? "alert-danger" : "alert-success" ?>">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <p>
        <?= $mensagem ?>
            </p>
        </div>
<? endif; ?>

    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-md-12 col-lg-8">

                <form class="smart-form" id="checkout-form" action="<?= site_url("perfisacesso/editar/" . $perfilacesso->getId()) ?>" method="post">
                    <input type="hidden" name="permissoesAcesso" id="permissoesAcesso" value="<?= isset($_POST["permissoesAcesso"]) ? $_POST["permissoesAcesso"] : implode(',', $perfilacesso->getPermissoesAcesso()) ?>"/>
                    <input type="hidden" name="permissoesModificacao" id="permissoesModificacao" value="<?= isset($_POST["permissoesModificacao"]) ? $_POST["permissoesModificacao"] : implode(',', $perfilacesso->getPermissoesModificacao()) ?>"/>
                    <fieldset>
                        <div class="row">
                            <section class="col col-xs-12 requerido">
                                <label class="label" for="input-nome">Nome</label>
                                <label class="input">
                                    <input type="text" id="input-nome" name="nome" value="<?= isset($_POST["nome"]) ? $_POST["nome"] : $perfilacesso->getNome() ?>">
                                </label>
                            </section>                                   
                        </div>
                        <div class="row">
                            <section class="col col-6 col-xs-12">
                                <label class="control-label" for="input-permissoesAcesso">Permissões de Visualização</label>
                                <div class="controls" id="arvorePerfisAcesso">

                                </div>
                            </section>
                            <section class="col col-6 col-xs-12">
                                <label class="control-label" for="input-permissoesModificacao">Permissões de Modificação</label>
                                <div class="controls" id="arvorePerfisModificacao">

                                </div>
                            </section>
                        </div>
                        <footer>
                        <? if ($usuarioLogado->temPermissao('perfisacesso', true)) { ?>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Salvar
                            </button>
                        <? } ?>
                        </footer>
                    </fieldset>
                </form>
            </article>
        </div>
    </section>
</div>

<link href="<?= base_url("assets/js/plugin/dynatree-1.2.4/src/skin/ui.dynatree.css"); ?>" rel="stylesheet" type="text/css" id="skinSheet">
<script>
    function fazerArvore() {
        $("#arvorePerfisAcesso").dynatree({
            checkbox: true,
            selectMode: 3,
            children: <?= $arvorePerfisAcesso; ?>,
            onSelect: function(select, node) {
                // Get a list of all selected nodes, and convert to a key array:
                var selKeys = $.map(node.tree.getSelectedNodes(), function(node) {
                    return node.data.key;
                });
                $("#permissoesAcesso").val(selKeys.join(","));
            },
            onKeydown: function(node, event) {
                if (event.which == 32) {
                    node.toggleSelect();
                    return false;
                }
            },
            // The following options are only required, if we have more than one tree on one page:
            //				initId: "treeData",
            cookieId: "dynatree-arvorePerfisAcesso",
            idPrefix: "dynatree-arvorePerfisAcesso-"
        });

        $("#arvorePerfisModificacao").dynatree({
            checkbox: true,
            selectMode: 3,
            children: <?= $arvorePerfisModificacao; ?>,
            onSelect: function(select, node) {
                // Get a list of all selected nodes, and convert to a key array:
                var selKeys = $.map(node.tree.getSelectedNodes(), function(node) {
                    return node.data.key;
                });
                $("#permissoesModificacao").val(selKeys.join(","));
            },
            onKeydown: function(node, event) {
                if (event.which == 32) {
                    node.toggleSelect();
                    return false;
                }
            },
            // The following options are only required, if we have more than one tree on one page:
            //				initId: "treeData",
            cookieId: "dynatree-arvorePerfisModificacao",
            idPrefix: "dynatree-arvorePerfisModificacao-"
        });
    }

    function onReady() {
        loadScript("<?= base_url(); ?>assets/js/plugin/jquery-form/jquery-form.min.js", runFormValidation);
        loadScript("<?= base_url("assets/js/plugin/dynatree-1.2.4/jquery/jquery-ui.custom.js"); ?>",
                loadScript("<?= base_url("assets/js/plugin/dynatree-1.2.4/jquery/jquery.cookie.js"); ?>",
                        loadScript("<?= base_url("assets/js/plugin/dynatree-1.2.4/src/jquery.dynatree.js"); ?>", fazerArvore)
                        )
                );

<?
if (!$usuarioLogado->temPermissao('perfisacesso', true)) {
    print 'desabilitarEdicao();';
}
?>
    }
    function runFormValidation() {
        $('#checkout-form').validate({
            // Rules for form validation
            rules: {
                nome: {required: true}
            },
            messages: {
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
            }
        });
    }
</script>