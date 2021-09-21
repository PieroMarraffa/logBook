<?php


class FImage extends FDataBase
{
    public static $class="FImage";

    public static $table="image";

    public static $value="(:IDimage,:IDtravel,:ImageFile,:Size,:Type)";

    public function __constructor(){}

    public static function bind($statement,EImage $image){
        $statement->bindValue(":IDimage",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDtravel",$image->getTravelID(), PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":ImageFile",base64_encode($image->getImageFile()), PDO::PARAM_STR);//NON SONO SICURO SIA PARAM_STRING
        $statement->bindValue(":Size",$image->getSize(), PDO::PARAM_INT); /** AGGIUNGERE UN CONTROLLO PER LA DIMENSIONE DELL'IMMAGINE LATO CONTROLL*/
        $statement->bindValue(":Type",$image->getType(), PDO::PARAM_INT);

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

    /** Controlla se nella tabella è già presente il luogo
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EImage $img){
        $database= FDataBase::getInstance();
        $id=$database->storeInDB(self::getClass(),$img);
        return $id;
    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existInDB(self::getTable(),"IDimage",$id);
        if($exist){
            $u=$database->updateInDB(self::getClass(),$field,$newValue,"IDimage",$id);
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $image=array();
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $image[] = new EImage( base64_decode($result['ImageFile']),$result['IDtravel'],$result['Width'],$result['Height']);
            $image[0]->setImageID($result['IDimage']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                for($i = 0; $i < count($result); $i++){
                    $image[]= new EImage( base64_decode($result[$i]['ImageFile']),$result[$i]['IDtravel'],$result[$i]['Width'],$result[$i]['Height']);
                    $image[$i]->setImageID($result[$i]['IDimage']);
                }
            }
        }
        return $image;
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