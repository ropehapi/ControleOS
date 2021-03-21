function RetornaMsg(num){
    var msg = '';
    switch(num){
        case -2:
            msg = 'Não foi possível excluir o registro pois está em uso';
            break;    
        case -1:
            msg = 'Ocorreu um erro na operação , tente novamente mais tarde';
            break;
        case 0:
            msg = 'Por favor preencher todos os campos';
            break;
        case 1:
            msg = 'Ação realizada com sucesso';
            break;    
    }

    return msg;
}