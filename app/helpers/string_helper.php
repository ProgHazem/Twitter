<?php


// function that return 3 wordes
function sub_words($text) {
    if (str_word_count($text) > 5) {
        $arr_word = explode(" ", $text);
        $wrap3words = $arr_word[0] . " " . $arr_word[1] . " " . $arr_word[2] . " " . $arr_word[3] . " " . $arr_word[4] . " " . $arr_word[5] . " . . . ";
        return $wrap3words;
    } else {
      return $text;
    }
}