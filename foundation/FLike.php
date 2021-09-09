<?php


class FLike
{
    public static $class="FLike";

    public static $table="like";

    public static $value="(:IDlike,:IDpost,:IDuser,:Value)";

    public function __constructor(){}

    public static function bind($statement,ELike $like){
        $statement->bindValue(":IDlike",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDpost",$like->g, PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":IDuser",$like->g, PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":Value",$like->getValue(), PDO::PARAM_STR);
    }

    /**
     * @return string
     */
    public static function getClass()
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getTable()
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getValue()
    {
        return self::$value;
    }

    /** Controlla se nella tabella è già presente il like
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(ELike $like){
        $database= FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDlike",$like->getLikeID());
        if(!$exist){
            $id=$database->storeInDB(self::getTable(),$like);
            return $id;
        }
        return null;
    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDlike",$id->getID());
        if($exist){
            $u=$database->updateInDB(self::getTable(),$field,$newValue,"IDimage",$id->getId());
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $author=FUser::load("IDuser",$result['IDuser']);
            $like = new ELike($result['Value'],$author,$result['IDlike'],$result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $like = array();
                for($i = 0; $i < count($result); $i++){
                    $author=FUser::load("IDuser",$result[$i]['IDuser']);
                    $like[] = new ELike($result[$i]['Value'],$author,$result[$i]['IDlike'],$result[$i]['IDpost']);
                }
            }
        }
        return like;
    }


    /** Se il valore passato in ingresso è maggiore di 0 rstituisce true
     *altrimenti restituisce false
     */
    public static function exist($field,$id){
        $database=FDataBase::getInstance();
        $e=$database->existInDB(self::getTable(),$field,$id);
        if($e>0){
            return true;
        }
        else{return false;}
    }


    /** Elimina l'elemento in cui l'id corrisponde a quello
     * inserito nel campo corrispondente al campo field
     */
    public static function delete($field,$id){
        $database=FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(),$field,$id);
    }

    public static function loadAll(){
        $database = FDataBase::getInstance();
        $result=$database->getAllByTable(self::getTable());
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $author=FUser::load("IDuser",$result['IDuser']);
            $like = new ELike($result['Value'],$author,$result['IDlike'],$result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $like = array();
                for($i = 0; $i < count($result); $i++){
                    $author=FUser::load("IDuser",$result[$i]['IDuser']);
                    $like[] = new ELike($result[$i]['Value'],$author,$result[$i]['IDlike'],$result[$i]['IDpost']);
                }
            }
        }
        return like;
    }
}