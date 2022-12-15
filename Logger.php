<?php

abstract class Logger {

    protected $filename;

    public function __construct($filename){
        $this->filename = $filename;
        // Limpa o arquivo de texto
        // file_put_contents($filename,'');
    }

    abstract function write($message);

}