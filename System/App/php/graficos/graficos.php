<?php
 


function grafico($zona,$ano,$cargo,$quant){
    
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/Ordenacao.php');
    
    if(@$zona){
        @$zonaJOIN = " JOIN zona AS Z ON Z.ID_ZONA = R.ID_ZONA AND Z.NUMERO = $zona ";
    }

    if(@!$ano){
        @$ano = 2016;
    }
    if(@!$cargo){
        @$cargo = 11 ;
    }

    if(@!$quant){
        $quant = 100;
    }


    $queryT = "SELECT SUM(R.TOTAL_VOTOS) AS VOTOS FROM resultado_f R 
    JOIN candidato AS C ON C.ID_CANDIDATO = R.ID_CANDIDATO ".@$zonaJOIN." 
    JOIN CARGO AS CA ON CA.ID_CARGO = R.ID_CARGO AND CA.COD_CARGO = {$cargo}
    JOIN periodo_eleitoral AS P ON P.ID_PERIODO_ELEITORAL = R.ID_PERIODO AND P.ANO = {$ano} ";
     $resultT =  mysqli_query($con, $queryT);

     $totalVotos = mysqli_fetch_array($resultT)['VOTOS'];
    $query = "SELECT C.NOME_URNA, SUM(R.TOTAL_VOTOS) AS VOTOS FROM resultado_f R 
    JOIN candidato AS C ON C.ID_CANDIDATO = R.ID_CANDIDATO ".@$zonaJOIN." 
    JOIN CARGO AS CA ON CA.ID_CARGO = R.ID_CARGO AND CA.COD_CARGO = {$cargo}
    JOIN periodo_eleitoral AS P ON P.ID_PERIODO_ELEITORAL = R.ID_PERIODO AND P.ANO = {$ano}
    GROUP BY C.ID_CANDIDATO";
     $result =  mysqli_query($con, $query);
      
    
     
     while(@$infopro = mysqli_fetch_array($result)) {
        $X[$infopro['VOTOS']] = $infopro;
        $R[] = $infopro['VOTOS'];
        }
        $inicio = microtime(true);
        $B = array_reverse (bubbleSort($R));
        $fim = microtime(true);

        
        $i = 0;
        if(@$quant){
            foreach($B as $y){ 
                if($i<$quant){
                    $resp[@$i]['NOME_URNA'] = utf8_decode($X[$y]['NOME_URNA']);
                    $resp[@$i++]['VOTOS'] = number_format(($y/$totalVotos*100), 2, '.', '');
                }
                
               }
        }
        else{
            foreach($B as $y){ 
                if($i<$quant){
                    $resp[@$i]['NOME_URNA'] = utf8_decode($X[$y]['NOME_URNA']);
                    $resp[@$i++]['VOTOS'] = number_format($y/$totalVotos*100, 2, '.', '');
                }
                
               }
        }

          return $resp;
}



function grafico2($filtro,$ano){
    

    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');


    if(@!$ano){
        @$ano = 2016;
    } 
    
    if(@!$filtro){
        @$filtro = '1';
    }

    $queryT = "SELECT SUM(P.QTD_ELEITORES) AS ELEITORES FROM pesquisa_f P 
    JOIN periodo_eleitoral AS PE ON PE.ID_PERIODO_ELEITORAL = P.ID_PERIODO AND PE.ANO = ".$ano." 
    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = P.ID_FAIXA_ETARIA
    JOIN sexo AS SE ON SE.ID_SEXO = P.ID_SEXO
    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = P.ID_GRAU_ESC 
    JOIN  est_civil AS ES ON ES.ID_EST_CIVIL = P.ID_EST_CIVIL
    ;";
     $resultT =  mysqli_query($con, $queryT);

     $totalVotos = mysqli_fetch_array($resultT)['ELEITORES'];

    switch ($filtro) {
        case "1":
            $query="SELECT GR.GRAU_ESC AS FILTRO, SUM(P.QTD_ELEITORES) AS ELEITORES FROM pesquisa_f P 
            JOIN periodo_eleitoral AS PE ON PE.ID_PERIODO_ELEITORAL = P.ID_PERIODO AND PE.ANO = ".$ano." 
            JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = P.ID_FAIXA_ETARIA
            JOIN sexo AS SE ON SE.ID_SEXO = P.ID_SEXO
            JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = P.ID_GRAU_ESC 
            JOIN  est_civil AS ES ON ES.ID_EST_CIVIL = P.ID_EST_CIVIL
            GROUP BY GR.GRAU_ESC;";
       
            $result =  mysqli_query($con, $query);
      
    
     
            
        
        break;
        case "2":    
            $query="SELECT FA.FAIXA_ETARIA AS FILTRO, SUM(P.QTD_ELEITORES) AS ELEITORES FROM pesquisa_f P 
            JOIN periodo_eleitoral AS PE ON PE.ID_PERIODO_ELEITORAL = P.ID_PERIODO AND PE.ANO = ".$ano." 
            JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = P.ID_FAIXA_ETARIA
            JOIN sexo AS SE ON SE.ID_SEXO = P.ID_SEXO
            JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = P.ID_GRAU_ESC 
            JOIN  est_civil AS ES ON ES.ID_EST_CIVIL = P.ID_EST_CIVIL
            GROUP BY FA.FAIXA_ETARIA;";
       
            $result =  mysqli_query($con, $query);
            break;
         case "3":
          $query="SELECT SE.SEXO AS FILTRO, SUM(P.QTD_ELEITORES) AS ELEITORES FROM pesquisa_f P 
         JOIN periodo_eleitoral AS PE ON PE.ID_PERIODO_ELEITORAL = P.ID_PERIODO AND PE.ANO = ".$ano." 
         JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = P.ID_FAIXA_ETARIA
         JOIN sexo AS SE ON SE.ID_SEXO = P.ID_SEXO
         JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = P.ID_GRAU_ESC 
         JOIN  est_civil AS ES ON ES.ID_EST_CIVIL = P.ID_EST_CIVIL
         GROUP BY SE.SEXO;";
    
         $result =  mysqli_query($con, $query);

             break;
         case "4":
            $query="SELECT ES.EST_CIVIL AS FILTRO, SUM(P.QTD_ELEITORES) AS ELEITORES FROM pesquisa_f P 
         JOIN periodo_eleitoral AS PE ON PE.ID_PERIODO_ELEITORAL = P.ID_PERIODO AND PE.ANO = ".$ano." 
         JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = P.ID_FAIXA_ETARIA
         JOIN sexo AS SE ON SE.ID_SEXO = P.ID_SEXO
         JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = P.ID_GRAU_ESC 
         JOIN  est_civil AS ES ON ES.ID_EST_CIVIL = P.ID_EST_CIVIL
         GROUP BY ES.ID_EST_CIVIL;";
    
         $result =  mysqli_query($con, $query);
             break;
       
     
    }
   
    while(@$infopro = mysqli_fetch_array($result)) {
              
        $X[$infopro['ELEITORES']] = $infopro;
        $R[] = $infopro['ELEITORES'];
        }
        
        $i = 0;
        
            foreach($R as $y){ 
                
                    $resp[@$i]['FILTRO'] = utf8_decode($X[$y]['FILTRO']);
                    $resp[@$i++]['ELEITORES'] = number_format($y/$totalVotos*100, 2, '.', '');
                
                
               }
        

         return $resp;
}

function grafico3($filtro,$opc,$data){
    if($filtro && $opc ){
if($data==1){
$wherdata = "WHERE S.DATA = '2020-02-15'";
}
else if($data==2){
    $wherdata = "WHERE S.DATA = '2020-05-21'";
}
else{
    $wherdata = "";
}
        
   
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    

    $opcs = explode(";", $opc);
    

    switch ($opcs[0]) {
        case "P":
            $queryT = "SELECT  SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO AND  C.ID_CANDIDATO = ".$opcs[1]."
            JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
            JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
            JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
            JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO
             ".$wherdata."";
            $resultT =  mysqli_query($con, $queryT);

            $totalVotos = mysqli_fetch_array($resultT)['VOTOS'];
            switch ($filtro) {
              
                case "1":
                    $query="SELECT GR.GRAU_ESC AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO AND  C.ID_CANDIDATO = ".$opcs[1]."
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO ".$wherdata."   
                              GROUP BY S.ID_GRAU_ESC;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "2":
                     $query="SELECT FA.FAIXA_ETARIA AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO AND  C.ID_CANDIDATO = ".$opcs[1]."
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO   ".$wherdata." 
                              GROUP BY S.ID_FAIXA_ETARIA;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "3":
                    $query="SELECT SO.SEXO AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO AND  C.ID_CANDIDATO = ".$opcs[1]."
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO   ".$wherdata."  
                              GROUP BY S.ID_SEXO;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "4":
                    $query="SELECT Z.NUMERO AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO AND  C.ID_CANDIDATO = ".$opcs[1]."
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO     ".$wherdata."  
                              GROUP BY S.ID_ZONA;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
               
            }
        break;
        case "V":
            $queryT = "SELECT  SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  AND  C.ID_CANDIDATO = ".$opcs[1]."
            JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
            JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
            JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
            JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  ".$wherdata."   ;";
            $resultT =  mysqli_query($con, $queryT);
                    
            $totalVotos = mysqli_fetch_array($resultT)['VOTOS'];
            switch ($filtro) {
                case "1":
                    $query="SELECT GR.GRAU_ESC AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  AND  C.ID_CANDIDATO = ".$opcs[1]."
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  ".$wherdata."      
                              GROUP BY S.ID_GRAU_ESC;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "2":
                     $query="SELECT FA.FAIXA_ETARIA AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  AND  C.ID_CANDIDATO = ".$opcs[1]."
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO     ".$wherdata."  
                              GROUP BY S.ID_FAIXA_ETARIA;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "3":
                    $query="SELECT SO.SEXO AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  AND  C.ID_CANDIDATO = ".$opcs[1]."
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO    ".$wherdata."   
                              GROUP BY S.ID_SEXO;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "4":
                    $query="SELECT Z.NUMERO AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  AND  C.ID_CANDIDATO = ".$opcs[1]."
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO     ".$wherdata."  
                              GROUP BY S.ID_ZONA;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
               
            }
        break;
        case "PA":
            $queryT = "SELECT SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  
            JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
            JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
            JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
            JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO    AND   (PA.ID_PARTIDO = ".$opcs[1]." OR S.ID_PARTIDO = ".$opcs[1]." )  ".$wherdata."  ;";
            $resultT =  mysqli_query($con, $queryT);
                    
            $totalVotos = mysqli_fetch_array($resultT)['VOTOS'];
            switch ($filtro) {
                case "1":
                    $query="SELECT GR.GRAU_ESC AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO    AND   (PA.ID_PARTIDO = ".$opcs[1]." OR S.ID_PARTIDO = ".$opcs[1]." )
                        ".$wherdata."         GROUP BY S.ID_GRAU_ESC;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "2":
                     $query="SELECT FA.FAIXA_ETARIA AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO    AND   (PA.ID_PARTIDO = ".$opcs[1]." OR S.ID_PARTIDO = ".$opcs[1]." )
                       ".$wherdata."          GROUP BY S.ID_FAIXA_ETARIA;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "3":
                    $query="SELECT SO.SEXO AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO    AND   (PA.ID_PARTIDO = ".$opcs[1]." OR S.ID_PARTIDO = ".$opcs[1]." )
                        ".$wherdata."         GROUP BY S.ID_SEXO;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
                case "4":
                    $query="SELECT Z.NUMERO AS NOME, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                    JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR  
                    JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                    JOIN faixa_etaria AS FA ON FA.ID_FAIXA_ETARIA = S.ID_FAIXA_ETARIA
                    JOIN grau_esc AS GR ON GR.ID_GRAU_ESC = S.ID_GRAU_ESC
                    JOIN sexo AS SO ON SO.ID_SEXO = S.ID_SEXO
                    JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO   AND   (PA.ID_PARTIDO = ".$opcs[1]." OR S.ID_PARTIDO = ".$opcs[1]." )   
                        ".$wherdata."         GROUP BY S.ID_ZONA;";
               
                    $result =  mysqli_query($con, $query);
                
                break;
            
            }
        break;


    }

    while(@$infopro = mysqli_fetch_array($result)) {
              
        $X[$infopro['VOTOS']] = $infopro;
        $R[] = $infopro['VOTOS'];
        }
        
        $i = 0;
            foreach($R as $y){ 
                
                    $resp[@$i]['NOME'] = utf8_decode($X[$y]['NOME']);
                    $resp[@$i++]['VOTOS'] = number_format($y/$totalVotos*100, 2, '.', '');
                
                
               }
        

         return $resp;

        }
}


function grafico4($filtro){
    if($filtro){

    
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');


    switch ($filtro) {
        case "1":
            $queryT = "SELECT SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
            WHERE S.DATA = '2020-02-15'
            ;";
             $resultT =  mysqli_query($con, $queryT);
        
             $totalVotos = mysqli_fetch_array($resultT)['VOTOS'];

            $query="SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
            WHERE S.DATA = '2020-02-15'
             GROUP BY C.ID_CANDIDATO;";
       
            $result =  mysqli_query($con, $query);
      
    
     
            
        
        break;
        case "2":    
            $queryT = "SELECT SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
            WHERE S.DATA = '2020-05-21'
            ;";
             $resultT =  mysqli_query($con, $queryT);
        
             $totalVotos = mysqli_fetch_array($resultT)['VOTOS'];

            $query="SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
            WHERE S.DATA = '2020-05-21'
             GROUP BY C.ID_CANDIDATO;";
       
            $result =  mysqli_query($con, $query);
            break;
    case "3":    
        $queryT = "SELECT SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
        JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
        JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO 
        ;";
         $resultT =  mysqli_query($con, $queryT);
    
         $totalVotos = mysqli_fetch_array($resultT)['VOTOS'];

        $query="SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
        JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
        JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
        WHERE S.DATA = '2020-05-21'
         GROUP BY C.ID_CANDIDATO;";
   
        $result =  mysqli_query($con, $query);
        break;
    }

         while(@$infopro = mysqli_fetch_array($result)) {
              
        $X[$infopro['VOTOS']] = $infopro;
        $R[] = $infopro['VOTOS'];
        }
        
        $i = 0;
        
            foreach($R as $y){ 
                
                    $resp[@$i]['NOME_URNA'] = utf8_decode($X[$y]['NOME_URNA']);
                    $resp[@$i++]['VOTOS'] = number_format($y/$totalVotos*100, 2, '.', '');
                
                
               }

               return $resp;
     }

}

function tabela(){
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/estatistica.php');
    
    $queryT = "SELECT SUM(VOTO) AS VOTOS FROM simulacao WHERE ID_PREFEITO IS NOT NULL ;";
    $resultT =  mysqli_query($con, $queryT);
            
    $totalVotos = mysqli_fetch_array($resultT)['VOTOS'];



    $query="SELECT * FROM estatistica;";
   
        $result =  mysqli_query($con, $query);
      
    
    while(@$infopro = mysqli_fetch_array($result)) {
        $totalVotosp = $infopro['VOTOS1'] + $infopro['VOTOS2'] ;
        $X[$totalVotosp] = $infopro;

        $R[] = $totalVotosp;
        
    
    
    }
        
        $i = 0;
        
            foreach($R as $y){ 
                
                    $resp[@$i]['NOME_URNA'] = utf8_decode($X[$y]['NOME_URNA']);
                    $resp[@$i]['VOTOS1'] = number_format($X[$y]['VOTOS1']/$totalVotos*100, 2, '.', '');
                    $resp[@$i]['VOTOS2'] = number_format($X[$y]['VOTOS2']/$totalVotos*100, 2, '.', '');
                    
                    $array = [$resp[@$i]['VOTOS1'],$resp[@$i]['VOTOS2'] ];
                    
                    $resp[@$i]['MEDIA'] =  media($array);
                    $resp[@$i]['MEDIA'] =  media($array);
                    $resp[@$i]['S'] =  desvioPadrao($array);
                    $resp[@$i]['MEDIAS1'] =  mediaMais1S($array);
                    $resp[@$i]['MEDIAM1'] =  mediaMenos1S($array);
                    $resp[@$i++]['COEF'] =  coeficienteVariacao($array);
                    
                
                
               }

               return $resp;

    
}



?>