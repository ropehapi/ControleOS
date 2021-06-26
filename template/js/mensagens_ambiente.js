function RetornaMsg(num) {
    var msg = '';
    switch (num) {
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
        case 2:
            msg = 'Usuário não encontrado';
            break;
        case 3:
            msg = 'Senha atual não confere!';
            break;
        case 4:
            msg = 'Sua senha precisa ter mais de 6 caracteres !';
            break;

        case 5:
            msg = 'As senhas digitadas não conferem!';
            break;
        case 6:
            msg = 'Não foi encontrado nenhum registro';
            break;
    }

    return msg;
}