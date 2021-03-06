<?php


class FImage extends FDataBase
{
    public static $class="FImage";

    public static $table="image";

    public static $value="(:IDimage,:IDpost,:ImageFile,:Size,:Type)";

    public function __constructor(){}

    public static function bind($statement,EImage $image,$nome_file){

        $path = $_FILES[$nome_file]['tmp_name'];
        $file=fopen($path,'rb') or die ("Attenzione! Impossibile da aprire!");
        $statement->bindValue(":IDimage",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDpost",$image->getPostID(), PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":ImageFile",fread($file,filesize($path)), PDO::PARAM_LOB);
        $statement->bindValue(":Size",$image->getSize(), PDO::PARAM_INT); /** AGGIUNGERE UN CONTROLLO PER LA DIMENSIONE DELL'IMMAGINE LATO CONTROLL*/
        $statement->bindValue(":Type",$image->getType(), PDO::PARAM_STR);
        unset($file);
        unlink($path);
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
    public static function store(EImage $img, $nome_file){
        $database= FDataBase::getInstance();
        $id=$database->storeMediaInDB(self::getClass(),$img,$nome_file);
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
            $image[] = new EImage( $result['ImageFile'],$result['IDpost'],$result['Size'],$result['Type']);
            $image[0]->setImageID($result['IDimage']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                for($i = 0; $i < count($result); $i++){
                    $image[]= new EImage( base64_encode($result[$i]['ImageFile']),$result[$i]['IDpost'],$result[$i]['Size'],$result[$i]['Type']);
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