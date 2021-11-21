<?php 

class commentModel extends Model {

    public function insertComment($data){
        #var_dump($data);
        if($this->Query("INSERT INTO atsiliepimai (tekstas, ivertinimu_skaicius, data, fk_Bustasid_Bustas,
        fk_Naudotojasasmens_kodas) VALUES (?,?,?,?,?)", $data)){
            return true;
        }
        return false;
    }

    public function updateComment($data){

        return $this->Query("UPDATE atsiliepimai SET tekstas = ?, data = ? WHERE id_Atsiliepimas = ?", $data);
    }

    public function commentList($lid){
        if($this->Query("SELECT * FROM atsiliepimai INNER JOIN naudotojai ON fk_Naudotojasasmens_kodas = asmens_kodas
        WHERE fk_Bustasid_Bustas = ? ", [$lid])){
            $data = $this->fetchAll();           
            return $data;
        }
        return false;
    }

    public function getComment($aid){
        if($this->Query("SELECT * FROM atsiliepimai INNER JOIN naudotojai ON fk_Naudotojasasmens_kodas = asmens_kodas
        WHERE id_Atsiliepimas = ? ", [$aid])){
            $data = $this->fetch();           
            return $data;
        }
        return false;
    }

    public function removeComment($aid, $uid){
        // if($this->Query("DELETE FROM atsiliepimai
        // WHERE id_Atsiliepimas = ?", [$aid])){
        //     return true;
        // }
        // return false;
    
        if($this->Query("DELETE FROM atsiliepimai
        WHERE id_Atsiliepimas = ? AND fk_Naudotojasasmens_kodas = ?", [$aid,$uid])){
            return true;
        }
        return false;
    }
    
    public function getListingId($aid){
        if($this->Query("SELECT fk_Bustasid_Bustas FROM atsiliepimai 
        WHERE id_Atsiliepimas = ?", [$aid])){
            $data = $this->fetch();           
            return $data;
        }
        return false;
    } 

    public function listing($lid)
    {
        #$userId = "39999999999";
        $userId = $this->getSession('userId');
        $listing = $this->listingModel->listing($lid);

        $this->view("listing", $listing);
    }

    public function increaseRating($aid){
        return $this->Query("UPDATE atsiliepimai SET ivertinimu_skaicius = ivertinimu_skaicius + 1 WHERE id_Atsiliepimas = ?", [$aid]);
    }

    public function decreaseRating($aid){
        return $this->Query("UPDATE atsiliepimai SET ivertinimu_skaicius = ivertinimu_skaicius - 1 WHERE id_Atsiliepimas = ?", [$aid]);
    }
}

?>