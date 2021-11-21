<?php 

class inspectionModel extends Model {

    public function register($data){
        #var_dump($data);
        if($this->Query("INSERT INTO patikros (data, busena, fk_Administratoriustabelio_numeris, fk_Bustasid_Bustas) VALUES (?,?,?,?)", $data)){
            return true;
        }
        return false;
    }

    public function load(){
        if($this->Query("SELECT * FROM patikros")){
            $d = $this->fetchAll();           
            return $d;
        }
        return false;
    }

    public function loadById($d){
        if($this->Query("SELECT * FROM patikros WHERE fk_Bustasid_Bustas = ? ", [$d])){
            $da = $this->fetchAll();           
            return $da;
        }
        return false;
    }


    public function loadByState($d){
        if($this->Query("SELECT * FROM patikros WHERE busena = ? ", [$d])){
            $da = $this->fetchAll();           
            return $da;
        }
        return false;
    }

    public function addReport($data){

        if($this->Query("INSERT INTO ataskaitos (ivertinimas, aprasymas, sukurimo_data, komentaras, fk_Patikraid_Patikra) VALUES (?,?,?,?,?)", $data)){           
            return true;
        }
        return false;
    }


}

?>