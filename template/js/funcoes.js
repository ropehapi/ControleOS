function CarregarDadosExcluir(id, nome){

    $("#cod_item").val(id);
    $("#nome_excluir").html(nome);
}

function CarregarDadosAlterar(id, nome){

    $("#cod_alt").val(id);
    $("#nome_alt").val(nome);
}

function MostrarTipoUsuario(tipo){
    if(tipo != ''){
        $("#divTipo123").show();
        $("#btnGravar").show();
        $("#divTipo2").hide();
        $("#divTipo23").hide();
    }else{
        $("#divTipo123").hide();
        $("#btnGravar").hide();
        $("#divTipo2").hide();
        $("#divTipo23").hide();
    }

    if(tipo == '2'|| tipo=='3'){
        $("#divTipo23").show();
        $("#divTipo2").hide();
    }
    if(tipo=='2'){
        $("#divTipo2").show();
    }
}