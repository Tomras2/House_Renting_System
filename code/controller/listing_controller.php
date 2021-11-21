<?php

class listing_controller extends Controller {

    public function __construct(){
        $this->helper("link");

        $this->propertyModel = $this->model('propertyModel');
        $this->listingModel = $this->model('listingModel');
        $this->commentModel = $this->model('commentModel');
    }

    public function index(){

        $this->view("main_page");
    }

    public function listing($lid)
    {
        $userId = $this->getSession('userId'); // "39999999999";
        $listing = $this->listingModel->listing($lid);
        $comments = $this->commentModel->commentList($lid);

        $this->view("listing", $listing, $comments);
    }

    public function list()
    {
        $data = $this->listingModel->listingList();
        $this->view("listing_list", $data);
    }



    public function individual_listing_list()
    {
        $userId = $this->getSession('userId'); // "39999999999";

        $data = $this->listingModel->individualListingList($userId);

        $this->view("individual_listing_list", $data);
    }

    public function individual_listing($lid)
    {
        $userId = $this->getSession('userId'); // "39999999999";
        $listing = $this->listingModel->individualListing($lid, $userId);

        $this->view("individual_listing", $listing);
    }



    public function individual_property_list()
    {
        $userId = $this->getSession('userId'); // "39999999999";
        $data = $this->propertyModel->propertyList($userId);

        $this->view("individual_property_list", $data);
    }

    public function individual_property($pid)
    {
        $userId = $this->getSession('userId'); // "39999999999";
        $property = $this->propertyModel->property($pid);

        if($userId != $property->fk_Naudotojasasmens_kodas){
            $property = 0;
        }
        //var_dump($property);
        $this->view("individual_property", $property);
    }



    public function form()
    {
        $userId = $this->getSession('userId'); // "39999999999";
        $data["properties"] = $this->listingModel->individualProperties($userId);

        $this->view("listing_form", $data);
    }

    public function property_form()
    {
        $this->view("property_form");
    }

    public function createAddress($addressData){


        if(empty($addressData['salis'])){
            $addressData['salisError'] = 'Prašome įvesti šalį';
        }
        if(empty($addressData['miestas'])){
            $addressData['miestasError'] = 'Prašome įvesti miestą';
        }
        if(empty($addressData['rajonas'])){
            $addressData['rajonasError'] = 'Prašome įvesti rajoną';
        }
        if(empty($addressData['gatve'])){
            $addressData['gatveError'] = 'Prašome įvesti gatvę';
        }
        if(empty($addressData['nr'])){
            $addressData['nrError'] = 'Prašome įvesti namo numerį';
        }
        if(empty($addressData['salisError']) && empty($addressData['miestasError']) && empty($addressData['rajonasError'])
        && empty($addressData['gatveError']) && empty($addressData['nrError'])){

            $data = [$addressData['salis'], $addressData['miestas'], $addressData['rajonas'], $addressData['gatve'], $addressData['nr']];
            $id = $this->propertyModel->createAddress($data);
            return $id;
        } else {
            return 0;
        }
    }

    public function createProperty()
    {
        $addressData = [

            'salis'        => $this->input('salis'),
            'miestas'           => $this->input('miestas'),
            'rajonas'        => $this->input('rajonas'),
            'gatve'        => $this->input('gatve'),
            'nr'        => $this->input('nr'),
            'salisError'   => '',
            'miestasError'      => '',
            'rajonasError'   => '',
            'gatveError'      => '',
            'nrError'   => ''

           ];
        //var_dump($addressData);
        $adrid = $this->createAddress($addressData);
        if($adrid != 0){
            $propertyData = [

                'pavadinimas'        => $this->input('pavadinimas'),
                'tipas'           => $this->input('tipas'),
                'plotas'        => $this->input('plotas'),
                'kambariai'        => $this->input('kambariai'),
                'lovos'        => $this->input('lovos'),
                'aukstas'        => $this->input('aukstas'),
                'terasa'        => $this->input('terasa'),
                'wifi'        => $this->input('wifi'),
                'vonia'        => $this->input('vonia'),
                'info'        => $this->input('info'),
                'pavadinimasError'   => '',
                'tipasError'      => '',
                'plotasError'   => '',
                'kambariaiError'      => '',
                'lovosError'      => '',
                'aukstasError'      => '',
                'terasaError'      => '',
                'wifiError'      => '',
                'voniaError'      => '',
                'infoError'      => ''
               ];

            if(empty($propertyData['pavadinimas'])){
                $propertyData['pavadinimasError'] = 'Prašome įvesti pavadinimą';
            }
            if(empty($propertyData['tipas'])){
                $propertyData['tipasError'] = 'Prašome įvesti tipą';
            }
            if(empty($propertyData['plotas'])){
                $propertyData['plotasError'] = 'Prašome įvesti plotą';
            }
            if(empty($propertyData['kambariai'])){
                $propertyData['kambariaiError'] = 'Prašome įvesti kambarių skaičių';
            }
            if(empty($propertyData['lovos'])){
                $propertyData['lovosError'] = 'Prašome įvesti lovų skaičių';
            }
            if(empty($propertyData['aukstas'])){
                $propertyData['aukstasError'] = 'Prašome įvesti aukštų skaičių';
            }
            if(empty($propertyData['terasa'])){
                $propertyData['terasa'] = '0';
            }
            if(empty($propertyData['wifi'])){
                $propertyData['wifi'] = '0';
            }
            if(empty($propertyData['vonia'])){
                $propertyData['vonia'] = '0';
            }
            if(empty($propertyData['info'])){
                $propertyData['infoError'] = 'Prašome įvesti šalį';
            }

            if(empty($propertyData['tipasError']) && empty($propertyData['plotasError']) && empty($propertyData['kambariaiError'])
                && empty($propertyData['lovosError']) && empty($propertyData['aukstasError']) && empty($propertyData['terasaError'])
                && empty($propertyData['wifiError']) && empty($propertyData['voniaError'])){

                $userId = $this->getSession('userId'); // "39999999999";

                $data = [$propertyData['pavadinimas'], $propertyData['tipas'], $propertyData['plotas'], $propertyData['kambariai'],
                    $propertyData['lovos'], $propertyData['aukstas'], $propertyData['terasa'], $propertyData['wifi'],
                    $propertyData['vonia'], $propertyData['info'], $adrid, $userId, "0"
                ];

                if($this->propertyModel->createProperty($data)){
                    $this->setFlash("created", "Jūsų būstas sėkmingai sukurtas!");
                    $this->view('property_form');

                } else {
                    $this->setFlash("failed", "Modelio klaida: Nepavyko sukurti būsto!");
                    $this->view('property_form', $propertyData);
                }

            } else {
                $this->setFlash("failed", "Validacijos klaida: Nepavyko sukurti būsto!");
                $this->view('property_form', $propertyData);
            }
        } else{
            $this->setFlash("failed", "Modelio klaida: Nepavyko sukurti adreso!");
            $this->view('property_form', $propertyData);
        }


    }

    public function createListing(){
        $userId = $this->getSession('userId'); // "39999999999";
        $listingData = [

            'aprasymas'        => $this->input('aprasymas'),
            'kaina'           => $this->input('kaina'),
            'dataNuo'        => $this->input('dataNuo'),
            'dataIki'        => $this->input('dataIki'),
            'antraste'        => $this->input('antraste'),
            'atvykimoLaikas'        => $this->input('atvykimoLaikas'),
            'isvykimoLaikas'        => $this->input('isvykimoLaikas'),
            'matomumas'        => $this->input('matomumas'),
            'bustas'        => $this->input('bustas'),
            'aprasymasError'   => '',
            'kainaError'      => '',
            'dataNuoError'   => '',
            'dataIkiError'      => '',
            'antrasteError'      => '',
            'atvykimoLaikasError'      => '',
            'isvykimoLaikasError'      => ''
           ];

        if(empty($listingData['aprasymas'])){
            $listingData['aprasymasError'] = 'Prašome įvesti aprašymą';
        }
        if(empty($listingData['kaina'])){
            $listingData['kainaError'] = 'Prašome įvesti kainą';
        }
        if(empty($listingData['dataNuo'])){
            $listingData['dataNuoError'] = 'Prašome įvesti datą';
        }
        if(empty($listingData['dataIki'])){
            $listingData['dataIkiError'] = 'Prašome įvesti datą';
        }
        if(empty($listingData['antraste'])){
            $listingData['antrasteError'] = 'Prašome įvesti antraštę';
        }
        if(empty($listingData['atvykimoLaikas'])){
            $listingData['atvykimoLaikasError'] = 'Prašome įvesti laiką';
        }
        if(empty($listingData['isvykimoLaikas'])){
            $listingData['isvykimoLaikasError'] = 'Prašome įvesti laiką';
        }
        if(empty($listingData['matomumas'])){
            $listingData['matomumas'] = 0;
        }
        if(empty($listingData['aprasymasError']) && empty($listingData['kainaError']) && empty($listingData['dataNuoError']) &&
        empty($listingData['dataIkiError']) && empty($listingData['antrasteError']) && empty($listingData['atvykimoLaikasError']) &&
        empty($listingData['isvykimoLaikasError'])){

                $data = [$listingData['aprasymas'], $listingData['kaina'], $listingData['dataNuo'], $listingData['dataIki'],
                $listingData['antraste'], $listingData['atvykimoLaikas'], $listingData['isvykimoLaikas'], $listingData['matomumas'],
                $listingData['bustas'], $userId
                ];

                if($this->listingModel->createListing($data)){
                    $this->setFlash("created", "Jūsų skelbimas sėkmingai sukurtas!");
                    $this->view('listing_form');

                } else {
                    $this->setFlash("failed", "Modelio klaida: Nepavyko sukurti skelbimo!");
                    $listingData["properties"] = $this->listingModel->individualProperties($userId);
                    //var_dump($listingData);
                    $this->view('listing_form', $listingData);
                }

        } else {
            $this->setFlash("failed", "Validacijos klaida: Nepavyko sukurti skelbimo!");
            $listingData["properties"] = $this->listingModel->individualProperties($userId);
            //var_dump($listingData);
            $this->view('listing_form', $listingData);
        }

    }

    public function remove($lid){
        $reservations = $this->listingModel->getReservations($lid);
        if($reservations != false){
            foreach($reservations as $reservation){
                $this->listingModel->removeReservationComplaints($reservation->id_Rezervacija);
            }
        }
        $this->listingModel->removeReservations($lid);
        if($this->listingModel->removeListing($lid)){
            $this->setFlash("created", "Jūsų skelbimas sėkmingai panaikintas!");
            $this->individual_listing_list();
        }
        else {
            $this->setFlash("failed", "Klaida: Nepavyko panaikinti skelbimo!");
            $this->individual_listing($lid);
        }
    }

    public function setListingData($listingData, $lid){
        $userId = $this->getSession('userId'); // "39999999999";

        $data = $this->listingModel->listing($lid);
        $listingData["aprasymas"] = $data->aprasymas;
        $listingData["kaina"] = $data->kaina;
        $listingData["dataNuo"] = $data->dataNuo;
        $listingData["dataIki"] = $data->dataIki;
        $listingData["antraste"] = $data->antraste;
        $listingData["atvykimoLaikas"] = $data->atvykimo_laikas;
        $listingData["isvykimoLaikas"] = $data->isvykimo_laikas;
        $listingData["matomumas"] = $data->matomumas;
        $listingData["bustas"] = $data->fk_Bustasid_Bustas;
        $listingData["properties"] = $this->listingModel->individualProperties($userId);
        $listingData["lid"] = $lid;
        return $listingData;
    }

    public function edit($lid){
        $listingData = [
            'aprasymasError'   => '',
            'kainaError'      => '',
            'dataNuoError'   => '',
            'dataIkiError'      => '',
            'antrasteError'      => '',
            'atvykimoLaikasError'      => '',
            'isvykimoLaikasError'      => ''
           ];
        $listingData = $this->setListingData($listingData, $lid);
        //var_dump($listingData);
        $this->view('listing_edit', $listingData);
    }

    public function editListing($lid){
        $userId = $this->getSession('userId'); // "39999999999";
        $listingData = [

            'aprasymas'        => $this->input('aprasymas'),
            'kaina'           => $this->input('kaina'),
            'dataNuo'        => $this->input('dataNuo'),
            'dataIki'        => $this->input('dataIki'),
            'antraste'        => $this->input('antraste'),
            'atvykimoLaikas'        => $this->input('atvykimoLaikas'),
            'isvykimoLaikas'        => $this->input('isvykimoLaikas'),
            'matomumas'        => $this->input('matomumas'),
            'bustas'        => $this->input('bustas'),
            'aprasymasError'   => '',
            'kainaError'      => '',
            'dataNuoError'   => '',
            'dataIkiError'      => '',
            'antrasteError'      => '',
            'atvykimoLaikasError'      => '',
            'isvykimoLaikasError'      => ''
           ];

        if(empty($listingData['aprasymas'])){
            $listingData['aprasymasError'] = 'Prašome įvesti aprašymą';
        }
        if(empty($listingData['kaina'])){
            $listingData['kainaError'] = 'Prašome įvesti kainą';
        }
        if(empty($listingData['dataNuo'])){
            $listingData['dataNuoError'] = 'Prašome įvesti datą';
        }
        if(empty($listingData['dataIki'])){
            $listingData['dataIkiError'] = 'Prašome įvesti datą';
        }
        if(empty($listingData['antraste'])){
            $listingData['antrasteError'] = 'Prašome įvesti antraštę';
        }
        if(empty($listingData['atvykimoLaikas'])){
            $listingData['atvykimoLaikasError'] = 'Prašome įvesti laiką';
        }
        if(empty($listingData['isvykimoLaikas'])){
            $listingData['isvykimoLaikasError'] = 'Prašome įvesti laiką';
        }
        if(empty($listingData['matomumas'])){
            $listingData['matomumas'] = 0;
        }
        if(empty($listingData['aprasymasError']) && empty($listingData['kainaError']) && empty($listingData['dataNuoError']) &&
        empty($listingData['dataIkiError']) && empty($listingData['antrasteError']) && empty($listingData['atvykimoLaikasError']) &&
        empty($listingData['isvykimoLaikasError'])){

                $data = [$listingData['aprasymas'], $listingData['kaina'], $listingData['dataNuo'], $listingData['dataIki'],
                $listingData['antraste'], $listingData['atvykimoLaikas'], $listingData['isvykimoLaikas'], $listingData['matomumas'],
                $listingData['bustas'], $lid, $userId
                ];

                if($this->listingModel->updateListing($data)){
                    $this->setFlash("created", "Jūsų skelbimas sėkmingai pakeistas!");
                    $this->individual_listing($lid);

                } else {
                    $this->setFlash("failed", "Modelio klaida: Nepavyko pakeisti skelbimo!");
                    $listingData = $this->setListingData($listingData, $lid);
                    //var_dump($listingData);
                    $this->view('listing_edit', $listingData);
                }

        } else {
            $this->setFlash("failed", "Validacijos klaida: Nepavyko pakeisti skelbimo!");
            $listingData = $this->setListingData($listingData, $lid);
            //var_dump($listingData);
            $this->view('listing_edit', $listingData);
        }
    }

    public function mapAddresses($city){
        $data = $this->listingModel->addressesOfCity($city);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function filteredListings(){
        $miestas = $_GET['miestas'];
        $kainos = $_GET['kain'];
        $data = $this->listingModel->filteredListingList($miestas, $kainos);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}

?>