<?php
function jsksCp($numbers,$kjNumber){
    $numArr = explode(',',$numbers);
    $countNum = count(array_count_values($numArr));
    if($countNum!=1 || count($numArr)!=2){
        $returnData['win'] = 0;
        return $returnData;
    }
    if(count(array_intersect($numArr,$kjNumber)) == 2){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
        return $returnData;
    }
    return $returnData;
}
$numbers = '1,2';
$kjNumber = array(1,2,1);
$a = jsksCp($numbers,$kjNumber);
print_r($a);