<?php


class FImage extends FDataBase
{
    public static $class="FImage";

    public static $table="image";

    public static $value="(:IDimage,:IDexperience,:ImageFile,:Width,:Height)";

    public function __constructor(){}

    public static function bind($statement,EImage $image){
        $statement->bindValue(":IDimage",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDexperience",$image->g, PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":ImageFile",$image->ImageFile(), PDO::PARAM_STR);//NON SONO SICURO SIA PARAM_STRING
        $statement->bindValue(":Width",$image->getWidth(), PDO::PARAM_INT); /** AGGIUNGERE UN CONTROLLO PER LA DIMENSIONE DELL'IMMAGINE LATO CONTROLL*/
        $statement->bindValue(":Height",$image->getHeight(), PDO::PARAM_INT);

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

    /** Controlla se nella tabella è già presente il luogo
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EImage $img){
        $database= FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDimage",$img->getImageID());
        if(!$exist){
            $id=$database->storeInDB(self::getTable(),$img);
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
        $exist= $database->existDB(self::getTable(),"IDimage",$id->getID());
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


    /** Elimina l'elemento in cui l'id corrisponde a quello
     * inserito nel campo corrispondente al campo field
     */
    public static function delete($field,$id){
        $database=FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(),$field,$id);
    }
}