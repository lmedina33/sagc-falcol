/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var erroDialogIndex = 0;
function dialogAlert(titulo, mensagem, cor, icone, tempo) {
    $.bigBox({
        title: titulo,
        content: mensagem,
        color: cor,
        //timeout: 6000,
        icon: icone,
        number: "" + (erroDialogIndex++),
        timeout: tempo
    });
}

function sucessDialogAlert(titulo, mensagem, tempo) {
    if (typeof tempo === 'undefined') {
        tempo = 20000;
    }
    dialogAlert(titulo, mensagem, "#739E73", "fa fa-check", tempo);
}

function erroDialogAlert(titulo, mensagem, tempo) {
    if (typeof tempo === 'undefined') {
        tempo = 20000;
    }
    dialogAlert(titulo, mensagem, "#C46A69", "fa fa-warning shake animated", tempo);
}

function dialogNotification(mensagem) {
    $.SmartMessageBox({
        title: "<i class='fa fa-warning txt-color-orangeDark'></i> Aviso<span class='txt-color-orangeDark'><strong>" +
                $('#show-shortcut')
                .text() + "</strong></span>!",
        content: "" + mensagem + "",
        buttons: '[Ok]'
    });
}

function dialogQuestion(mensagem, funcao) {
    $.SmartMessageBox({
        title: "<i class='fa fa-warning txt-color-orangeDark'></i> " + mensagem + "<span class='txt-color-orangeDark'><strong>" +
                $('#show-shortcut')
                .text() + "</strong></span> ?",
        buttons: '[Não][Sim]'
    }, funcao);
}

var beforePrint = function() {
    var $th = $("table thead tr th:last-child:contains('Ações')");
    $th.css("display", "none");
    $th.parents("table").find("tbody tr td:last-child").css("display", "none");
    
    $("canvas.flot-base").parent().data("plot");
    
    $("canvas.flot-base").each(function(){
        var chartContainer = $(this).parent();
        var plot = $(this).parent().data("plot");
        var data = plot.getData();
        var options = plot.getOptions();
        
        //plot.resize();
        
        
        
        $.plot(chartContainer, data, options);
    });
    drawChart();
};
var afterPrint = function() {
    var $th = $("table thead tr th:last-child:contains('Ações')");
    $th.css("display", "table-cell");
    $th.parents("table").find("tbody tr td:last-child").css("display", "table-cell");
};

if (window.matchMedia) {
    var mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(function(mql) {
        if (mql.matches) {
            beforePrint();
        } else {
            afterPrint();
        }
    });
}

window.onbeforeprint = beforePrint;
window.onafterprint = afterPrint;