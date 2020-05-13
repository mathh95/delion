/*
    Função de retorno do sistema, apresenta uma mensagem pop-up para o usuário, esta mensagem pode ser de caráter: informativo ou advertência.
    
    Parâmetros: 
            -Título da janela
            -Mensagem 
            -Tipo de mensagem:
                informação (azul: type-primary)
                sucesso (verde: type-success)
                erro (vermelho: type-danger). 
            -Função     
    Exemplo de uso:
        mensagemAviso("titulo","mensagem",0,function(){})

*/
function msgGenerico(titulo,mensagem,tipo,funcao){
    var types = [BootstrapDialog.TYPE_PRIMARY, 
                     BootstrapDialog.TYPE_SUCCESS, 
                     BootstrapDialog.TYPE_DANGER];
    BootstrapDialog.show({
            title: titulo,
            message: mensagem,
            type: types[tipo],
            draggable: true,
            closable: false, 
            closeByBackdrop: false, 
            closeByKeyboard: false,
            buttons: [{
                label: 'OK',
                action: function(dialog) {
                    funcao();
                    dialog.close();
                }
            }]
        });
}
/*
    Função de retorno do sistema, apresenta uma mensagem pop-up para o usuário, e redireciona o uruário para uma página passada como parâmetro
    
    Parâmetros: 
            -Título da janela
            -Mensagem 
            -Tipo de mensagem:
                informação (azul: type-primary)
                sucesso (verde: type-success)
                erro (vermelho: type-danger). 
            -Rota     
    Exemplo de uso:
        msgRedireciona("titulo","mensagem",0,'login.php')

*/
function alertComum(titulo,mensagem,tipo) { 
    msgGenerico(titulo,mensagem,tipo,function(){}); 
}
/*
    Função de retorno do sistema, apresenta uma mensagem pop-up para o usuário, e redireciona o uruário para uma página passada como parâmetro
    
    Parâmetros: 
            -Título da janela
            -Mensagem 
            -Tipo de mensagem:
                informação (azul: type-primary)
                sucesso (verde: type-success)
                erro (vermelho: type-danger). 
            -Rota     
    Exemplo de uso:
        msgRedireciona("titulo","mensagem",0,'login.php')

*/
function msgRedireciona(titulo,mensagem,tipo,rota) { 
    msgGenerico(titulo,mensagem,tipo,function() { 
        location.href=rota;// redireciona 
    }); 
}
/*
    Função de retorno do sistema, apresenta uma mensagem pop-up para o usuário, e redireciona o uruário para a página anterior
    
    Parâmetros: 
            -Título da janela
            -Mensagem 
            -Tipo de mensagem:
                informação (azul: type-primary)
                sucesso (verde: type-success)
                erro (vermelho: type-danger).    
    Exemplo de uso:
        msgRedireciona("titulo","mensagem",0,'login.php')

*/
function msgVoltar(titulo,mensagem,tipo,rota) { 
    msgGenerico(titulo,mensagem,tipo,function() { 
        history.go(-1);// redireciona 
    }); 
}


/*
    Função de requisição de confirmação, o sistema apresenta uma mensagem pop-up para o usuário, contendo duas opções de resposta SIM e NÃO
    Parâmetros: 
            -Título da janela
            -Mensagem 
            -Função para o caso de Sim     
            -Função para o caso de Não     
    Exemplo de uso:
        msgConfirmacao("titulo","mensagem",function(){},function(){})
*/
function msgConfirmacao(titulo,mensagem,funcaoSim,funcaoNao){
    return BootstrapDialog.confirm({
            title: titulo,
            message: mensagem,
            type: BootstrapDialog.TYPE_WARNING, 
            draggable: true,
            closable: false, 
            closeByBackdrop: false, 
            closeByKeyboard: false, 
            btnCancelLabel: 'Não',
            btnCancelClass: 'btn-warning',
            btnOKLabel: 'Sim', 
            btnOKClass: 'btn-danger',
            callback: function(result) {
                if(result) {
                    funcaoSim();
                }else {
                    funcaoNao();
                }
            }
            });

}