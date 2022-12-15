<?php

abstract class Record {

    protected $data;
    
    public function __construct($id = NULL){

        if($id){
            $object = $this->load($id);
            if($object){
                $this->fromArray($object->toArray());
            }
        }

    }

    public function __clone(){
        unset($this->data['id']);
    }

    public function __set($prop,$value){

        if(method_exists($this,'set_'.$prop)){
            // executa o metodo set_<propriedade>
            call_user_func(array($this,'set_'.$prop),$value);
        }else{
            if($value === NULL){
                unset($this->data[$prop]);
            }
            else {
                $this->data[strtolower($prop)] = $value; // atribui o valor da propriedade
            }
        }

    } 

    public function __get($prop){

        if(method_exists($this,'get_'.$prop)){
            // executa o metodo get_<propriedade>
            return call_user_func(array($this,'get_'.$prop));
        }else{
            if(isset($this->data[$prop])){
                return $this->data[$prop];
            }
        }

    }

    public function __isset($prop){
        return isset($this->data[$prop]);
    }

    private function getEntity(){
        $class = get_class($this); // obtem o nome da classe
        return constant("{$class}::TABLENAME"); // 
    }

    public function fromArray($data){
        $this->data = $data;
    }

    public function toArray(){
        return $this->data;
    }

    public function store(){

        $prepared = $this->prepare($this->data);

        // verifica se tem ID ou se existe na base de dados
        if(empty($this->data[$this->getCampoID()]) or (!$this->load($this->{$this->getCampoID()}))){
            // incrementa o ID
            if(empty($this->data[$this->getCampoID()])){
                $this->{$this->getCampoID()} = $this->getLast()+1;
                // $prepared[$this->getCampoID()] = $this->{$this->getCampoID()};
                $prepared[$this->getCampoID()] = $this->getLast()+1;

            }

            // cria uma instrução de insert
            $sql = "INSERT INTO {$this->getEntity()} " .
                   '('. implode(', ',array_keys($prepared)) . ' )'.
                   ' values ' .
                   '('. implode(', ',array_values($prepared)) . ' )';

        }else{
            // monta a string de UPDATE
            $sql = "UPDATE {$this->getEntity()} ";
            // monta os pares: coluna=valor,...
            if($prepared){
                foreach($prepared as $column => $value){
                    if($column !== $this->getCampoID()){
                        $set[] = "{$column} = {$value}";
                    }
                }
            }
            $sql .= ' SET '. implode(', ',$set);
            $sql .= " WHERE {$this->getCampoID()} = " . (int) $this->data[$this->getCampoID()];

        }

        // obtem a transacao ativa
        if($conn = Transacao::get()){
            Transacao::log($sql);
            $result = $conn->exec($sql);
            return $result;
        }else{
            throw new Exception('Não há transacao ativa!');
        }

    }

    public function load($id){
        // monta a instrucao SELECT
        $sql = "SELECT * FROM {$this->getEntity()}";
        $sql .= " WHERE {$this->getCampoID()} = ". (int) $id;

        // obtem transcao ativa
        if($conn = Transacao::get())
        {
            // cria mensagem de log e executa a consulta
            Transacao::log($sql);
            $result = $conn->query($sql);
            // se retornou algum dado
            if($result)
            {
                // retorna os dados em forma de objeto
                $object = $result->fetchObject(get_class($this));

            }
            return $object;
        }
        else
        {
            throw new Exception('Não há transação ativa!');
        }
    }

    public function delete($id = NULL){
        // o ID é o parametro ou a propriedade ID
        $id = $id ? $id : $this->{$this->getCampoID()};
        if(!$id){
            throw new Exception('ID não encontrado para ser deletado.');
        }

        // monta a string de UPDATE
        $sql = "DELETE FROM {$this->getEntity()}";
        $sql .= " WHERE {$this->getCampoID()} = ".(int)$this->data[$this->getCampoID()];

        // obtem a transacao ativa
        if($conn = Transacao::get())
        {
            // faz o log e executa o SQL
            Transacao::log($sql);
            $result = $conn->exec($sql);
            return $result;
        }
        else
        {
            throw new Exception('Não há transação ativa!');
        }

    }

    public static function find($id){
        $classname = get_called_class();
        $ar = new $classname;
        return $ar->load($id);
    }

    private function getLast(){
        if($conn = Transacao::get()){
            $sql = "SELECT max({$this->getCampoID()}) FROM {$this->getEntity()}";
            // cria log e executa a instrução SQL
            Transacao::log($sql);
            $result = $conn->query($sql);
            // retorna os dados do banco
            $row = $result->fetch();
            return $row[0];
        }
        else {
            throw new Exception('Não há transação ativa!!');
        }
    }

    public function prepare($data){
        $prepared = array();
        foreach($data as $key => $value){
            if(is_scalar($value)){
                $prepared[$key] = $this->escape($value);
            }
        }
        return $prepared;
    }

    public function getCampoID(){
        $class = get_class($this); // obtem o nome da classe
        return constant("{$class}::CAMPO_ID"); // 
    }

    public function escape($value){
        if(is_string($value) and (!empty($value))){
            // adiciona \ em aspas
            $value = addslashes($value);
            return "'$value'";
        }elseif(is_bool($value)){
            return $value ? 'TRUE':'FALSE';
        }elseif($value !== ''){
            return $value;
        }else{
            return "NULL";
        }
    }

}