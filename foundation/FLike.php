<?php


class FLike extends FDataBase
{
    public static $class="FLike";

    public static $table="reaction";

    public static $value="(:IDreaction,:IDpost,:IDuser,:Reaction)";

    public function __constructor(){}

    public static function bind($statement,ELike $like){
        $statement->bindValue(":IDreaction",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDpost",$like->getPostID(), PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":IDuser",$like->getUserID(), PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":Reaction",$like->getValue(), PDO::PARAM_STR);
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
    public static function getValues()
    {
        return self::$value;
    }

    /** Controlla se nella tabella è già presente il like
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(ELike $like){
        $database= FDataBase::getInstance();
        $a=$database->storeInDB(self::getClass(),$like);
        return $a;

    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existInDB(self::getTable(),"IDreaction",$id);
        if($exist){
            $u=$database->updateInDB(self::getClass(),$field,$newValue,"IDreaction",$id);
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $like=null;
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $like = new ELike($result['Reaction'],$result['IDuser'],$result['IDpost']);
            $like->setLikeID($result['IDreaction']);

        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $like = array();
                for($i = 0; $i < count($result); $i++){
                    $like[] = new ELike($result[$i]['Reaction'],$result['IDuser'],$result[$i]['IDpost']);
                    $like[$i]->setLikeID($result[$i]['IDreaction']);
                }
            }
        }
        return $like;
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
            $like = new ELike($result['Reaction'],$result['IDuser'],$result['IDpost']);
            $like->setLikeID($result['IDreaction']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $like = array();
                for($i = 0; $i < count($result); $i++){
                    $like[] = new ELike($result[$i]['Reaction'],$result['IDuser'],$result[$i]['IDpost']);
                    $like[$i]->setLikeID($result[$i]['IDreaction']);
                }
            }
        }
        return $like;
    }
}