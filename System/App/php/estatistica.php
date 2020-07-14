<?php
function media($array){
    $resultado = 0;
    for($i = 0; $i<count($array);$i++){
        $resultado += $array[$i];
    }
    return $resultado / count($array);
}

function desvioPadrao($array){
   $media = media($array);
   $somatoria = 0;

    for($i = 0; $i<count($array);$i++){
        $somatoria += pow($array[$i]-$media, 2);
    }

    return sqrt($somatoria/(count($array)-1));

}

function atribuirMediaEDesvioPadrao($array){
    $media = media($array);
    $desviopradao = desvioPadrao($array);
    
    return $desviopradao;
 
 }
 
 function mediaMais1S($array){
    $desvio = atribuirMediaEDesvioPadrao($array);
    $media = media($array);
   
    return  $media + $desvio;
 
 }

 function mediaMenos1S($array){
    $desvio = atribuirMediaEDesvioPadrao($array);
    $media = media($array);
   
    return  $media - $desvio;
 
 }

 function coeficienteVariacao($array){
    $desvio = atribuirMediaEDesvioPadrao($array);
    $media = media($array);
   
    return    100*($desvio / abs($media));
 
 }

?>
