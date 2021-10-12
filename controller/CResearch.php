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
        $research=$_POST['research'];
        if($_POST['search']==1){
            $post1=array();
            if($_POST['research']!=""){
                $result=$pm->load("Username",$_POST['research'],FUser::getClass());
                $array_user=array();
                if($result!=null) {
                    $array_u=array();
                    if(!is_array($result)){
                        $array_u[]=$result;
                    }else $array_u=$result;
                    foreach ($array_u as $r) {
                        if ($r->isBanned() != true) {
                            $array_user[]=$r;
                        }
                    }
                }
                if($array_user!=null) {
                    foreach ($array_user as $a) {
                        $post = $pm->load("IDuser", $a->getUserID(), FPost::getClass());
                        $array_post = array();
                        if($post!=null){
                        if (is_object($post)) {
                            $array_p = array();
                            $array_p[] = $post;
                        } else $array_p = $post;
                        foreach ($array_p as $p) {
                            if ($p != null) {
                                if ($p->getDeleted() != true) {
                                    $array_post[] = $p;
                                }
                            }
                        }}
                        $post1[]=$array_post;
                    }

                    $view->search_user($array_user,$post1);
                }

                else{
                    $view->search_error($research);
                }

            }else header("Location: /logBook/User/home");
        }
        elseif($_POST['search']==2){
            if($_POST['research']!=""){
                $place=$pm->load("Name",$_POST['research'],FPlace::getClass());
                if($place!=null){
                $post=$pm->loadPostByPlace($place->getPlaceID());
                    $array_posts=array();
                    if($post!=null){
                        if (is_object($post)) {
                            $array_p = array();
                            $array_p[] = $post;
                        } else $array_p = $post;
                        foreach ($array_p as $p){
                            if($p!=null){
                                if($p->getDeleted()!=true){
                                    $array_posts[]=$p;
                                }
                            }
                        }
                    }
                $view->search_place($place,$array_posts);
                    }
                else{
                    $view->search_error($research);
                }
            }else header("Location: /logBook/User/home");
        }
    }

}