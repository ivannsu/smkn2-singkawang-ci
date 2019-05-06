<?php

if ( ! function_exists('dateformat')) {
  function dateformat($date) {
    $date = explode('-', $date);
  
    return $date[2].'-'.$date[1].'-'.$date[0];
  }
}

if ( ! function_exists('timeformat')) {
  function timeformat($time) {
    $time = explode(':', $time);
  
    return $time[0].':'.$time[1];
  }
}

?>