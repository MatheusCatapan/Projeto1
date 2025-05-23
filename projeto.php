<?php 


function realizarLogin($usuario, $senha) {
    $usuarios = file('usuarios.txt', FILE_IGNORE_NEW_LINES);  

    foreach ($usuarios as $linha) {
        list($u, $s) = explode(';', $linha);
        if ($u === $usuario && $s === $senha) {               
            $dataHora = date('d/m/Y H:i:s');
            $conteudo = "$dataHora $usuario\n";

            file_put_contents('sessao.txt', $conteudo, FILE_APPEND);
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
        $arquivo = 'usuarios.txt';
        if (file_exists($arquivo)) {
            $usuarios = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        } else {
            $usuarios = [];
        }
        foreach ($usuarios as $linha) {
            list ($u, $s) = explode(';', $linha);
            if ($u === $usuario) {
                return false;
            }
        }
        $linhaNova = $usuario . ';' . $senha . "\n";
        file_put_contents($arquivo, $linhaNova, FILE_APPEND);
        return true;
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
                if (realizarLogin($usuario,$senha)) {
                    echo "login";
                } else {
                    echo "erro";
                }
                pausa();
                break;
            case 2:
                echo "Digite o nome do usuário a ser cadastrado: ";
                $usuario = trim(fgets(STDIN));
                echo "Digite a senha: ";
                $senha = trim(fgets(STDIN));     
                if (cadastrarUsuario($usuario,$senha)) {
                    echo "Usuário cadastrado com sucesso!\n";
                }else {
                    echo "Erro: Esse usuário já foi cadastrado!\n";
                }
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