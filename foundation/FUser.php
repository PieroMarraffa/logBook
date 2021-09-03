<?php


class FUser extends FDataBase
{
    public static $class="FUser";

    public static $table="user";

    public static $value="(:IDuser,:Email,:Password,:Name,:Admin,:Description,:Image,:UserName)";

    public function __constructor(){}

    public static function bind($statement,EUser $user){
        $statement->bindValue(":IDuser",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Email",$user->getMail(), PDO::PARAM_STR);
        $statement->bindValue(":Password",$user->getPassword(), PDO::PARAM_STR);
        $statement->bindValue(":Name",$user->getName(), PDO::PARAM_STR);
        $statement->bindValue(":Admin",$user->getAdmin(), PDO::PARAM_BOOL);
        $statement->bindValue(":Description",$user->getDescription(),PDO::PARAM_STR);
        $statement->bindValue(":Image",$user->getImgPathFile(),PDO::PARAM_STR);
        $statement->bindValue("UserName",$user->getUserName(),PDO::PARAM_STR);
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


    /** Controlla se nella tabella è già presente l'utente
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EUser $u){
        $database= FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDuser",$u->getUserID());
        if(!$exist){
            $id=$database->storeInDB(self::getTable(),$u);
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
        $exist= $database->existDB(self::getTable(),"IDuser",$id->getId());
        if($exist){
            $u=$database->updateInDB(self::getTable(),$field,$newValue,"IDuser",$id->getId());
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        return $result;
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


    /** Elimina l'elemento in cui l'id corrisponde a quello inserito */
    public static function delete($field,$id){
        $database=FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(),$field,$id);
    }


    /** Ritorna tutti gli elementi della tabella il cui attributo admin è messo a true */
    public static function loadAdmin(){
        $database=FDataBase::getInstance();
        $result=$database->loadById(self::getTable(),"Admin",true);
        return $result;
    }
}