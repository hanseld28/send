<?php
include_once('../Controller/ResponsavelCRUD.php');
    session_start();
    $pasta = "../fotos/";
    $cod = $_SESSION['resp'];

    /* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    if(isset($_FILES['imagem'])){
        
        $nome_imagem    = $_FILES['imagem']['name'];
        $tamanho_imagem = $_FILES['imagem']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['imagem']['tmp_name']; //caminho temporário da imagem
                $foto = $nome_atual;
                /* se enviar a foto, insere o nome da foto no banco de dados */
                $crud = new ResponsavelCRUD();
                $crud->cadastrarFotoResponsavel($foto, $cod);

                if(move_uploaded_file($tmp,$pasta.$nome_atual)){
                    echo "<img src='../fotos/".$nome_atual."' id='fotoPerfilDoresponsavel'>"; //imprime a foto na tela
                    
                }else{
                    echo "Falha ao enviar";
                }
            }else{
                echo "A imagem deve ser de no máximo 1MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        echo "Selecione uma imagem";
        exit; 
    }
    
?>