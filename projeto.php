<?php 


    function realizarLogin($usuario, $senha) {
    $usuarios = file('usuarios.txt', FILE_IGNORE_NEW_LINES);  
        foreach ($usuarios as $linha) {
            list ($u, $s) = explode(';', $linha);
            if ($u === $usuario && $s ===$senha) {
                file_put_contents('sessao.txt', $usuario); 
                $dataHora = date('d/m/Y H:i:s');
                file_put_contents('sessao.txt', $dataHora);         
                logar("Usuário $usuario realizou login.");
                return true;            
        }
    }
       return false;
}

    function logar($mensagem) {
        $date = date('d/m/Y H:i:s');
        $linha = "[$date] $mensagem";
        file_put_contents('log.txt', $linha);     
    } 

    function cadastrarUsuario($usuario, $senha) {
        $usuarios = file ('usuarios.txt', FILE_IGNORE_NEW_LINES);
        foreach ($usuarios as $linha) {
            list ($u, $s) = explode(';', $linha);
            if ($u === $usuario) {
            return false;
    }
          } return true;
    }