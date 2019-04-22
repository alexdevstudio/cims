<?php

function excerpt($text, $words, $dots = '[...]'){
  $text = content($text);
  $text = strip_tags($text);
  $text_arr = explode(' ', $text);

  if(count($text_arr) >= $words){
    $text_arr = array_slice($text_arr, 0, $words);
    return implode(' ', $text_arr).' '.$dots;
  }else{
    return $text;
  }


}
