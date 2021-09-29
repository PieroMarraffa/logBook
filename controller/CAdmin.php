<?php


class CAdmin
{


    static function isAdminLogged(){
        $identificato = false;
        if(USession::getIsSet('admin')){
                $identificato = true;
        }
        return $identificato;
    }

    /**
     * @throws SmartyException
     */
    static function adminHome(){
        $pm=new FPersistentManager();
        $view=new VAdmin();
        $image_reported=array();
        $image_banned=array();
        $array_banned=$pm->load("Banned",true,FUser::getClass());
        if(is_object($array_banned)){
            $array_b=array();
            $array_b[]=$array_banned;
        }else{
            $array_b=$array_banned;
        }
        $array_reported=$pm->load("Reported",true,FUser::getClass());
        if(is_object($array_reported)){
            $array_r=array();
            $array_r[]=$array_reported;
        }else{
            $array_r=$array_reported;
        }
        foreach ($array_r as $a){
            $id=$a->getImageID();
            $img=$pm->load("IDimage",$id,FImage::getClass());
            $image_reported[]=$img;
        }
        if(isset($array_b[0])){
        foreach ($array_b as $a){
            $id=$a->getImageID();
            $img=$pm->load("IDimage",$id,FImage::getClass());
            $image_banned[]=$img;
        }}else $array_b=array();
        $view->adminHomePage($array_b,$array_r,$image_reported,$image_banned);
    }

    static function adminLogout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /logBook/User/login');
    }


    /**
     * @throws SmartyException
     */
    static function banUser($userID){
        $pm=new FPersistentManager();
        $pm->update("Reported",0,$userID,FUser::getClass());
        $pm->update("Banned",1,$userID,FUser::getClass());
        header('Location: /logBook/Admin/adminHome');
    }

    /**
     * @throws SmartyException
     */
    static function ignoreUser($userID){
        $pm=new FPersistentManager();
        $pm->update("Reported",0,$userID,FUser::getClass());
        header('Location: /logBook/Admin/adminHome');
    }

    static function restoreUser($userID){
        $pm=new FPersistentManager();
        $pm->update("Banned",0,$userID,FUser::getClass());
        header('Location: /logBook/Admin/adminHome');
    }




}