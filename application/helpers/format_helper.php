<?php

if ( ! function_exists('readbleUniqID')) {
  function readbleUniqID($id) {
    $lengthOf = 4;
    $calcLoop = strlen($id) / $lengthOf;
    $startCounter = 0;
    $endCounter = $lengthOf;
    $results = [];

    for ($i = 0; $i < $calcLoop; $i++) {
      array_push($results, substr($id, $startCounter, $endCounter));
      
      $startCounter += $lengthOf;
    }

    return implode('-', $results);
  }
}

if ( ! function_exists('convertExamScores')) {
  function convertExamScores ($exam_scores) {
    $arr = [];
    
    foreach ($exam_scores as $key => $val) {
      $str = $key.'='.$val;
      array_push($arr, $str);
    }
  
    return implode(',', $arr);
  }
}

if ( ! function_exists('readbleExamScores')) {
  function readbleExamScores ($exam_scores) {
    $result = [];
    $exam_scores = explode(',', $exam_scores);

    foreach($exam_scores as $val) {
      $tmp = explode('=', $val);
      $result[$tmp[0]] = (int)$tmp[1];
    }

    return $result;
  }
}

?>