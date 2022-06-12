<html lang=”pt-br”>

  <head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imagens/shortcut-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mystyles.css">

    <title>Formados & Formandos</title>
    
  </head>

  <body>

    <div class=navigation>

      <table>
        <tr>
          <td class="logotipo"><img src="https://cdn-icons-png.flaticon.com/512/33/33839.png" alt="Logotipo do site"></td>
          <td class="nome-logo">Formados&<span>Formandos</span>
          </td>
          <td><ul>
              <li><a href="index.php"><span class="atual">HOME</span></a></li>
              <li><a href="university.html">A BRAZ CUBAS</a></li>
              <li><a href="about-us.html">SAIBA MAIS</a></li>
            </ul></td>
        </tr>
      </table>

    </div>
    
  </body>

</html>


<?php

//ARMAZENAR NAS VARIÁVEL PELO MÉTODO POST

  $color = $_POST['color'] ?? null;       
  $email = $_POST['email'] ?? null;

  $string = null;

//CASO NÃO TENHA INSERIDO O EMAIL NEM A COR

  if(empty($email&&$color)){       
    echo '<html>';
    echo '<head>';
    echo '</head>';
    echo '<body>';

    echo '<div class="busca">';

    echo '<form class="busca_email" method="post" action="index.php">';         
    echo '<input type="email" class="busca_fundo" placeholder="emaildoaluno@email.com" name="email"/>';

    echo '<input type="radio" id="bt1" name="color" value="#DD2D4A">';         
    echo '<input type="radio" id="bt2" name="color" value="#1C5253">';
    echo '<input type="radio" id="bt3" name="color" value="#473BF0">';
    echo '<input type="radio" id="bt4" name="color" value="#32021F">';

    echo '<button type="submit" class="busca_botao">&#128269;</button>';

    echo '</form>';

    echo '</div>';

    echo '<div class="explic">';
    echo '<p><span>Não encontrou? Visualize os currículos pré formatados abaixo &#10549;</span></p>'; 
    echo '</div>';

    echo '<div class="grade">';

    echo '<div class="curriculos">';
    echo '<a href="tom-curriculo.html"><img src="imagens/everton-curriculo.jpeg" alt="Currículo de Everton Gomiero"></a>';
    echo '<p>Everton Daibs Gomiero | <span>Análise e Desenvolvimento de Sistemas</span></p>';
    echo '</div>';

    echo '<div class="curriculos">';
    echo '<a href="isa-curriculo.html"><img src="imagens/isabella-curriculo.jpeg" alt="Currículo de Isabella Luiza"></a>';;
    echo '<p>Isabella Luiza Souza | <span>Análise e Desenvolvimento de Sistemas</span></p>';
    echo '</div>';

    echo '<div class="curriculos">';
    echo '<a href="rod-curriculo.html"><img src="imagens/rodrigo-curriculo.jpeg" alt="Currículo de Rodrigo Vieira"></a>';
    echo '<p>Rodrigo Vieira Junior | <span>Análise e Desenvolvimento de Sistemas</span></p>';
    echo '</div>';

    echo '</div>';

    echo '<div class="footer">';
    echo '<p>© 2021 Copyright - DevsJr</p>';     
    echo '</div>';

    echo '</body>';
    echo '</html>';
}

  else{   

//MUDAR A COR

      // utiliza o explode para transformar cada linha em um array
    $tdlinhas = explode("\n", file_get_contents("$email.txt"));

      // lê somente o conteudo da linha[11]
    $linha_cor = $tdlinhas[11];

      // abre para leitura e escrita colocando o ponteiro do arquivo no começo do arquivo
    $arquivo = fopen("$email.txt",'r+');

    if ($arquivo) {

      while(true) {

        $tdarquivo = fgets($arquivo);   // retorna cada linha do arquivo

        if ($tdarquivo==null) { break; }
  
          elseif(preg_match("/$linha_cor/", $tdarquivo)) {  // busca a expressão regular "$linha_cor"
              
            $string .= str_replace("$linha_cor", "background-color:$color;", $tdarquivo); // altera, exclui e inclue o anterior

          }
          
            else {
                
              $string .= $tdarquivo;  // concatenação

            }
      }

//REESCREVE NO TODO ARQUIVO

        // move a posição do ponteiro para o inicio do arquivo
      rewind($arquivo);
      
        // apaga o conteudo
      ftruncate($arquivo, 0);
      
        // reescreve o conteudo dentro do arquivo
      fwrite($arquivo, $string); 

        // fecha o arquivo
      fclose($arquivo); 
    }      


//ABRINDO O .txt

    echo '<div class=voltar>';
    echo '<button type="button" onclick="history.back();" title="Voltar ao início">&#x261C;</button>';
    echo '</div>';

    echo file_get_contents("$email.txt");

  }
 
?>