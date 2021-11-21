<?php

class accountModel extends model {


    public function checkEmail($email){

        if($this->Query("SELECT elektroninis_pastas FROM naudotojai WHERE elektroninis_pastas = ?", [$email])){

            if($this->rowCount() > 0 ){
                return false;
            } else {
                return true;
            }
        }
    }

    public function createAccount($data){

        if($this->Query("INSERT INTO naudotojai (asmens_kodas, vardas, pavarde, telefono_numeris, elektroninis_pastas, slaptazodis)
         VALUES (?,?,?,?,?,?)", $data)){
            return true;
        }
        return false;
    }


    public function editAccount($data, $userId){

      if($this->Query("UPDATE naudotojai SET asmens_kodas = ? , vardas = ? , pavarde = ? ,
       telefono_numeris = ?
        WHERE asmens_kodas = '$userId'", $data)){
            return true;
        }
        return false;
  }

    public function getUserData($userId){

      if($this->Query("SELECT * FROM naudotojai WHERE asmens_kodas = '$userId'", [])){

            $data = $this->fetchAll();
            return $data;
      }
      return false;
    }


    public function deleteAccount($userId){

      if($this->Query("DELETE FROM atsiliepimu_skundai
        WHERE fk_Naudotojasasmens_kodas = ? ", [$userId])){
          if($this->Query("DELETE FROM atsiliepimai
          WHERE fk_Naudotojasasmens_kodas = ? ", [$userId])){
              if($this->Query("DELETE FROM bustai
              WHERE fk_Naudotojasasmens_kodas = ? ", [$userId])){
                  if($this->Query("DELETE FROM rezervacijos
                  WHERE fk_Naudotojasasmens_kodas = ? ", [$userId])){
                      if($this->Query("DELETE FROM naudotojai
                      WHERE asmens_kodas = ? ", [$userId])){

                        return true;
                      }
                  }
              }
          }
      }
      return false;
  }

    public function userLogin($email, $password){

        if($this->Query("SELECT * FROM naudotojai WHERE elektroninis_pastas = ? ", [$email])){

            if($this->rowCount() > 0 ){

                $row = $this->fetch();
                $dbPassword = $row->slaptazodis;
                $userId = $row->asmens_kodas;
                if(password_verify($password, $dbPassword)){

                    return ['status' => 'ok', 'data' => $userId];

                } else {
                    return ['status' => 'passwordNotMacthed'];
                }

            } else {
                return ['status' => 'emailNotFound'];
            }
        }
    }
}


?>