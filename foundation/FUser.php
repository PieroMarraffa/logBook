<?php


class FUser extends FDataBase
{
    public static $class="FUser";

    public static $table="user";

    public static $value="(:IDuser,:Email,:Password,:Name,:Description,:Image,:UserName)";

    public function __constructor(){}

    public static function bind($statement,EUser $user){
        $statement->bindValue(":IDuser",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Email",$user->getMail(), PDO::PARAM_STR);
        $statement->bindValue(":Password",$user->getPassword(), PDO::PARAM_STR);
        $statement->bindValue(":Name",$user->getName(), PDO::PARAM_STR);
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
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $user = new EUser($result['IDuser'],$result['UserName'],$result['Name'],$result['Password'],$result['Email'],$result['Image'],$result['Description']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $user = array();
                for($i = 0; $i < count($result); $i++){
                    $user[] = new EUser($result['IDuser'],$result['UserName'],$result['Name'],$result['Password'],$result['Email'],$result['Image'],$result['Description']);
                }
            }
        }
        return $user;
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



    /** Restituisce tutti i valori di place associati a quell'utente */   //Ricordati di aggiungere quando un post viene creato la relazione tra user e place
    public static function loadPlaceByUser($idUser){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityToEntity(self::getTable(),$idUser,"place");
        $place= new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Nation'],$result['AverageVisitors'],$result['Category'],$result['IDplace']);
        return $place;
    }

    /** Inserisce nella tabella place_to_user l'associazione tra l'utente associata a idUser e
     *il posto associato a $idPlace
     */
    public static function storePlaceToUser($idUser,$idPLace){
        $database=FDataBase::getInstance();
        $result =$database->storeEntityToEntity("place",$idPLace,self::getTable(),$idUser);
        return $result;
    }

    public static function loadCommentReportedByUser($idUser){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityReportedByEntity(self::getTable(),$idUser,"comment");
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $author=FUser::load("IDuser",$result['IDuser']);
            $reportedList=self::loadCommentReporter($result['IDcomment']);
            $comment = new EComment($result['IDcomment'],$result['IDpost'],$author,$result['Deleted'],$reportedList,$result['Content']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $comment = array();
                for($i = 0; $i < count($result); $i++){
                    $author=FUser::load("IDuser",$result[$i]['IDuser']);
                    $reportedList=self::loadCommentReporter($result[$i]['IDcomment']);
                    $comment[] = new EComment($result[$i]['IDcomment'],$result[$i]['IDpost'],$author,$result[$i]['Deleted'],$reportedList,$result[$i]['Content']);

                }
            }
        }
        return $comment;

    }

    public static function loadPostReportedByUser($idUser){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityReportedByEntity(self::getTable(),$idUser,"post");
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $travel=FTravel::load("IDpost",$result['IDpost']);
            $post = new EPost($result['Author'], $result['Title'],$commentList,$likeList,$result['Date'],$travel,$result['IDpost'],$result['Deleted']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $travel=FTravel::load("IDpost",$result[$i]['IDpost']);
                    $post[] = new EPost($result[$i]['Author'], $result[$i]['Title'],$commentList,$likeList,$result[$i]['Date'],$travel,$result[$i]['IDpost'],$result[$i]['Deleted']);
                }
            }
        }
        return $post;
    }

    public static function storeCommentReporter($idUser,$idComment){
        $database=FDataBase::getInstance();
        $result=$database->storeEntityReportedByEntity("comment",$idComment,self::getTable(),$idUser);
        return $result;
    }

    public static function storePostReporter($idUser,$idPost){
        $database=FDataBase::getInstance();
        $result=$database->storeEntityReportedByEntity("post",$idPost,self::getTable(),$idUser);
        return $result;
    }


    public static function loadLogin($email,$password){
        $database=FDatabase::getInstance();
        $result=$database->VerifiedAccess($email, $password);
        if(isset($result)){
            return true;
        }else{
            return false;
        }
    }

    public static function checkCredentials($email, $password){
        $database = FDataBase::getInstance();
        $result = $database->verifiedAccess(FUser::$table,$email,$password);
        if ($result != null){
            return false;
        } else{
            return true;
        }
    }

    public static function checkExistingUser($email){
        $database = FDataBase::getInstance();
        $result = $database->loadById(FUser::$table, 'Email', $email);
        if ($result != null){
            return false;
        } else return true;
    }

    /** FAI IL METODO DI RIPRISTINO DEI COMMENTI E DEI POST  */
    /** FAI IL METODO PER LA RICERCA DEGLI UTENTI IN BASE ALLA STRINGA INSERITA */
}