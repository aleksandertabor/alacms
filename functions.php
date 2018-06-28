<?php
function write_log ( $log )  {
    $before = ' Projekt Log - ';
    $date = date('Y-m-d H:i:s');
    $ip = ' - '.$_SERVER['REMOTE_ADDR'].' - ';

    if (is_array($log)) {
      file_put_contents('logi.log', print_r($log,true), FILE_APPEND);
    } else {
      $content = $date.$ip.$log."\r\n";
      file_put_contents('logi.log', $content, FILE_APPEND);
    }

}

function read_logs ()  {
      if (file_get_contents('logi.log')) {
        echo nl2br(file_get_contents('logi.log'));
      } 
}