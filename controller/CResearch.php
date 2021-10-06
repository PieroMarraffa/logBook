<?php


class CResearch
{

    /**
     * @throws SmartyException
     * @throws Exception
     */
    static function find(){
        $view=new VResearch();
        $pm=new FPersistentManager();
        $post1=array();
        if($_POST['search']==1){
            if($_POST['research']!=""){
                $array_user=$pm->load("Username",$_POST['research'],FUser::getClass());
                if(!is_array($array_user)){
                    $array_u=array();
                    $array_u[]=$array_user;
                }else $array_u=$array_user;
                foreach ($array_u as $a){
                $post=$pm->load("IDuser",$a->getUserID(),FPost::getClass());
                if(is_object($post)){
                    $array_p=array();
                    $array_p[]=$post;
                }else $array_p=$post;
                $post1[]=$array_p;}
                $view->search_user($array_user,$post1);
            }else header("Location: /logBook/User/home");
        }
        elseif($_POST['search']==2){
            if($_POST['research']!=""){
                $place=$pm->load("Name",$_POST['research'],FPlace::getClass());
                $post=$pm->loadPostByPlace($place->getPlaceID());
                $view->search_place($place,$post);
            }else header("Location: /logBook/User/home");
        }
    }

}