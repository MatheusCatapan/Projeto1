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
        $usuarios = file ('usuarios.txt', FILE_IGNORE_NEW_LINES, FILE_APPEND);
        foreach ($usuarios as $linha) {
            list ($u, $s) = explode(';', $linha);
            if ($u === $usuario) {
            return false;
    }
          } return true;
    }

    function vendaRealizada($valor, $nomedoItem) {
        file_put_contents('log.txt', date('Y-m-d H:i:s') . " - Venda: $nomedoItem | Valor: R$ $valor" . PHP_EOL, FILE_APPEND);
    }

    function limparTela() {
        system('clear');
    }

    function pausa() {
        echo "\nPressione ENTER para continuar...";
        fgets(STDIN);
    }    

    function login() {
        limparTela();
        echo "Fazer login";
        echo "Sair";
    }


    function menu() {
        limparTela();
        echo "///// MENU PRINCIPAL /////";
    }

    do {
        echo "Escolha uma opção:\n";
        echo "1 - Fazer login\n";
        echo "2 - Cadastrar usuário\n";
        echo "3 - Sair\n";
        echo "Opção: ";
        $escolha = trim(fgets(STDIN));
    
        switch ($escolha) {
            case 1:
                echo "Insira seu usuário: ";
                $usuario = trim(fgets(STDIN));
                echo "Insira sua senha: ";
                $senha = trim(fgets(STDIN));
            case 2:
                echo "Digite o nome do usuário a ser cadastrado: ";
                $usuario = trim(fgets(STDIN));
                echo "Digite a senha: ";
                $senha = trim(fgets(STDIN));
                $mensagem = cadastrarUsuario($usuario, $senha);
                echo $mensagem . "\n";
                pausa();
                break;
    
            case 3:
                echo "Saindo...\n";
                exit;
    
            default:
                echo "Opção inválida!\n";
                pausa();
                break;
        }
    
    } while (true);