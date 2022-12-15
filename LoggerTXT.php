<?php

class LoggerTXT extends Logger {
    public function write($message){
        // print date_default_timezone_get();
        // print "<br/>";
        date_default_timezone_set('America/Sao_Paulo');
        // print date_default_timezone_get();
        // $filename e passado no construct da class Logger
        $text = date('Y-m-d H:i:s') . ' - ' . $message;
        $handler = fopen($this->filename,'a');
        fwrite($handler,$text);
        fclose($handler);
    }
}