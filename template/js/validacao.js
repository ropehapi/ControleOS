function ValidarTela(tela){

    var ret = true;

    switch(tela){
        case 1:
            if($("#setor").val().trim()==''||$("#equip").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 2:
            if($("#tipo").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 3:
            if($("#nome").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 4:
            if($("#nome").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 5:
            if($("#tipo").val().trim()==''||$("#modelo").val().trim()==''||$("#ident").val().trim()==''||$("#desc").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 6:
            if($("#setor").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 7:
            if($("#nome").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 8:
            if($("#nome").val().trim()==''){
                 toastr.warning(RetornaMsg(0));
                 ret = false;
            }
            break;
        case 9:
            if($("#tipo").val().trim()==''||$("#nome").val().trim()==''||$("#cpf").val().trim()==''||$("#setor").val().trim()==''||$("#email").val().trim()==''||$("#telefone").val().trim()==''||$("#endereco").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 10:
            if($("#senha").val().trim()==''||$("#novaSenha").val().trim()==''||$("#rNovaSenha").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 11:
        if($("#sitChamado").val().trim()==''){
             toastr.warning(RetornaMsg(0));
             ret = false;
            }                
            break;
        case 12:
        if($("#nome").val().trim()==''||$("#email").val().trim()==''||$("#telefone").val().trim()==''||$("#endereco").val().trim()==''){
            toastr.warning(RetornaMsg(0));
            ret = false;
            }
            break;
        case 13:
            if($("#equip").val().trim()==''||$("#descProblema").val().trim()==''){
            toastr.warning(RetornaMsg(0));
            ret = false;
            }
            break;
        case 14:
            if($("#senha").val().trim()==''||$("#novaSenha").val().trim()==''||$("#rNovaSenha"=='')){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 15:
            if($("#sitChamado").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 16:
            if($("#data").val().trim()==''||$("#setor").val().trim()==''||$("#funcionario").val().trim()==''||$("#equip").val().trim()==''||$("#laudo").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
        case 17:
            if($("#nome").val().trim()==''||$("#email").val().trim()==''||$("#telefone").val().trim()==''||$("#endereco").val().trim()==''){
                toastr.warning(RetornaMsg(0));
                ret = false;
            }
            break;
    }

    return ret;
}