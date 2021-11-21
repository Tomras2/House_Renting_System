<?php 

class reservationModel extends Model {

    public function reservationList($userid)
    {
        if($this->Query("SELECT r.*, b.name, s.* FROM busenos b 
        RIGHT JOIN rezervacijos r
        ON r.busena=b.id_Busena INNER JOIN skelbimai s ON r.fk_Skelbimasid_Skelbimas = s.id_Skelbimas
        WHERE r.fk_Naudotojasasmens_kodas = ? ", [$userid])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }
    public function ownerReservationList($lid)
    {
        if($this->Query("SELECT r.*, b.name, s.*, n.vardas, n.pavarde FROM busenos b
        RIGHT JOIN rezervacijos r
        ON busena=id_Busena INNER JOIN skelbimai s ON r.fk_Skelbimasid_Skelbimas = s.id_Skelbimas
        RIGHT JOIN naudotojai n ON n.asmens_kodas = s.fk_Naudotojasasmens_kodas
        WHERE  s.id_Skelbimas = ?  ", [$lid])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }
    public function ownerReservation($rid)
    {
        if($this->Query("SELECT r.*, b.name, s.*, n.*  FROM busenos b
        RIGHT JOIN rezervacijos r
        ON busena=id_Busena INNER JOIN skelbimai s ON r.fk_Skelbimasid_Skelbimas = s.id_Skelbimas
        INNER JOIN naudotojai n ON n.asmens_kodas = s.fk_Naudotojasasmens_kodas
        WHERE r.id_Rezervacija = ?   ", [$rid])){
            $data = $this->fetch();
            return $data;
        }
        return false;
    }
    public function reservation($rid)
    {
        if($this->Query("SELECT r.*, b.name FROM rezervacijos r
        LEFT JOIN busenos b
        ON busena=id_Busena
        WHERE id_Rezervacija = ? ",[$rid])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }
    public function listing($lid)
    {
        if($this->Query("SELECT * FROM skelbimai
        WHERE id_Skelbimas = ? ", [$lid])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;
    }
    public function listingreservations($lid)
    {
        if($this->Query("SELECT * FROM rezervacijos
        WHERE fk_Skelbimasid_Skelbimas = ? ", [$lid])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;

    }
    public function listingreservationsexcluded($lid, $rid)
    {
        if($this->Query("SELECT * FROM rezervacijos
        WHERE fk_Skelbimasid_Skelbimas = ? AND NOT id_Rezervacija = ? ", [$lid, $rid])){
            $data = $this->fetchAll();
            return $data;
        }
        return false;

    }
    public function reservationlisting($rid)
    {
        if($this->Query("SELECT * FROM rezervacijos
        WHERE id_Rezervacija = ? ", [$rid])){
            $data = $this->fetch();
            return $data;
        }
        return false;

    }
    public function createReservation($data)
    {

  if($this->Query("INSERT INTO rezervacijos (pradzia, pabaiga, moketina_suma, apmoketa, busena, fk_Skelbimasid_Skelbimas,
        fk_Naudotojasasmens_kodas) VALUES (?,?,?,?,?,?,?)", $data)){
            return true;
        }
        return false;

    }
    public function editReservation($start, $end, $sum, $rid)
    {
        if($this->Query("UPDATE rezervacijos SET pradzia = ? , pabaiga = ? , moketina_suma = ? WHERE id_Rezervacija = ? ", [$start, $end, $sum, $rid] )){

            return true;

        }

    }
    public function removeReservation($rid){
        if($this->Query("DELETE FROM rezervacijos
        WHERE id_Rezervacija  = ? ", [$rid])){
            return true;
        }
        return false;
    }

    public function confirmReservation($rid)
    {
        if($this->Query("UPDATE rezervacijos SET busena = 1 WHERE id_Rezervacija = ? ", [$rid] )){

            return true;

        }
    }

    }