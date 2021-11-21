<?php
class comment_controller extends Controller {
    public function __construct(){
        $this->helper("link");
        $this->commentModel = $this->model('commentModel');
    }

    public function index() {
        $this->view("main_page");
    }

    public function comment_create($lid){
        $this->view("comment_create", $lid);
    }

    public function comment_edit($aid){
        $this->view("comment_edit", $aid);
    }

    public function createComment($lid)
    {
        $date = date('Y-m-d H:i:s', time());
        $ivert = 0;
        $commentData = ['komentaras' => $this->input('komentaras')];
        #$userId = "39999999999";
        $userId = $this->getSession('userId');  

            if(empty($commentData['komentaras'])){
                $commentData['komentarasError'] = 'Prašome įvesti komentarą';
            }

            if(empty($commentData['komentarasError'])){                

                $data = [$commentData['komentaras'], $ivert, $date, $lid, $userId];

                if($this->commentModel->insertComment($data)){
                    $this->setFlash("created", "Jūsų komentaras sėkmingai sukurtas!");
                    header("Location: ".ROOT_URL.'listing_controller/listing/'.$lid );
                    
                } else {
                    $this->setFlash("failed", "Modelio klaida: Nepavyko sukurti komentaro!");
                    $this->view('comment_create', $lid);
                }
            } 
            else {
                $this->setFlash("failed", "Validacijos klaida: Nepavyko sukurti komentaro!");
                $this->view('comment_create', $lid);
            }   
    }

    public function remove_comment($aid)
    {
        #$userId = "39999999999"; 
        $userId = $this->getSession('userId'); 

        $listingId = $this->commentModel->getListingId(intval(abs($aid)));
        $listingId = json_decode(json_encode($listingId), true);

        if ($this->commentModel->removeComment($aid, $userId))
        {
            $this->setFlash("created", "Komentaras sėkmingai pašalintas!");              
            header("Location: ".ROOT_URL.'listing_controller/listing/'.$listingId["fk_Bustasid_Bustas"]);
        }
        else {
            $this->setFlash("failed", "Klaida: Nepavyko pašalinti ,komentaro!");
            header("Location: ".ROOT_URL.'listing_controller/listing/'.$this->commentModel->getListingId($aid));
        }
    }

    public function editComment($aid){
        $userId = $this->getSession('userId'); 
        $date = date('Y-m-d H:i:s', time());
        $commentData = ['komentaras' => $this->input('komentaras')];

        if(empty($commentData['komentaras'])){
            $commentData['komentarasError'] = 'Prašome pakeisti komentarą';
        }

        if(empty($commentData['komentarasError'])){                

            $data = [$commentData['komentaras'], $date, intval(abs($aid))];

            if($this->commentModel->updateComment($data)){
                $this->setFlash("created", "Jūsų komentaras sėkmingai redaguotas!");
                $listingId = $this->commentModel->getListingId(intval(abs($aid)));
                $listingId = json_decode(json_encode($listingId), true);               
                header("Location: ".ROOT_URL.'listing_controller/listing/'.$listingId["fk_Bustasid_Bustas"]);
                
            } else {
                $this->setFlash("failed", "Modelio klaida: Nepavyko redaguoti komentaro!");
                $this->view('comment_edit', $aid);
            }

        } 
        else {
            $this->setFlash("failed", "Validacijos klaida: Nepavyko redaguoti komentaro!");
            $this->view('comment_edit', $aid);
        } 
    }

    public function increase_rating($aid){
        if(!empty($aid)){
            $lid = $this->commentModel->getListingId($aid);
            if($this->commentModel->increaseRating(intval(abs($aid)))){
                $this->setFlash("created", "Sekmingai įvertinta!");      
                $listingId = $this->commentModel->getListingId(intval(abs($aid)));
                $listingId = json_decode(json_encode($listingId), true);               
                header("Location: ".ROOT_URL.'listing_controller/listing/'.$listingId["fk_Bustasid_Bustas"]);            
            } else {
                $this->setFlash("failed", "Neįvertinta!");
                $listingId = $this->commentModel->getListingId(intval(abs($aid)));
                $listingId = json_decode(json_encode($listingId), true);               
                header("Location: ".ROOT_URL.'listing_controller/listing/'.$listingId["fk_Bustasid_Bustas"]);
            }
        }      
    }

    public function decrease_rating($aid){
        if(!empty($aid)){
            $lid = $this->commentModel->getListingId($aid);
            if($this->commentModel->decreaseRating(intval(abs($aid)))){
                $this->setFlash("created", "Sekmingai įvertinta!");
                $listingId = $this->commentModel->getListingId(intval(abs($aid)));
                $listingId = json_decode(json_encode($listingId), true);               
                header("Location: ".ROOT_URL.'listing_controller/listing/'.$listingId["fk_Bustasid_Bustas"]);
            } else {
                $this->setFlash("failed", "Neįvertinta!");
                $listingId = $this->commentModel->getListingId(intval(abs($aid)));
                $listingId = json_decode(json_encode($listingId), true);               
                header("Location: ".ROOT_URL.'listing_controller/listing/'.$listingId["fk_Bustasid_Bustas"]);
            }
        }      
    }
}
?>