<?php
function quick_sort($my_array)
{
    $loe = $gt = array();
    if(count($my_array) < 2)
    {
        return $my_array;
    }
    $pivot_key = key($my_array);
    $pivot = array_shift($my_array);
    foreach($my_array as $val)
    {
        if($val <= $pivot)
        {
            $loe[] = $val;
        }elseif ($val > $pivot)
        {
            $gt[] = $val;
        }
    }
    return array_merge(quick_sort($loe),array($pivot_key=>$pivot),quick_sort($gt));
}

function SearchIn($HaystackArray, $needleArray){
    $i = 0;

    $response = array(
        "users" => array(),
    );

    foreach ($needleArray as $needleArrayKey => $needleArrayItem) {
        $HasItem = array_search($needleArrayItem, $HaystackArray);

        if(!$HasItem){
            array_push($response["users"], $needleArrayItem);
            $i++;
        }
//    foreach ($followers as $followersKey => $follower) {
//        if ($follower == $following) {
//            $varMi = true;
//            break;
//        }
//    }

//    if ($varMi == false) {
//        $unrequited[$i] = $following;
//        $i++;
//    }
    }

    $response["users"] = quick_sort($response["users"]);
    $response["count"] = $i;

    return $response;
}

function MergeTwoArray($array1, $array2){
    $array = array_unique (array_merge ($array1, $array2));

    return quick_sort($array);
}
