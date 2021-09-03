<?php


class FPersistentMenager
{

    public static function store($object){
        $Eclass=get_class($object);
        $Fclass=$Eclass;
        $Fclass[0]="F";
        $Fclass::store($object);
    }

    public static function delete($field,$val,$Fclass){
        $Fclass::delete($field,$val);
        if ($Fclass == "FExperience" || $Fclass == "FPlace" )//AGGIUNGI LE FOUNDATION MAN MANO
            $Fclass::delete($field,$val);                   // CHE LE FANNO SE IMPLEMENTANO IL METODO UPDATE
        else
            print ("METODO NON SUPPORTATO DALLA CLASSE");
    }


    public static function exist($field,$val,$Fclass){
        $result=null;
        $result=$Fclass::exist($field,$val);
        return $result;
    }

    public static function load($field, $val,$Fclass) {
        $ris = null;
        $ris = $Fclass::loadByField($field,$val);
        return $ris;
    }


    public static function update($field, $newvalue, $val,$Fclass) {
        $ris = null;
        if ($Fclass == "FExperience" || $Fclass == "FPlace" || $Fclass== "FImage")//AGGIUNGI LE FOUNDATION MAN MANO CHE LE FANNO SE IMPLEMENTANO IL METODO UPDATE
            $ris = $Fclass::update($field, $newvalue, $val);
        else
            print ("METODO NON SUPPORTATO DALLA CLASSE");
        return $ris;
    }

    public static function loadExperienceByFather($id){
        $result=null;
        $result=FExperience::loadExperienceChild($id);
        return $result;
    }

    public static function loadExperienceByPost($idPost){
        $result=null;
        $result=FExperience::loadByPost($idPost);
        return $result;
    }

    public static function loadByNation($nation){
        $result=null;
        $result=FPlace::loadByNation($nation);
    }

}