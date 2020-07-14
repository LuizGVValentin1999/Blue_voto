
   
   <?php
   function sanitizeString($string) {

    // matriz de entrada
    $what = array( ':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º','°',"'" );
  
    // matriz de saída
    $by   = array( ' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','' );
  
    // devolver a string
    return str_replace($what, $by, $string);
  }
  
  

  function manutencaoresult($link){
      
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/Ordenacao.php');
    $file = fopen("C:\Users\Luiz Gustavo\Documents\p.i/".$link, "r");
         $result = array();
         $i = 0;
         while (!feof($file)){
      $linha[] =[];
      
      
          if (substr(($result[] = fgets($file)), 0, 10) !== ',') {
      
        $linha = explode(";", $result[$i]);
        if($i != 0){
        $linha[0] = sanitizeString($linha[0]);
        $linha[1] = sanitizeString($linha[1]);
        $INFF[1] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_PERIODO_ELEITORAL FROM periodo_eleitoral WHERE ANO  = ".$linha[0]." AND PERIODO = ".$linha[1]))['ID_PERIODO_ELEITORAL'];    
        
        $linha[3] = sanitizeString($linha[3]);
        $INFF[2] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_MUNICIPIO FROM municipio WHERE COD_MUNICIPIO =  ".$linha[3]))['ID_MUNICIPIO'];

        $linha[5] = sanitizeString($linha[5]);
        $INFF[3] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_ZONA FROM zona WHERE NUMERO = ".$linha[5]))['ID_ZONA'];

        $linha[6] = sanitizeString($linha[6]);
        $INFF[4] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_CARGO FROM cargo WHERE COD_CARGO = ".$linha[6]))['ID_CARGO'];

        $linha[7] = sanitizeString($linha[7]);
        $INFF[5] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_CANDIDATO FROM candidato WHERE NUMERO_CANDIDATO = ".$linha[7]))['ID_CANDIDATO'];

        $linha[11] = sanitizeString($linha[11]);
        $INFF[6] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_SITUACAO FROM situacao WHERE SITUACAO LIKE '%".$linha[11]."%'"))['ID_SITUACAO'];

        $linha[12] = sanitizeString($linha[12]);
        $INFF[7] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_PARTIDO FROM partido WHERE NUMERO_PARTIDO =  ".$linha[12]))['ID_PARTIDO'];

        $linha[15] = sanitizeString($linha[15]);
        $INFF[8] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_COLIGACAO FROM coligacao WHERE COLIGACAO LIKE '%".$linha[15]."%'"))['ID_COLIGACAO'];

        $INFF[9] = sanitizeString($linha[16]);
        
         @$query= ("INSERT INTO `resultado_f` (`ID_PERIODO`, `ID_MUNICIPIO`, `ID_ZONA`, `ID_CARGO`, `ID_CANDIDATO`, `ID_SITUACAO`, `ID_PARTIDO`, `ID_COLIGACAO`, `TOTAL_VOTOS`) VALUES ('".$INFF[1]."', '".$INFF[2]."', '".$INFF[3]."', '".$INFF[4]."', '".$INFF[5]."', '".$INFF[6]."', '".$INFF[7]."', '".$INFF[8]."', '".$INFF[9]."');");
         
        
        echo($query).'</BR>';
      //    $result_user = mysqli_query($con, $query);
        
              //   var_dump($query);// $linha é o array de cada linha  utilize inset value in ($linha[1],$linha[2])  
        
        
              
                
              }
             
        
            $i++;
            }
      
  
          }
         
         
         fclose($file);

    }
function manutencaopesquisa($link){
       
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/Ordenacao.php');
    $file = fopen("C:\Users\Luiz Gustavo\Documents\p.i/".$link, "r");
         $result = array();
         $i = 0;
         while (!feof($file)){
      $linha[] =[];
      
      
          if (substr(($result[] = fgets($file)), 0, 10) !== ',') {
      
        $linha = explode(";", $result[$i]);
        if($i != 0){
        $linha[0] = sanitizeString($linha[0]);
        $linha[1] = sanitizeString($linha[1]);
        $INFF[1] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_PERIODO_ELEITORAL FROM periodo_eleitoral WHERE ANO  = ".$linha[0]." AND PERIODO = ".$linha[1]))['ID_PERIODO_ELEITORAL'];    
        
        $linha[3] = sanitizeString($linha[3]);
        $INFF[2] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_MUNICIPIO FROM municipio WHERE COD_MUNICIPIO =  ".$linha[3]))['ID_MUNICIPIO'];

        $linha[5] = sanitizeString($linha[5]);
        $INFF[3] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_ZONA FROM zona WHERE NUMERO = ".$linha[5]))['ID_ZONA'];

        $linha[6] = sanitizeString($linha[6]);
        $INFF[4] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_CARGO FROM cargo WHERE COD_CARGO = ".$linha[6]))['ID_CARGO'];

        $linha[7] = sanitizeString($linha[7]);
        $INFF[5] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_CANDIDATO FROM candidato WHERE NUMERO_CANDIDATO = ".$linha[7]))['ID_CANDIDATO'];

        $linha[11] = sanitizeString($linha[11]);
        $INFF[6] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_SITUACAO FROM situacao WHERE SITUACAO LIKE '%".$linha[11]."%'"))['ID_SITUACAO'];

        $linha[12] = sanitizeString($linha[12]);
        $INFF[7] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_PARTIDO FROM partido WHERE NUMERO_PARTIDO =  ".$linha[12]))['ID_PARTIDO'];

        $linha[15] = sanitizeString($linha[15]);
        $INFF[8] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_COLIGACAO FROM coligacao WHERE COLIGACAO LIKE '%".$linha[15]."%'"))['ID_COLIGACAO'];

        $INFF[9] = sanitizeString($linha[16]);
        
         @$query= ("INSERT INTO `resultado_f` (`ID_PERIODO`, `ID_MUNICIPIO`, `ID_ZONA`, `ID_CARGO`, `ID_CANDIDATO`, `ID_SITUACAO`, `ID_PARTIDO`, `ID_COLIGACAO`, `TOTAL_VOTOS`) VALUES ('".$INFF[1]."', '".$INFF[2]."', '".$INFF[3]."', '".$INFF[4]."', '".$INFF[5]."', '".$INFF[6]."', '".$INFF[7]."', '".$INFF[8]."', '".$INFF[9]."');");
         
        
        echo($query).'</BR>';
      //    $result_user = mysqli_query($con, $query);
        
              //   var_dump($query);// $linha é o array de cada linha  utilize inset value in ($linha[1],$linha[2])  
        
        
              
                
              }
             
        
            $i++;
            }
      
  
          }
         
         
         fclose($file);
 }

 function manutencaozona($link){
   
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/Ordenacao.php');
    $file = fopen("C:\Users\Luiz Gustavo\Documents\p.i/".$link, "r");
         $result = array();
         $i = 0;
         while (!feof($file)){
      $linha[] =[];
      
      
          if (substr(($result[] = fgets($file)), 0, 10) !== ',') {
      
        $linha = explode(";", $result[$i]);
        if($i != 0){
        $linha[0] = sanitizeString($linha[0]);
        $linha[1] = sanitizeString($linha[1]);
        $INFF[1] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_PERIODO_ELEITORAL FROM periodo_eleitoral WHERE ANO  = ".$linha[0]." AND PERIODO = ".$linha[1]))['ID_PERIODO_ELEITORAL'];    
        
        $linha[3] = sanitizeString($linha[3]);
        $INFF[2] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_MUNICIPIO FROM municipio WHERE COD_MUNICIPIO =  ".$linha[3]))['ID_MUNICIPIO'];

        $linha[5] = sanitizeString($linha[5]);
        $INFF[3] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_ZONA FROM zona WHERE NUMERO = ".$linha[5]))['ID_ZONA'];

        $linha[6] = sanitizeString($linha[6]);
        $INFF[4] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_CARGO FROM cargo WHERE COD_CARGO = ".$linha[6]))['ID_CARGO'];

        $linha[7] = sanitizeString($linha[7]);
        $INFF[5] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_CANDIDATO FROM candidato WHERE NUMERO_CANDIDATO = ".$linha[7]))['ID_CANDIDATO'];

        $linha[11] = sanitizeString($linha[11]);
        $INFF[6] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_SITUACAO FROM situacao WHERE SITUACAO LIKE '%".$linha[11]."%'"))['ID_SITUACAO'];

        $linha[12] = sanitizeString($linha[12]);
        $INFF[7] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_PARTIDO FROM partido WHERE NUMERO_PARTIDO =  ".$linha[12]))['ID_PARTIDO'];

        $linha[15] = sanitizeString($linha[15]);
        $INFF[8] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_COLIGACAO FROM coligacao WHERE COLIGACAO LIKE '%".$linha[15]."%'"))['ID_COLIGACAO'];

        $INFF[9] = sanitizeString($linha[16]);
        
         @$query= ("INSERT INTO `resultado_f` (`ID_PERIODO`, `ID_MUNICIPIO`, `ID_ZONA`, `ID_CARGO`, `ID_CANDIDATO`, `ID_SITUACAO`, `ID_PARTIDO`, `ID_COLIGACAO`, `TOTAL_VOTOS`) VALUES ('".$INFF[1]."', '".$INFF[2]."', '".$INFF[3]."', '".$INFF[4]."', '".$INFF[5]."', '".$INFF[6]."', '".$INFF[7]."', '".$INFF[8]."', '".$INFF[9]."');");
         
        
        echo($query).'</BR>';
      //    $result_user = mysqli_query($con, $query);
        
              //   var_dump($query);// $linha é o array de cada linha  utilize inset value in ($linha[1],$linha[2])  
        
        
              
                
              }
             
        
            $i++;
            }
      
  
          }
         
         
         fclose($file);
 }

 function manutencaocandidato($link){
   
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/Ordenacao.php');
    $file = fopen("C:\Users\Luiz Gustavo\Documents\p.i/".$link, "r");
         $result = array();
         $i = 0;
         while (!feof($file)){
      $linha[] =[];
      
      
          if (substr(($result[] = fgets($file)), 0, 10) !== ',') {
      
        $linha = explode(";", $result[$i]);
        if($i != 0){
        $linha[0] = sanitizeString($linha[0]);
        $linha[1] = sanitizeString($linha[1]);
        $INFF[1] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_PERIODO_ELEITORAL FROM periodo_eleitoral WHERE ANO  = ".$linha[0]." AND PERIODO = ".$linha[1]))['ID_PERIODO_ELEITORAL'];    
        
        $linha[3] = sanitizeString($linha[3]);
        $INFF[2] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_MUNICIPIO FROM municipio WHERE COD_MUNICIPIO =  ".$linha[3]))['ID_MUNICIPIO'];

        $linha[5] = sanitizeString($linha[5]);
        $INFF[3] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_ZONA FROM zona WHERE NUMERO = ".$linha[5]))['ID_ZONA'];

        $linha[6] = sanitizeString($linha[6]);
        $INFF[4] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_CARGO FROM cargo WHERE COD_CARGO = ".$linha[6]))['ID_CARGO'];

        $linha[7] = sanitizeString($linha[7]);
        $INFF[5] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_CANDIDATO FROM candidato WHERE NUMERO_CANDIDATO = ".$linha[7]))['ID_CANDIDATO'];

        $linha[11] = sanitizeString($linha[11]);
        $INFF[6] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_SITUACAO FROM situacao WHERE SITUACAO LIKE '%".$linha[11]."%'"))['ID_SITUACAO'];

        $linha[12] = sanitizeString($linha[12]);
        $INFF[7] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_PARTIDO FROM partido WHERE NUMERO_PARTIDO =  ".$linha[12]))['ID_PARTIDO'];

        $linha[15] = sanitizeString($linha[15]);
        $INFF[8] = mysqli_fetch_array(mysqli_query($con, "SELECT ID_COLIGACAO FROM coligacao WHERE COLIGACAO LIKE '%".$linha[15]."%'"))['ID_COLIGACAO'];

        $INFF[9] = sanitizeString($linha[16]);
        
         @$query= ("INSERT INTO `resultado_f` (`ID_PERIODO`, `ID_MUNICIPIO`, `ID_ZONA`, `ID_CARGO`, `ID_CANDIDATO`, `ID_SITUACAO`, `ID_PARTIDO`, `ID_COLIGACAO`, `TOTAL_VOTOS`) VALUES ('".$INFF[1]."', '".$INFF[2]."', '".$INFF[3]."', '".$INFF[4]."', '".$INFF[5]."', '".$INFF[6]."', '".$INFF[7]."', '".$INFF[8]."', '".$INFF[9]."');");
         
        
        echo($query).'</BR>';
      //    $result_user = mysqli_query($con, $query);
        
              //   var_dump($query);// $linha é o array de cada linha  utilize inset value in ($linha[1],$linha[2])  
        
        
              
                
              }
             
        
            $i++;
            }
      
  
          }
         
         
         fclose($file);
 }

 function manutencaousuario($link){
   
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/Ordenacao.php');
    $file = fopen("C:\Users\Luiz Gustavo\Documents\p.i/".$link, "r");
         $result = array();
         $i = 0;
         while (!feof($file)){
      $linha[] =[];
      
      
          if (substr(($result[] = fgets($file)), 0, 10) !== ',') {
      
        $linha = explode(";", $result[$i]);
        if($i != 0 AND $linha[0] ){
        $linha[0] = sanitizeString($linha[0]);
        $linha[1] = sanitizeString($linha[1]);
       
        
         @$query= ("INSERT INTO `usuario` (`USUARIO`, `SENHA`) VALUES ('".$linha[0]."', md5('".$linha[1]."'));");
         
        
        echo($query).'</BR>';
       $result_user = mysqli_query($con, $query);
        
              //   var_dump($query);// $linha é o array de cada linha  utilize inset value in ($linha[1],$linha[2])  
        
        
              
                
              }
             
        
            $i++;
            }
      
  
          }
         
         
         fclose($file);
 }

 function baixar($ano){
   if(@$ano){
      $anoj = " AND PE.ANO = ".$ano." ";
   }
    @session_start();
    $_SESSION['excel'] = 1;
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/Ordenacao.php');

    $dadosXls  = "";
    $dadosXls .= "  <table border='1' >";
$dadosXls .= "          <tr>";
    $dadosXls .= "          <th>ANO</th>";
    $dadosXls .= "          <th>PERIODO</th>";
    $dadosXls .= "          <th>COD_MUNICIPIO</th>";
    $dadosXls .= "          <th>MUNICIPIO</th>";
    $dadosXls .= "          <th>ZONA</th>";
    $dadosXls .= "          <th>COD_CARGO</th>";
    $dadosXls .= "          <th>CARGO</th>";
    $dadosXls .= "          <th>NUMERO_CANDIDATO</th>";
    $dadosXls .= "          <th>NOME_CANDIDATO</th>";
    $dadosXls .= "          <th>NOME_URNA</th>";
    $dadosXls .= "          <th>NUMERO_PARTIDO</th>";
    $dadosXls .= "          <th>NOME_PARTIDO</th>";
    $dadosXls .= "          <th>SIGLA_PARTIDO</th>";
    $dadosXls .= "          <th>COLIGACAO</th>";
    $dadosXls .= "          <th>SITUACAO</th>";
    $dadosXls .= "          <th>TOTAL_VOTOS</th>";
    $dadosXls .= "      </tr>";

    $queryy = "SELECT PE.ANO, PE.PERIODO, MU.COD_MUNICIPIO, MU.MUNICIPIO, Z.NUMERO AS ZONA, C.COD_CARGO, C.CARGO, CA.NUMERO_CANDIDATO, CA.NOME_CANDIDATO, 
    CA.NOME_URNA, PA.NUMERO_PARTIDO, PA.NOME_PARTIDO, PA.SIGLA_PARTIDO, CO.COLIGACAO , SI.SITUACAO, R.TOTAL_VOTOS FROM resultado_f R
    JOIN periodo_eleitoral AS PE ON PE.ID_PERIODO_ELEITORAL = R.ID_PERIODO ".@$anoj."
    JOIN municipio AS MU ON MU.ID_MUNICIPIO = R.ID_MUNICIPIO
    JOIN zona AS Z ON Z.ID_ZONA = R.ID_ZONA 
    JOIN cargo AS C ON C.ID_CARGO = R.ID_CARGO
    JOIN candidato AS CA ON CA.ID_CANDIDATO = R.ID_CANDIDATO
    JOIN partido AS PA ON PA.ID_PARTIDO = R.ID_PARTIDO 
    JOIN situacao AS SI ON SI.ID_SITUACAO = R.ID_SITUACAO
    JOIN coligacao AS CO ON CO.ID_COLIGACAO = R.ID_COLIGACAO;";
                                    $resultt = mysqli_query($con, $queryy);
                                    
                                    while($infoitens = mysqli_fetch_array($resultt)) {
        $dadosXls .= "      <tr>";
        $dadosXls .= "          <td>". $infoitens['ANO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['PERIODO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['COD_MUNICIPIO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['MUNICIPIO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['ZONA'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['COD_CARGO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['CARGO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['NUMERO_CANDIDATO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['NOME_CANDIDATO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['NOME_URNA'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['NUMERO_PARTIDO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['NOME_PARTIDO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['SIGLA_PARTIDO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['COLIGACAO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['SITUACAO'] . "</td>";
        $dadosXls .= "          <td>". $infoitens['TOTAL_VOTOS'] . "</td>";
        
               $dadosXls .= "      </tr>";
                                    }
    $dadosXls .= "  </table>";
 
    // Definimos o nome do arquivo que será exportado  
    $arquivo = "RESULTADO DE ".$ano.".xls";  
    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');
       
    // Envia o conteúdo do arquivo  
    
    
    echo $dadosXls;  

    exit;

 }
    
                

