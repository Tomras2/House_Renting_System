<?php 

class propertyModel extends Model {

    public function createAddress($data){
        if($this->Query("INSERT INTO adresai (salis, miestas, rajonas, gatve, namo_numeris) VALUES (?,?,?,?,?)", $data)){
            $dd = $this->last_insert_id();
            return $dd;
        } 
        return 0;
    }

    public function createProperty($data){
        if($this->Query("INSERT INTO bustai (pavadinimas, tipas, plotas, kambariu_skaicius, lovu_skaicius, aukstas, terasa, wifi_prieiga, vonia,
        papildoma_informacija, fk_Adresasid_Adresas, fk_Naudotojasasmens_kodas, nuomavimo_patvirtinimas) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", $data)){
            return true;
        }
        return false;
    }

    public function propertyList($userId){
        if($this->Query("SELECT * FROM bustai
        LEFT JOIN bustu_tipai
        ON tipas=id_Busto_tipas
        WHERE fk_Naudotojasasmens_kodas = ? ", [$userId])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }

    public function property($pid){
        if($this->Query("SELECT * FROM bustai
        LEFT JOIN bustu_tipai
        ON tipas=id_Busto_tipas
        WHERE id_Bustas = ? ", [$pid])){
            $property = $this->fetch();
            return $property;
        }
        return 0;
    }

}

?>