<?php

require 'FPlace.php';
require 'FComment.php';
require 'entity/EComment.php';
require 'FLike.php';
require 'FTravel.php';
require 'FImage.php';
require 'FExperience.php';
require 'entity/EPlace.php';
require 'entity/EExperience.php';






class FUser extends FDataBase
{
    public static $class="FUser";

    public static $table="user";

    public static $value="(:IDuser,:Email,:Password,:Name,:Description,:Image,:UserName,:Banned)";

    public function __constructor(){}

    public static function bind($statement,EUser $user){
        $statement->bindValue(":IDuser",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Email",$user->getMail(), PDO::PARAM_STR);
        $statement->bindValue(":Password",$user->getPassword(), PDO::PARAM_STR);
        $statement->bindValue(":Name",$user->getName(), PDO::PARAM_STR);
        $statement->bindValue(":Description",$user->getDescription(),PDO::PARAM_STR);
        $statement->bindValue(":Image",$user->getImgPathFile(),PDO::PARAM_STR);
        $statement->bindValue("UserName",$user->getUserName(),PDO::PARAM_STR);
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
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $user = new EUser($result['UserName'],$result['Email'],$result['Password'],$result['Name'],$result['Description'],$result['Image'], $result['Banned']);
            $user->setUserID($result['IDuser']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $user = array();
                for($i = 0; $i < count($result); $i++){
                    $user[] = new EUser($result[$i]['UserName'],$result[$i]['Email'],$result[$i]['Password'],$result[$i]['Name'],$result[$i]['Description'],$result[$i]['Image'], $result[$i]['Banned']);
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



    /** Restituisce tutti i valori di place associati a quell'utente */   //Ricordati di aggiungere quando un post viene creato la relazione tra user e place
    public static function loadPlaceByUser($idUser){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityToEntity(self::getTable(),$idUser,"place");
        $place= new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Category']);
        $place->setPlaceID($result['IDplace']);
        return $place;
    }

    /** Inserisce nella tabella place_to_user l'associazione tra l'utente associata a idUser e
     *il posto associato a $idPlace
     */
    public static function storePlaceToUser($idUser,$idPLace){
        $database=FDataBase::getInstance();
        echo FPlace::getTable();
        $result =$database->storeEntityToEntity("place",$idPLace,self::getTable(),$idUser);
        return $result;
    }

    public static function loadCommentReportedByUser($idUser){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityReportedByEntity(self::getTable(),$idUser,FComment::getTable());
        $rows_number = sizeof($result);
        if(($result != null) && ($rows_number == 1)) {
            $author=FUser::load("IDuser",$result[0]['IDuser']);
            $reportedList=FComment::loadCommentReporter($result[0]['IDcomment']);
            $comment = new EComment($result[0]['IDpost'],$author,$result[0]['Deleted'],$reportedList,$result[0]['Content']);
            $comment->setCommentID($result[0]['IDcomment']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $comment = array();
                for($i = 0; $i < sizeof($result); $i++){
                    $author=FUser::load("IDuser",$result[$i]['IDuser']);
                    $reportedList=FComment::loadCommentReporter($result[$i]['IDcomment']);
                    $comment[] = new EComment($result[$i]['IDpost'],$author,$result[$i]['Deleted'],$reportedList,$result[$i]['Content']);
                    $comment[$i]->setCommentID($result[$i]['IDcomment']);
                }
            }
        }
        return $comment;
    }

    /**
     * @throws Exception
     */
    public static function loadPostReportedByUser($idUser){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityReportedByEntity(self::getTable(),$idUser,"post");
        $rows_number = sizeof($result);
        if(($result != null) && ($rows_number == 1)) {
            $commentList=FComment::load("IDpost",$result[0]['IDpost']);
            $likeList=FLike::load("IDpost",$result[0]['IDpost']);
            $travel=FTravel::load("IDpost",$result[0]['IDpost']);
            $nLike=0;
            $nDislike=0;
            foreach ($likeList as $l){
                if($l->getValue()==1){
                    $nLike ++;
                }elseif ($l->getValue()==-1){
                    $nDislike++;
                }
            }
            $post = new EPost( $result[0]['Title'],$commentList,$likeList,$result[0]['Date'],$travel,$result[0]['Deleted'],$nLike,$nDislike,$result[0]['IDuser']);
            $post->setPostID($result[0]['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $travel=FTravel::load("IDpost",$result[$i]['IDpost']);
                    $nLike=0;
                    $nDislike=0;
                    foreach ($likeList as $l){
                        if($l->getValue()==1){
                            $nLike ++;
                        }elseif ($l->getValue()==-1){
                            $nDislike++;
                        }
                    }
                    $post[] = new EPost($result[$i]['Author'], $result[$i]['Title'],$commentList,$likeList,$result[$i]['Date'],$travel,$result[$i]['Deleted'],$nLike,$nDislike);
                    $post[$i]->setPostID($result[$i]['IDpost']);

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
        $class=FUser::getTable();
        $result=$database->VerifiedAccess($class,$email, $password);
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

    public static function loadReportedUsers(){
        $result = self::load("Banned", "true");
        return $result;
    }

    public static function newUserToDB( $email, $password, $name, $description, $image, $username, $banned){
        $user = new EUser( $email, $password, $name, $description, $image, $username, $banned);
        self::store($user);
    }

    /** FAI IL METODO DI RIPRISTINO DEI COMMENTI E DEI POST  */
    /** FAI IL METODO PER LA RICERCA DEGLI UTENTI IN BASE ALLA STRINGA INSERITA */
}