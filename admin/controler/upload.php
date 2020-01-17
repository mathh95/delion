<?php
/**
 * Autor: Thiago Belem
 * Adapted: Douglas Paz

 * Date: 11/11/2016
 * Project: Sistema Agrodata
 * File: uploads.php
 * Objetivo: Classe que recebece anexos, valida, e os adiciona na pasta
 */

include_once ROOTPATH."/config.php";

function upload($input) {
    
    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');
    $caminho = ADMINPATH.'/upload/'.$ano.'/'.$mes.'/'.$dia.'/';

    // Pasta onde o arquivo vai ser salvo
    if (!file_exists($caminho) && !is_dir($caminho)) {
        mkdir($caminho, 0777, true);
    }
    $_UP['pasta'] = $caminho;
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('jpg', 'png', 'pdf', 'txt');
    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = true;
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES[$input]['error'] != 0) {
        die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES[$input]['error']]);
        exit; // Para a execução do script
    }
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
    // Faz a verificação da extensão do arquivo
    $filename = $_FILES[$input]['name'];
    $extensao = strtolower(end(explode('.', $filename)));
    if (array_search($extensao, $_UP['extensoes']) === false) {
        echo "Por favor, envie arquivos com as seguintes extensões: jpg, png, pdf ou txt";
        exit;
    }
    // Faz a verificação do tamanho do arquivo
    if ($_UP['tamanho'] < $_FILES[$input]['size']) {
        echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
        exit;
    }
    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    // Primeiro verifica se deve trocar o nome do arquivo
    if ($_UP['renomeia'] == true) {
        // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
        $nome_final = md5(time().$filename).'.'.$extensao;
    } else {
        // Mantém o nome original do arquivo
        $nome_final = $_FILES[$input]['name'];
    }

    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    $enviado = move_uploaded_file($_FILES[$input]['tmp_name'], $_UP['pasta'] . $nome_final);
    if ($enviado) {
        // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
        //echo "Upload efetuado com sucesso!";
        return $_UP['pasta'] . $nome_final;
    } else {
        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
        echo "Não foi possível enviar o arquivo, tente novamente";
        return "";
    }
}
