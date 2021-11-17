<?php


class FUser extends FDataBase
{
    public static $class="FUser";

    public static $table="user";

    public static $value="(:IDuser,:Email,:Password,:Name,:Description,:IDimage,:UserName,:Reported,:Banned)";

    public function __constructor(){}

    public static function bind($statement,EUser $user){
        $statement->bindValue(":IDuser",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Email",$user->getMail(), PDO::PARAM_STR);
        $statement->bindValue(":Password",$user->getPassword(), PDO::PARAM_STR);
        $statement->bindValue(":Name",$user->getName(), PDO::PARAM_STR);
        $statement->bindValue(":Description",$user->getDescription(),PDO::PARAM_STR);
        $statement->bindValue(":IDimage",$user->getImageID(),PDO::PARAM_INT);
        $statement->bindValue("UserName",$user->getUserName(),PDO::PARAM_STR);
        $statement->bindValue(":Reported",$user->getReported(),PDO::PARAM_BOOL);
        $statement->bindValue(":Banned",$user->isBanned(),PDO::PARAM_BOOL);
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


    /** Controlla se nella tabella è già presente l'utente
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EUser $u){
        $database= FDataBase::getInstance();
        $exist= $database->existInDB(self::getTable(),"Email",$u->getMail());
        if(!$exist){
            $database->storeInDB(self::getClass(),$u);
            return true;
        }
        return null;
    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existInDB(self::getTable(),"IDuser",$id);
        if($exist){
            $u=$database->updateInDB(self::getClass(),$field,$newValue,"IDuser",$id);
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $user=null;
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $user = new EUser($result['Email'],$result['Password'],$result['Name'],$result['Description'],$result['Image'],$result['UserName'],$result['Reported'], $result['Banned']);
            $user->setUserID($result['IDuser']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $user = array();
                for($i = 0; $i < count($result); $i++){
                    $user[] = new EUser($result[$i]['Email'],$result[$i]['Password'],$result[$i]['Name'],$result[$i]['Description'],$result[$i]['Image'], $result[$i]['UserName'],$result[$i]['Reported'],$result[$i]['Banned']);
                    $user[$i]->setUserID($result[$i]['IDuser']);
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
        return true;
    }



    /** Restituisce tutti i valori di place associati a quell'utente   //Ricordati di aggiungere quando un post viene creato la relazione tra user e place
    public static function loadPlaceByUser($idUser){
        $place=array();
        $database = FDataBase::getInstance();
        $result = $database->loadPlaceToUser($idUser);
        $rows_number = $database->interestedRowsInTable("place_to_user","IDuser",$idUser);
        if(($result != null) && ($rows_number == 1)) {
            $place[] = new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Category']);
            $place[0]->setPlaceID($result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Name'],$result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Category']);
                    $place[$i]->setPlaceID($result[$i]['IDplace']);
                }
            }
        }
        return $place;
    }*/



    /** Inserisce nella tabella place_to_user l'associazione tra l'utente associata a idUser e
     *il posto associato a $idPlace
     */

    public static function loadCommentReportedFromUser($idUser){
        $database=FDataBase::getInstance();
        $result=$database->loadCommentReportedbyUser($idUser);
        $rows_number = $database->interestedRowsInTable("comment_reported_by_user","IDuser",$idUser);
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

    /**
     * @throws Exception
     */
    public static function loadPostReportedFromUser($idUser){
        $post=null;
        $database=FDataBase::getInstance();
        $result=$database->loadPostReportedbyUser($idUser);
        $rows_number = $database->interestedRowsInTable("post_reported_by_user","IDuser",$idUser);
        if(($result != null) && ($rows_number == 1)) {
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $travel=FTravel::load("IDpost",$result['IDpost']);
            $Like=Flike::load("IDpost",$result['IDpost']);
            $nLike=0;
            $nDislike=0;
            if($Like!=null){
            foreach ($Like as $l){
                if($l->getValue()==1){
                    $nLike ++;
                }elseif ($l->getValue()==-1){
                    $nDislike++;
                }
            }}
            $post = new EPost($commentList,$likeList,$result['Date'],$travel,$result['Deleted'],$nLike,$nDislike,$result['IDuser']);
            $post->setPostID($result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $travel=FTravel::load("IDpost",$result[$i]['IDpost']);
                    $Like=Flike::load("IDpost",$result[$i]['IDpost']);
                    $nLike=0;
                    $nDislike=0;
                    foreach ($Like as $l){
                        if($l->getValue()==1){
                            $nLike ++;
                        }elseif ($l->getValue()==-1){
                            $nDislike++;
                        }
                    }
                    $post[] = new EPost($commentList,$likeList,$result[$i]['Date'],$travel,$result[$i]['Deleted'],$nLike,$nDislike,$result[$i]['IDuser'],);
                    $post[$i]->setPostID($result[$i]['IDpost']);

                }
            }
        }
        return $post;
    }

    public static function storeCommentReporter($idUser,$idComment){
        $database=FDataBase::getInstance();
        $database->storeCommentReportedByUser($idComment,$idUser);

    }

    public static function storePostReporter($idUser,$idPost){
        $database=FDataBase::getInstance();
        $result=$database->storePostReportedByUser($idPost,$idUser);
        return $result;
    }

    public static function updatePostReporter($idUser,$idPost){
        $database=FDataBase::getInstance();
        $result=$database->updatePostReportedByUser($idPost,$idUser,1);
        return $result;
    }

    public static function updateCommentReporter($idUser,$idComment){
        $database=FDataBase::getInstance();
        $result=$database->updatePostReportedByUser($idComment,$idUser,1);
        return $result;
    }


    public static function loadLogin($email){
        $database=FDatabase::getInstance();
        $class=FUser::getTable();
        $result=$database->VerifiedAccess($class,$email);
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

    public static function loadBannedUsers(){
        $result = self::load("Banned", "true");
        return $result;
    }

    public static function newUserToDB( $email, $password, $name, $description, $idImage, $username,$reported, $banned){
        $user = new EUser( $email, $password, $name, $description, $idImage, $username,$reported, $banned);
        self::store($user);
    }

    /** FAI IL METODO PER LA RICERCA DEGLI UTENTI IN BASE ALLA STRINGA INSERITA */

    static function existAssociationUserPlace($idUser, $idPlace){
        $result = self::loadPlaceByUser($idUser);
        if ($result == null) {return false;}
        elseif (count($result) == 1){
            if ($result[0]->getPlaceID() == $idPlace){
                return true;
            }
            else{
                return false;
            }
        }
        elseif (count($result) > 1){
            foreach ($result as $res){
                if ($res->getPlaceID() == $idPlace){
                    return true;
                }
            }
            return false;
        }
        return false;
    }
}