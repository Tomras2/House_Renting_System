<?php

class listingModel extends Model {

    public function listing($lid){
        if($this->Query("SELECT * FROM skelbimai
        INNER JOIN bustai
        ON fk_Bustasid_Bustas=id_Bustas
        INNER JOIN adresai
        ON fk_Adresasid_Adresas=id_Adresas
        INNER JOIN bustu_tipai
        ON tipas=id_Busto_tipas
        WHERE id_Skelbimas = ? ", [$lid])){
            $listing = $this->fetch();
            return $listing;
        }
        return 0;
    }

    public function listingList(){
        if($this->Query("SELECT * FROM skelbimai
        INNER JOIN bustai
        ON fk_Bustasid_Bustas=id_Bustas
        INNER JOIN adresai
        ON fk_Adresasid_Adresas=id_Adresas
        INNER JOIN bustu_tipai
        ON tipas=id_Busto_tipas", [])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }

    public function individualListing($lid, $userId){
        if($this->Query("SELECT * FROM skelbimai
        INNER JOIN bustai
        ON fk_Bustasid_Bustas=id_Bustas
        INNER JOIN adresai
        ON fk_Adresasid_Adresas=id_Adresas
        INNER JOIN bustu_tipai
        ON tipas=id_Busto_tipas
        WHERE id_Skelbimas = ?
        AND skelbimai.fk_Naudotojasasmens_kodas = ? ", [$lid, $userId])){
            $listing = $this->fetch();
            return $listing;
        }
        return 0;
    }

    public function individualListingList($userId){
        if($this->Query("SELECT * FROM skelbimai
        INNER JOIN bustai
        ON fk_Bustasid_Bustas=id_Bustas
        INNER JOIN adresai
        ON fk_Adresasid_Adresas=id_Adresas
        INNER JOIN bustu_tipai
        ON tipas=id_Busto_tipas
        WHERE skelbimai.fk_Naudotojasasmens_kodas = ? ", [$userId])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }

    public function individualProperties($userId){
        if($this->Query("SELECT * FROM bustai
        LEFT JOIN bustu_tipai
        ON tipas=id_Busto_tipas
        WHERE fk_Naudotojasasmens_kodas = ? ", [$userId])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }

    public function createListing($data){
        if($this->Query("INSERT INTO skelbimai (aprasymas, kaina, dataNuo, dataIki, antraste, atvykimo_laikas, isvykimo_laikas, matomumas, fk_Bustasid_Bustas,
        fk_Naudotojasasmens_kodas) VALUES (?,?,?,?,?,?,?,?,?,?)", $data)){
            return true;
        }
        return false;
    }

    public function getReservations($lid){
        if($this->Query("SELECT * FROM rezervacijos
        WHERE fk_Skelbimasid_Skelbimas = ? ", [$lid])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }

    public function removeReservationComplaints($rid){
        if($this->Query("DELETE FROM rezervaciju_skundai
        WHERE fk_Rezervacijaid_Rezervacija = ? ", [$rid])){
            return true;
        }
        return false;
    }

    public function removeReservations($lid){
        if($this->Query("DELETE FROM rezervacijos
        WHERE fk_Skelbimasid_Skelbimas = ? ", [$lid])){
            return true;
        }
        return false;
    }

    public function removeListing($lid){
        if($this->Query("DELETE FROM skelbimai
        WHERE id_Skelbimas = ? ", [$lid])){
            return true;
        }
        return false;
    }

    public function updateListing($updateData){

        if($this->Query("UPDATE skelbimai SET aprasymas = ? , kaina = ? , dataNuo = ? , dataIki = ? , antraste = ? ,
        atvykimo_laikas = ? , isvykimo_laikas = ? , matomumas = ? , fk_Bustasid_Bustas = ?
        WHERE id_Skelbimas = ? AND fk_Naudotojasasmens_kodas = ? ", $updateData)){
            return true;
        }
        return false;
    }

    public function addressesOfCity($city){
        if($this->Query("SELECT * FROM skelbimai
        INNER JOIN bustai
        ON fk_Bustasid_Bustas=id_Bustas
        INNER JOIN adresai
        ON fk_Adresasid_Adresas=id_Adresas
        WHERE miestas = ? ", [$city])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }

    public function filteredListingList($miestas, $kainos){
        $query = "SELECT * FROM skelbimai
        INNER JOIN bustai
        ON fk_Bustasid_Bustas=id_Bustas
        INNER JOIN adresai
        ON fk_Adresasid_Adresas=id_Adresas
        INNER JOIN bustu_tipai
        ON tipas=id_Busto_tipas
        WHERE kaina >= ? AND kaina < ?";

        $data = array();
        $data[] = $kainos[0];
        $data[] = $kainos[1];

        if(!empty($miestas)){
            $query .= " AND miestas = ?";
            $data[] = $miestas;
        }

        if($this->Query($query, $data)){
            $listings = $this->fetchAll();
            return $listings;
        }
        return 0;
    }

}

?>