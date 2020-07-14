<?php

function gerarLista($zona,$ano,$cargo,$ordena){


      
    header("Content-type: text/html; charset=utf-8"); 
    include('System/Checker/conection.php');
    include('System/App/php/Ordenacao.php');
    
    if(@$zona){
        @$zonaJOIN = " JOIN zona AS Z ON Z.ID_ZONA = R.ID_ZONA AND Z.NUMERO = $zona ";
        @$zonaJOINS = " JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA AND Z.NUMERO = $zona ";
    }

    if(@$ano){
        @$anoJ = " AND P.ANO = {$ano} ";
    }
    if(@$cargo){
        @$cargoJ = " AND CA.COD_CARGO = {$cargo} " ;
    }

    if(@$ano == 2020){
        if(@$cargo == 11 ){
            $query =  "SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
            ".@$zonaJOINS."
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
             GROUP BY C.ID_CANDIDATO;";
        }
        else if(@$cargo == 13 ){
            $query =  "SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR 
            ".@$zonaJOINS."
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
             GROUP BY C.ID_CANDIDATO;";

        }
        else{
            $query =  "SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
            ".@$zonaJOINS."
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
             GROUP BY C.ID_CANDIDATO
             UNION
             SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR 
            ".@$zonaJOINS."
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
             GROUP BY C.ID_CANDIDATO;";
        }
        


         $result =  mysqli_query($con, $query);

    }
    else if(@$ano){
        $query =  "SELECT C.NOME_URNA, PA.NOME_PARTIDO, SUM(R.TOTAL_VOTOS) AS VOTOS, P.ANO FROM resultado_f R 
        JOIN candidato AS C ON C.ID_CANDIDATO = R.ID_CANDIDATO 
        ".@$zonaJOIN." 
        JOIN CARGO AS CA ON CA.ID_CARGO = R.ID_CARGO ".@$cargoJ." 
        JOIN periodo_eleitoral AS P ON P.ID_PERIODO_ELEITORAL = R.ID_PERIODO ".@$anoJ." 
        JOIN partido AS PA ON PA.ID_PARTIDO = R.ID_PARTIDO  
        GROUP BY C.ID_CANDIDATO";
         $result =  mysqli_query($con, $query);
    }

    else{
        $query =  "SELECT C.NOME_URNA, PA.NOME_PARTIDO, SUM(R.TOTAL_VOTOS) AS VOTOS, P.ANO FROM resultado_f R 
        JOIN candidato AS C ON C.ID_CANDIDATO = R.ID_CANDIDATO 
        ".@$zonaJOIN." 
        JOIN CARGO AS CA ON CA.ID_CARGO = R.ID_CARGO ".@$cargoJ." 
        JOIN periodo_eleitoral AS P ON P.ID_PERIODO_ELEITORAL = R.ID_PERIODO ".@$anoJ." 
        JOIN partido AS PA ON PA.ID_PARTIDO = R.ID_PARTIDO  
        GROUP BY C.ID_CANDIDATO   
         UNION   
        ";

        if(@$cargo == 11 ){
            $query .=  " SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
            ".@$zonaJOINS."
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
             GROUP BY C.ID_CANDIDATO; ";
        }
        else if(@$cargo == 13 ){
            $query .=  " SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR 
            ".@$zonaJOINS."
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
             GROUP BY C.ID_CANDIDATO; ";

        }
        else{
            $query .=  " SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
            ".@$zonaJOINS."
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
             GROUP BY C.ID_CANDIDATO
             UNION
             SELECT C.NOME_CANDIDATO as NOME_URNA, PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR 
            ".@$zonaJOINS."
            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
             GROUP BY C.ID_CANDIDATO; ";
        }
        
         $result =  mysqli_query($con, $query);

    }
   

    
      
    
      
     while(@$infopro = mysqli_fetch_array($result)) {
        $X[$infopro['VOTOS']] = $infopro;
        $R[] = $infopro['VOTOS'];
        }
               if($ordena){
            $inicio =  round(microtime(true) * 1000);
            
            switch ($ordena) {
                case "1":
                    $R = bubbleSort($R);
                    break;
                case "2":
                    $R = selectionSort($R);
                    break;
                case "3":
                    $R = insertSort($R);
                    break;
                case "4":
                    $R = quicksortt($R);
                    break;
                case "5":
                    $R = mergeSort($R);
                    break;
                case "6":
                    $R = HeapSort($R);
                     break;
                case "7":
                    $T = array_reverse (quicksortt($R));
                    $inicio =  round(microtime(true) * 1000);
                    $R = counting_sort($R,$T[0]);
                    break;
                case "8":
                    $R = radixsort($R);
                    break;
                case "9":
                    $R = BucketSort($R);
                    break;
                                
            }
            
            $fim =  round(microtime(true) * 1000);
            $R = array_reverse ($R);
            $resp['tempo'] =  "tempo de ordenação ". ($fim - $inicio) . "ms";
            
        }
        
            foreach($R as $y){ 
                    $resp['tab'][@$i]['NOME_URNA'] = utf8_decode($X[$y]['NOME_URNA']);
                    $resp['tab'][@$i]['NOME_PARTIDO'] = utf8_decode($X[$y]['NOME_PARTIDO']);
                    $resp['tab'][@$i]['ANO'] = $X[$y]['ANO'];
                    $resp['tab'][@$i++]['VOTOS'] = $y;
                
                
               }
        

          return $resp;
}


?>
