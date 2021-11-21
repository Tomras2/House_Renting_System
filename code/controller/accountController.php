<?php

class accountController extends controller {


    public function __construct(){

        /*if($this->getSession('userId')){
            $this->redirect("accountController/profile");
        }*/
        $this->helper("link");
        $this->accountModel = $this->model('accountModel');
        $this->listingModel = $this->model('listingModel');

    }

    public function index(){

        $this->view("registration");
    }

    public function signup()
    {
        $this->view("registration");
    }

    public function signin()
    {
        $this->view("login");
    }

    public function profile()
    {
      $userId = $_SESSION["userId"];
      if($userData = $this->accountModel->getUserData($userId)){
        $this->view("account", $userData);
      }
      return false;
    }

    public function createAccount(){

        $userData = [

         'vardas'        => $this->input('vardas'),
         'pavarde'        => $this->input('pavarde'),
         'elektroninis_pastas'           => $this->input('epastas'),
         'telefono_numeris'        => $this->input('telefonas'),
         'asmens_kodas'        => $this->input('kodas'),
         'slaptazodis'        => $this->input('slaptazodis'),
         'vardasError'   => '',
         'pavardeError'   => '',
         'telefono_numerisError'   => '',
         'asmens_kodasError'   => '',
         'elektroninis_pastasError'      => '',
         'slaptazodisError'   => ''

        ];

        if(empty($userData['vardas'])){

            $userData['vardasError'] = 'Vardas yra privalomas';

        }

        if(empty($userData['pavarde'])){

          $userData['pavardeError'] = 'Pavardė yra privaloma';

        }

        if(empty($userData['telefono_numeris'])){

          $userData['telefono_numerisError'] = 'Telefono nr. yra privalomas';

        }

        if(empty($userData['asmens_kodas'])){

          $userData['asmens_kodasError'] = 'A.k. yra privalomas';

        }

        if(empty($userData['elektroninis_pastas'])){
            $userData['elektroninis_pastasError'] = 'El. paštas privalomas';
        } else {
            if(!$this->accountModel->checkEmail($userData['elektroninis_pastas'])){

             $userData['elektroninis_pastasError'] = "Šis el. paštas jau egzistuoja";

            }
        }

        if(empty($userData['slaptazodis'])){
            $userData['slaptazodisError'] = "Slaptažodis yra privalomas";
        } else if(strlen($userData['slaptazodis']) < 5 ){
            $userData['slaptazodisError'] = "Slaptažodis turi būti ne trumpesnis nei 5 simbolių";
        }

        if(empty($userData['vardasError']) && empty($userData['pavardeError']) &&
        empty($userData['telefono_numerisError']) && empty($userData['asmens_kodasError'])
         && empty($userData['elektroninis_pastasError']) && empty($userData['slaptazodisError'])){

            $password = password_hash($userData['slaptazodis'], PASSWORD_DEFAULT);
            $data = [$userData['asmens_kodas'], $userData['vardas'], $userData['pavarde'], $userData['telefono_numeris'], $userData['elektroninis_pastas'], $password];
            if($this->accountModel->createAccount($data)){

                $this->setFlash("accountCreated", "Paskyra sėkmingai sukurta.");
                $this->redirect("accountController/signin");
            } else {
                $this->setFlash("accountNotCreated", "Paskyra nesukurta - toks asmens kodas jau egzistuoja.");
                $this->redirect("accountController/signup");
            }
        } else {
            $this->view('registration', $userData);
        }
    }

    public function userLogin(){

        $userData = [

         'elektroninis_pastas'         => $this->input('lg_epastas'),
         'slaptazodis'      => $this->input('lg_slaptazodis'),
         'elektroninis_pastasError'    => '',
         'slaptazodisError' => ''

        ];

        if(empty($userData['elektroninis_pastas'])){
            $userData['elektroninis_pastasError'] = "El. paštas yra privalomas";
        }

        if(empty($userData['slaptazodis'])){
            $userData['slaptazodisError'] = "Neįvedėte slaptažodžio";
        }

        if(empty($userData['elektroninis_pastasError']) && empty($userData['slaptazodisError'])){

            $result = $this->accountModel->userLogin($userData['elektroninis_pastas'], $userData['slaptazodis']);
            if($result['status'] === 'emailNotFound'){
                $userData['elektroninis_pastasError'] = "Toks el. paštas sistemoje neegzistuoja";
                $this->view("login", $userData);
            } else if($result['status'] === 'passwordNotMacthed'){
                $userData['slaptazodisError'] = "Neteisingas slaptažodis";
                $this->view("login", $userData);
            } else if($result['status'] === "ok"){
                $this->setSession("userId", $result['data']);
                $this->redirect("listing_controller/index");
            }
;
        } else {
            $this->view("login", $userData);
        }

    }

    public function logout(){

        $this->unsetSession("userId");
        $this->destroy();
        $this->redirect("accountController/signin");
    }

    public function userEdit(){

      $userData = [

        'vardas'        => $this->input('r_vardas'),
        'pavarde'        => $this->input('r_pavarde'),
        'telefono_numeris'        => $this->input('r_telefonas'),
        'asmens_kodas'        => $this->input('r_kodas'),
        'vardasError'   => '',
        'pavardeError'   => '',
        'telefono_numerisError'   => '',
        'asmens_kodasError'   => ''

       ];

       if(empty($userData['vardas'])){

           $userData['vardasError'] = 'Vardas yra privalomas';

       }

       if(empty($userData['pavarde'])){

         $userData['pavardeError'] = 'Pavardė yra privaloma';

       }

       if(empty($userData['telefono_numeris'])){

         $userData['telefono_numerisError'] = 'Telefono nr. yra privalomas';

       }

       if(empty($userData['asmens_kodas'])){

         $userData['asmens_kodasError'] = 'A.k. yra privalomas';

       }


       if(empty($userData['vardasError']) && empty($userData['pavardeError']) &&
        empty($userData['telefono_numerisError']) && empty($userData['asmens_kodasError'])){


            $data = [$userData['asmens_kodas'], $userData['vardas'], $userData['pavarde'],
             $userData['telefono_numeris']];
            if($this->accountModel->editAccount($data, $_SESSION["userId"])){
                $this->setFlash("accountEdited", "Paskyra sėkmingai atnaujinta.");
                $this->redirect("accountController/profile");
            } else {
                $this->setFlash("accountNotEdited", "Paskyra nebuvo atnaujinta.");
                $this->redirect("accountController/profile");
            }
        } else {
          $this->setFlash("failed", "Validacijos klaida: Nepavyko atnaujinti paskyros!");
          $userId = $_SESSION["userId"];
          if($userData = $this->accountModel->getUserData($userId)){
            $this->view("account", $userData);
          }
          return false;
        }

  }

    public function deleteAccount(){

      $userId = $_SESSION["userId"];
      $skelbimai = $this->listingModel->individualListingList($userId);

      foreach($skelbimai as $skelbimas){
        $lid = $skelbimas->id_Skelbimas;
        $reservations = $this->listingModel->getReservations($lid);
        if($reservations != false){
            foreach($reservations as $reservation){
                $this->listingModel->removeReservationComplaints($reservation->id_Rezervacija);
            }
        }
        $this->listingModel->removeReservations($lid);
        $this->listingModel->removeListing($lid);
      }
      if($this->accountModel->deleteAccount($userId)){
          $this->setFlash("deleted", "Jūsų paskyra sėkmingai panaikinta!");
          $this->redirect("accountController/signup");
          $this->unsetSession("userId");
          $this->destroy();
      }
      else {
          $this->setFlash("notDeleted", "Nepavyko panaikinti paskyros.");
          $this->redirect("accountController/profile");
      }
  }

}


?>