<?php


class FComment
{
    public static $class="FComment";

    public static $table="comment";

    public static $value="(:IDcomment,:IDuser,:IDpost,:Deleted,:Content)";

    public function __constructor(){}

    public static function bind($statement,EComment $comment){
        $statement->bindValue(":IDcomment",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDuser",$comment->getAuthorID(), PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":IDpost",$comment->getIdPost(), PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":Deleted",$comment->getDeleted(), PDO::PARAM_BOOL);
        $statement->bindValue(":Content",$comment->getContent(), PDO::PARAM_STR);
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
    public static function getValues(){
        return self::$value;
    }

    /** Controlla se nella tabella è già presente il like
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EComment $comment){
        $database= FDataBase::getInstance();
        $id = $database->storeInDB(self::getClass(),$comment);
        return $id;
    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existInDB(self::getTable(),"IDcomment",$id);
        if($exist){
            $u=$database->updateInDB(self::getClass(),$field,$newValue,"IDcomment",$id);
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $comment=null;
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $author=FUser::load("IDuser",$result['IDuser']);
            $comment = new EComment($result['IDpost'],$author,$result['Deleted'],$result['Content']);
            $comment->setCommentID($result['IDcomment']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $comment = array();
                for($i = 0; $i < count($result); $i++){
                    $author=FUser::load("IDuser",$result[$i]['IDuser']);
                    $comment[] = new EComment($result[$i]['IDpost'],$author,$result[$i]['Deleted'],$result[$i]['Content']);
                    $comment[$i]->setCommentID($result[$i]['IDcomment']);
                }
            }
        }
        return $comment;

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

    /** il commento torna a essere visualizzato perchè il campo deleted è messo a false */
    public static function restoreComment($id){
        $database=FDataBase::getInstance();
        $database->updateInDB(self::getClass(),"Deleted",0,"IDComment",$id);
    }


    /** restituisce la persona che ha reportato il commento */
    public static function loadCommentReporter($idComment){
        $database=FDataBase::getInstance();
        $r=$database->loadCommentReporter($idComment);
        $result=array();
        if(isset($r['IDuser'])){ $result=FUser::load("IDuser",$r['IDuser']);}
        else{
            if($r!=null) {
                foreach ($r as $c) {
                    $result[] = FUser::load("IDuser", $c['IDuser']);
                }
            }
        }
        return $result;
    }

    /** visualizza tutti i commenti che possono essere visualizzati */
    public static function loadAllVisibleComment()
    {
        $result = self::load("Deleted", 0);
        //$rows_number = $database->interestedRows(static::getClass(), "Deleted", "0");
        return $result;
    }

    /** visualizza tutti i post che non possono essere visualizzati */
    public static function loadReportedComments()
    {
        $database=FDataBase::getInstance();
        $r=$database->loadAllCommentReported();
        $result=array();
        if(isset($r['IDcomment'])){ $result[]=self::load("IDcomment",$r['IDcomment']);}
        else{
            if($r!=null) {
                foreach ($r as $c) {
                    $result[] = self::load("IDcomment", $c['IDcomment']);
                }
            }
        }
        return $result;
    }

    public static function deleteFromCommentReported($idComment){
        $database=FDataBase::getInstance();
        $database->deleteFromCommentReportedByUser($idComment);
    }

}