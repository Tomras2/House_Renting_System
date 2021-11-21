<?php
class inspection_controller extends Controller {
    public function __construct(){
        $this->helper("link");
        $this->inspectionModel = $this->model('inspectionModel');
    }

    public function index() {
        $this->view("main_page");
    }

    public function inspectionList(){
        $d = $this->inspectionModel->load();
        $this->view("inspection_property_list", $d );
    }


    public function createInspection($lid){
        $this->view("inspection_registration", $lid);
    }

    public function viewInspection($lid){
        $d = $this->inspectionModel->loadbyId($lid);
        $this->view("inspection_view", $d);
    }

    public function reportForm($lid){
        $this->view("report_form", $lid);
    }

    public function register($lid){

        $date = ['data' => $this->input('data')];
        $date = date('Y-m-d H:i:s', time());
        $userId = "2"; #$this->getSession('userId');
        $busena = "2";
                      
        
                $data = [$date, $busena, $userId, $lid];

                if($this->inspectionModel->register($data)){
                   
                    $this->setFlash("created", "Patikra užregistruota!"); 
                    $this->view("inspection_registration", $lid);
                }
                else
                {
                 
                    $this->setFlash("failed", "Registracija nepavyko!");  
                    $this->view("inspection_registration", $lid);
                }

               

    }

    public function newReport($lid){

        $date = date('Y-m-d H:i:s', time());
        $rating = "3"; #$this->getSession('userId');
        $aprasymas = ['aprasymas' => $this->input('aprasymas')];
        $aprasymas1 = ['komentaras' => $this->input('komentaras')];
        
                $data = [$rating, $aprasymas['aprasymas'], $date, $aprasymas1['komentaras'], $lid];

                if($this->inspectionModel->addReport($data)){
                   
                    $this->setFlash("created", "Ataskaita užregistruota!"); 
                    $this->view("report_form", $lid);
                }
                else
                {
                
                    $this->setFlash("failed", "Registracija nepavyko!");  
                   
                }

               

    }

    public function user_list(){
        $d = $this->inspectionModel->loadByState(2);
       
        $this->view("user_list", $d);
    }

    
    public function confirmInspection($d){
       
        $this->view("inspection_approval", $d);
    }


}
?>