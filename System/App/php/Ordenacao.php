<?php

//BubbleSort

function bubbleSort ($x){

    
    $n=0;
    $tam =count($x);
    for($i=0; $i<$tam-1; $i++){
        $aux=true;
        for($j=0; $j<($tam-1)-$i; $j++){
                if($x[$j]>$x[$j+1]){
                $n=$x[$j];
                $x[$j]=$x[$j+1];
                $x[$j+1]=$n;
                $aux=false;
            }
         }
         if($aux){
         break;
         }
    }
    
    return $x;
    }

    // SelectionSort
    function selectionSort($x)  
    {  
            $n=0;
        $tam =count($x);
        for($i=0; $i<$tam-1; $i++){
        $mini=$i;
            for($j = $i+1; $j <$tam; $j++ ){
                if($x[$j] < $x[$mini] ){
                    $mini=$j;
                }
            }
                if($x[$i]!=$x[$mini]){
                $n=$x[$mini];
                $x[$mini]=$x[$i];
                $x[$i]=$n;
                
            }
        }
        
        return $x;
    }  


//insertSort


function insertSort($x){
    $tam =count($x);
for($i=1; $i<$tam; $i++){
$chave=$x[$i];
$j = $i-1;
    while(($j>=0) && ($x[$j]>$chave) ){
        $x[$j+1]=$x[$j];
        $j--;
        }
        $x[$j+1]=$chave;
   
    }
    return $x;
}


//quickSort
function quicksort($x,$ini,$fim){
    
    $n = 0;    
    $i = $ini;
    $j = $fim;
    $p =(int)(($ini+$fim+1)/2);
    $piivo =$x[$p];
        while($i < $j){
            while($x[$i]<$piivo){
                $i++;
                 }
            while($x[$j]>$piivo){
                $j--;
            }
        
            if($i<=$j){
                $n=$x[$i];
                $x[$i]=$x[$j];
                $x[$j]=$n;
                $i++; $j--;
                    }    
        }
    
    if($ini<$j){
         $x = quicksort($x,$ini,$j);
    }
    if($i<$fim){
          $x = quicksort($x,$i,$fim);
    }
    return $x;

}

        function quicksortt($x){
            $ini =0;
            $fim =count($x)-1;

            return quicksort($x,$ini,$fim);
    }

    //mergeSort
function mergeSort($array)
{
    if(count($array) == 1 )
    {
        return $array;
    }

    $mid = count($array) / 2;
    $left = array_slice($array, 0, $mid);
    $right = array_slice($array, $mid);
    $left = mergeSort($left);
    $right = mergeSort($right);

    return merge($left, $right);
}


function merge($left, $right)
{
    $res = array();

    while (count($left) > 0 && count($right) > 0)
    {
        if($left[0] > $right[0])
        {
            $res[] = $right[0];
            $right = array_slice($right , 1);
        }
        else
        {
            $res[] = $left[0];
            $left = array_slice($left, 1);
        }
    }

    while (count($left) > 0)
    {
        $res[] = $left[0];
        $left = array_slice($left, 1);
    }

    while (count($right) > 0)
    {
        $res[] = $right[0];
        $right = array_slice($right, 1);
    }

    return $res;
}


//radixsort
    function countSort(&$arr, $n, $exp){  
    $output = array_fill(0, $n, 0); // output array  
    $count = array_fill(0, 10, 0);  
  
    
    for ($i = 0; $i < $n; $i++)  
        $count[ ($arr[$i] / $exp) % 10 ]++;  
  
  
    for ($i = 1; $i < 10; $i++)  
        $count[$i] += $count[$i - 1];  
    for ($i = $n - 1; $i >= 0; $i--)  
    {  
        $output[$count[ ($arr[$i] /  
                         $exp) % 10 ] - 1] = $arr[$i];  
        $count[ ($arr[$i] / $exp) % 10 ]--;  
    }  
    for ($i = 0; $i < $n; $i++)  
        $arr[$i] = $output[$i];  
}  

//radixsort
function radixsort($arr)  
{  
    $n = count($arr); //tamanho do array 
    $m = max($arr);  // maior numero do array 
    for ($exp = 1; $m / $exp > 0; $exp *= 10)  
        countSort($arr, $n, $exp);  
        return $arr;
}


//BucketSort
function BucketSort($array)
{
	$minValue = 0; // menor valor estamos declaro que sera 0
	$maxValue = max($array); // maior valor do vetor
	$arrayLength = count($array);


	$bucket = array();
	$bucketLength = $maxValue - $minValue + 1;
	
	for ($i = 0; $i < $bucketLength; $i++)
	{
		$bucket[$i] = array();
	}

	for ($i = 0; $i < $arrayLength; $i++)
	{
		array_push($bucket[$array[$i] - $minValue], $array[$i]);
	}
	
	$k = 0;
	for ($i = 0; $i < $bucketLength; $i++)
	{
		$bucketCount = count($bucket[$i]);
		
		if ($bucketCount > 0)
		{
			for ($j = 0; $j < $bucketCount; $j++)   // aqui é a ordenação  insertion
			{
				$array[$k] = $bucket[$i][$j];
				$k++;
			}
		}
    }
    
    return $array;
}


 //HeapSort
function MaxHeapify(&$array, $heapSize, $index) {
    $left = ($index + 1) * 2 - 1;
    $right = ($index + 1) * 2;
    $largest = 0;
  
    if ($left < $heapSize && $array[$left] > $array[$index])
       $largest = $left;
    else
       $largest = $index;
  
    if ($right < $heapSize && $array[$right] > $array[$largest])
       $largest = $right;
  
    if ($largest != $index)
    {
       $temp = $array[$index];
       $array[$index] = $array[$largest];
       $array[$largest] = $temp;
  
       MaxHeapify($array, $heapSize, $largest);
    }
 }
 
 function HeapSort($array) {
    $heapSize = $count = count($array);
  //com o count do php conseguimos a informação do  BUILD-MAX-HEAP (nao tendo a nessecidade de inplementar  BUILD-MAX-HEAP )
    for ($p = ($heapSize - 1) / 2; $p >= 0; $p--)
       MaxHeapify($array, $heapSize, $p);
  
    for ($i = $count - 1; $i > 0; $i--)
    {
       $temp = $array[$i];
       $array[$i] = $array[0];
       $array[0] = $temp;
  
       $heapSize--;
       MaxHeapify($array, $heapSize, 0);
    }

    return $array;
 }

 // o countSort
 function counting_sort($my_array, $max)
{
    // $max seria o maior numero que queremos ordenar 
    // so enviamos apenas o  maximo pois levamos en consideração que o menor numero que queremos enviar é 0 
  $count = array();
  for($i = 0; $i <= $max; $i++)
  {
    $count[$i] = 0;
  }
 
  // $count descobre a quantidade de numeros que queremos ordenar fazendo a função do n
  foreach($my_array as $number)
  {
    $count[$number]++; 
  }
  $z = 0;
  for($i = 0; $i <= $max; $i++) {
    while( $count[$i]-- > 0 ) {
      $my_array[$z++] = $i;
    }
  }
  return $my_array;
}
