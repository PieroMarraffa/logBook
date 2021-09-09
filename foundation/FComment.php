<?php


class FComment
{
    public static $class="FComment";

    public static $table="comment";

    public static $value="(:IDcoment,:IDuser,:IDpost,:Deleted,:Content)";

    public function __constructor(){}

    public static function bind($statement,EComment $comment){
        $statement->bindValue(":IDcomment",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDuser",$comment->g, PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":IDpost",$comment->g, PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":Deleted",$comment->getEliminated(), PDO::PARAM_BOOL);
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
    public static function getValue()
    {
        return self::$value;
    }

    /** Controlla se nella tabella è già presente il like
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EComment $comment){
        $database= FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDcomment",$comment->getCommentID());
        if(!$exist){
            $id=$database->storeInDB(self::getTable(),$comment);
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
        $exist= $database->existDB(self::getTable(),"IDcomment",$id->getID());
        if($exist){
            $u=$database->updateInDB(self::getTable(),$field,$newValue,"IDcomment",$id->getId());
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $author=FUser::load("IDuser",$result['IDuser']);
            $reportedList=self::loadCommentReporter($result['IDcomment']);
            $comment = new EComment($result['IDcomment'],$result['IDpost'],$author,$result['Deleted'],$reportedList,$result['Content']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $experience = array();
                for($i = 0; $i < count($result); $i++){
                    $author=FUser::load("IDuser",$result[$i]['IDuser']);
                    $reportedList=self::loadCommentReporter($result[$i]['IDcomment']);
                    $comment[] = new EComment($result[$i]['IDcomment'],$result[$i]['IDpost'],$author,$result[$i]['Deleted'],$reportedList,$result[$i]['Content']);

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
    /** il commento non viene più visualizzato perchè il campo deleted è posto a true */
    public static function deleteComment($id){
        $database=FDataBase::getInstance();
        $database->updateInDB(self::getTable(),"Deleted",true,"IDComment",$id);
    }

    /** il commento torna a essere visualizzato perchè il campo deleted è messo a false */
    public static function restoreComment($id){
        $database=FDataBase::getInstance();
        $database->updateInDB(self::getTable(),"Deleted",false,"IDComment",$id);
    }


    /** restituisce la persona che ha reportato il commento */
    public static function loadCommentReporter($idComment){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityReportedByEntity(self::getTable(),$idComment,"user");
        $reporter= new EUser($result['IDuser'],$result['UserName'],$result['Name'],$result['Password'],$result['Email'],$result['Image'],$result['Description']);
        return $reporter;
    }

    /** visualizza tutti i commenti che possono essere visualizzati */
    public static function loadAllVisibleComment()
    {
        $result = self::load("Deleted", "false");
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $author=FUser::load("IDuser",$result['IDuser']);
            $reportedList=self::loadCommentReporter($result['IDcomment']);
            $comment = new EComment($result['IDcomment'],$result['IDpost'],$author,$result['Deleted'],$reportedList,$result['Content']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $experience = array();
                for($i = 0; $i < count($result); $i++){
                    $author=FUser::load("IDuser",$result[$i]['IDuser']);
                    $reportedList=self::loadCommentReporter($result[$i]['IDcomment']);
                    $comment[] = new EComment($result[$i]['IDcomment'],$result[$i]['IDpost'],$author,$result[$i]['Deleted'],$reportedList,$result[$i]['Content']);

                }
            }
        }
        return $comment;
    }

    /** visualizza tutti i post che non possono essere visualizzati */
    public static function loadAllDeletedComment()
    {
        $result = self::load("Deleted", "true");
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $author=FUser::load("IDuser",$result['IDuser']);
            $reportedList=self::loadCommentReporter($result['IDcomment']);
            $comment = new EComment($result['IDcomment'],$result['IDpost'],$author,$result['Deleted'],$reportedList,$result['Content']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $experience = array();
                for($i = 0; $i < count($result); $i++){
                    $author=FUser::load("IDuser",$result[$i]['IDuser']);
                    $reportedList=self::loadCommentReporter($result[$i]['IDcomment']);
                    $comment[] = new EComment($result[$i]['IDcomment'],$result[$i]['IDpost'],$author,$result[$i]['Deleted'],$reportedList,$result[$i]['Content']);

                }
            }
        }
        return $comment;
    }

}