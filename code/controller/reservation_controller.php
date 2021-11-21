<?php
class reservation_controller extends Controller {
    public function __construct(){
        $this->helper("link");
        $this->reservationModel = $this->model('reservationModel');
    }

    public function index() {
        $this->view("main_page");
    }

    public function create_reservation($lid)
    {
        $userId =$this->getSession('userId');
        #$userId = "39999999999"; #$this->getSession('userId');
        $listing = $this->reservationModel->listing($lid);
        foreach ($listing as $val)
        {
          $kaina = $val->kaina;
        }

        $start = $this->input('pradzia');
        $end = $this->input('pabaiga');
        
        $res = $this->reservationModel-> listingreservations($lid);
        $resbegins = [];
        foreach ($res as $re)
        {
            array_push($resbegins, $re->pradzia);
        }
        $inrange = false;
        $timestamp = strtotime($start);
        $date = date("d", $timestamp);
        $numb = intval($date);

        $timestamp2 = strtotime($end);
        $date2 = date("d", $timestamp2);
        $numb2 = intval($date2);
        foreach ($resbegins as $val)
        {
            $times = strtotime($val);
            $dat = date("d", $times);
            $number = intval($dat);

            if ($numb < $number && $number < $numb2)
            {
                $inrange = true;
                break;
            }
        }
        if ($inrange == true) {
        $this->setFlash("failed", "Vidinės datos užimtos, negalima rezervuoti!");
        $dat = $this->get_available_dates($lid);
        $this->view('reserve_property', $dat);
    }
else {



        $timestamp = strtotime($start);
        $date = date("d", $timestamp);
        $numb = intval($date);
    
        $timestamp2 = strtotime($end);
        $date2 = date("d", $timestamp2);
        $numb2 = intval($date2);
        
        $days = $numb2 - $numb;

        if ($days < 0)
        {
            $this->setFlash("failed", "Pradžios data turi būti anksčiau už pabaigos datą!");
            $dat = $this->get_available_dates($lid);
            $this->view('reserve_property', $dat);
        }
        else {

        $price = abs($kaina * $days);

        $reservationData = [
            'pradzia' => $this->input('pradzia'),
            'pabaiga' => $this->input('pabaiga'),
            'moketina_suma' => $price,
            'apmoketa' => "0",
            'busena' => "2",
            'pradziaError' => '',
            'pabaigaError' => ''
        ];

        if(empty($reservationData['pradzia'])){
            $reservationData['pradziaError'] = 'Prašome pasirinkti pradžią';
        }
        if(empty($reservationData['pabaiga'])){
            $reservationData['pabaigaError'] = 'Prašome pasrinkti pabaigą';
        }

        if (empty($reservationData['pradziaError']) && empty($reservationData['pabaigaError']))
        {
            $data = [$reservationData['pradzia'], $reservationData['pabaiga'], $reservationData['moketina_suma'], $reservationData['apmoketa'], $reservationData['busena'],
        $lid, $userId
        ];
    

        if($this->reservationModel->createReservation($data)){
            $this->setFlash("created", "Sėkmingai rezervuota!");
            $dat = $this->get_available_dates($lid);
            $this->view('reserve_property', $dat);
            
        } else {
            $this->setFlash("failed", "Modelio klaida: Nepavyko rezervuoti!");
            $dat = $this->get_available_dates($lid);
            $this->view('reserve_property', $dat);
        }
    }
    else {
        $this->setFlash("failed", "Validacijos klaida: Nepavyko rezervuoti!");
        $dat = $this->get_available_dates($lid);
            $this->view('reserve_property', $dat);
    }
}
}


    }

    public function edit_reservation($rid)
    {
        $userId =$this->getSession('userId');
        #$userId = "39999999999";  #$this->getSession('userId');
        $da = $this->reservationModel ->reservationlisting($rid);
        $lid = $da->fk_Skelbimasid_Skelbimas;
        $listing = $this->reservationModel->listing($lid);
        foreach ($listing as $val)
        {
          $kaina = $val->kaina;
        }
        $start = $this->input('prad');
        $end = $this->input('pab');

        $res = $this->reservationModel-> listingreservationsexcluded($lid, $rid);
        $resbegins = [];
        foreach ($res as $re)
        {
            array_push($resbegins, $re->pradzia);
        }
        $inrange = false;
        $timestamp = strtotime($start);
        $date = date("d", $timestamp);
        $numb = intval($date);

        $timestamp2 = strtotime($end);
        $date2 = date("d", $timestamp2);
        $numb2 = intval($date2);
        foreach ($resbegins as $val)
        {
            $times = strtotime($val);
            $dat = date("d", $times);
            $number = intval($dat);

            if ($numb < $number && $number < $numb2)
            {
                $inrange = true;
                break;
            }
        }
        if ($inrange == true) {
        $this->setFlash("failed", "Vidinės datos užimtos, negalima rezervuoti!");
        $dat = $this->get_available_dates_ex($lid, $rid);
        $this->view('reservation_edit', $dat, $rid);
    }
else {

        $timestamp = strtotime($start);
        $date = date("d", $timestamp);
        $numb = intval($date);

        $timestamp2 = strtotime($end);
        $date2 = date("d", $timestamp2);
        $numb2 = intval($date2);

        $days = $numb2 - $numb;
        if ($days < 0)
        {
            $this->setFlash("failed", "Pradžios data turi būti anksčiau už pabaigos datą!");
            $dat = $this->get_available_dates_ex($lid, $rid);
            $this->view('reservation_edit', $dat, $rid);
        }
        else {

        $price = $kaina * $days;

        $reservationData = [
            'pradzia' => $this->input('prad'),
            'pabaiga' => $this->input('pab'),
            'moketina_suma' => $price,
            'apmoketa' => "0",
            'busena' => "2",
            'pradziaError' => '',
            'pabaigaError' => ''
        ];

        if(empty($reservationData['pradzia'])){
            $reservationData['pradziaError'] = 'Prašome pasirinkti pradžią';
        }
        if(empty($reservationData['pabaiga'])){
            $reservationData['pabaigaError'] = 'Prašome pasrinkti pabaigą';
        }

        if (empty($reservationData['pradziaError']) && empty($reservationData['pabaigaError']))
        {
            $data = [$reservationData['pradzia'], $reservationData['pabaiga'], $reservationData['moketina_suma'], $reservationData['apmoketa'], $reservationData['busena'],
        $rid
        ];
    

        if($this->reservationModel->editReservation($reservationData['pradzia'], $reservationData['pabaiga'], $reservationData['moketina_suma'], $rid)){
            $this->setFlash("created", "Sėkmingai redaguota!");
            $dat = $this->get_available_dates_ex($lid, $rid);
            $this->view('reservation_edit', $dat, $rid);
            
        } else {
            $this->setFlash("failed", "Modelio klaida: Nepavyko rezervuoti!");
            $dat = $this->get_available_dates_ex($lid, $rid);
            $this->view('reservation_edit', $dat, $rid);
        }
    }
    else {
        $this->setFlash("failed", "Validacijos klaida: Nepavyko rezervuoti!");
        $dat = $this->get_available_dates_ex($lid, $rid);
            $this->view('reservation_edit', $dat, $rid);
    }
}

    }
}
public function owner_reservations_list($lid)
{
    #$userId = "39999999999";
    $userId =$this->getSession('userId');
    #$this->getSession('userId');
    $data= $this->reservationModel->ownerReservationList($lid);
    $this->view("owner_listing_reservation_list", $data);
}
public function owner_reservation($rid)
{
    #$userId = "39999999999";
    $userId =$this->getSession('userId');
    $data= $this->reservationModel->ownerReservation($rid);
    $this->view("owner_listing_reservation", $data);
}
public function confirm_reservation($rid)
{
    #$userId = "39999999999";
    $userId =$this->getSession('userId');
    if ($this->reservationModel->confirmReservation($rid))
    {
        $this->setFlash("created", "Rezervacija sėkmingai patvirtinta!");
        $this->view('main_page');
    }
    else {
        $this->setFlash("failed", "Rezervacijos patvirtinti nepavyko!");
        $this->owner_reservation($rid);
    }

  
}

public function remove_reservation($rid)
{
    if ($this->reservationModel->removeReservation($rid))
    {
        $this->setFlash("created", "Rezervacija sėkmingai pašalinta!");
        $userId =$this->getSession('userId');
        #$userId = "39999999999";
        $data= $this->reservationModel->reservationList($userId);
        $this-> view("individual_reservation_list", $data);

    }
    else {
        $this->setFlash("failed", "Klaida: Nepavyko pašalinti rezervacijos!");
        $this->individual_reservation($rid);
    }
}

    public function reservation_edit($rid) {
        $da = $this->reservationModel ->reservationlisting($rid);
        $data = $this->get_available_dates_ex($da->fk_Skelbimasid_Skelbimas, $rid);
        $this -> view("reservation_edit", $data, $rid);
    }

    public function reserve_property($lid) {
        $data = $this->get_available_dates($lid);
        $this-> view("reserve_property", $data);
    }

    
    public function get_available_dates($lid)
    {
        
        $data2 = $this->reservationModel -> listing($lid);
        $data3 = $this->reservationModel -> listingreservations($lid);
        foreach($data2 as $val) {
        $start = $val->dataNuo;
        $end = $val->dataIki;
        }
        $rstart = [];
        $rend = [];
        foreach($data3 as $val)
        {
            array_push($rstart, $val->pradzia);
            array_push($rend, $val->pabaiga);
        }

        $disabled = [];


        for ($i = 0; $i<count($rstart); $i++) {
            array_push($disabled, $rstart[$i]);
            array_push($disabled, $rend[$i]);
        }



        $date = new DateTime($start);
        $date2 = new DateTime($end);
        $date2 = $date2->modify('+1 day');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($date, $interval, $date2);
        $alldates = [];
        $alldates2 = [];
          foreach ($period as $dt) {
            $newd = date("m-d-Y", strtotime($dt));
              $format = $dt->format('Y-m-d');
              array_push($alldates2, $format);
          }
          foreach ($alldates2 as $val)
          {
              array_push($alldates, $val);
          }

        $dis = [];
        $dis2 = [];
        $is = false;
        for ($i = 0; $i < count($rstart); $i++)
        {
            foreach ($alldates as $num=>$all)
            {
                if ($alldates[$num] == $rstart[$i])
                {
                    $is = true;
                }
                if ($is)
                {
                    for ($k = $num; $k<$rend[$i]; $k++)
                    {
                        if ($alldates[$k] == $rend[$i])
                        {
                            array_push($dis, $alldates[$k]);
                            unset($alldates[$k]);
                            break;
                        }
                        array_push($dis, $alldates[$k]);
                       unset($alldates[$k]);
                    }
                    $is = false;
                    break;

                }
            }
        }


        $available = [];
        foreach ($alldates as $date)
        {
            array_push($available, $date);
        }

    
        $available2 = [];
        $last = count($available) - 1;
        $first = 0;
        foreach ($available as $num=>$date)
        {
            if ($num != $first && $num != $last)
            {

                $timestamp = strtotime($available[$num]);
                $date = date("d", $timestamp);
                $numb = intval($date);
                $timestamp2 = strtotime($available[$num-1]);
                $date2 = date("d", $timestamp2);
                $numb2 = intval($date2);
                $timestamp3 = strtotime($available[$num+1]);
                $date3 = date("d", $timestamp3);
                $numb3 = intval($date3);

                if ($numb - $numb2 != 1 && $numb3 - $numb != 1)
                {
                    array_push($dis, $available[$num]);

                }

            }
            else if ($num == $first)
            {
                $timestamp = strtotime($available[$num]);
                $date = date("d", $timestamp);
                $numb = intval($date);
                $timestamp2 = strtotime($available[$num+1]);
                $date2 = date("d", $timestamp2);
                $numb2 = intval($date2);

                if ($numb2 - $numb != 1)
                {
                    array_push($dis, $available[$num]);

                }
            }
            else if ($num == $last)
            {
                $timestamp = strtotime($available[$num]);
                $date = date("d", $timestamp);
                $numb = intval($date);
                $timestamp2 = strtotime($available[$num-1]);
                $date2 = date("d", $timestamp2);
                $numb2 = intval($date2);

                if ($numb - $numb2 != 1)
                {
                    array_push($dis, $available[$num]);
                }


            }
           
            }
            $data["start"] = $alldates2[0];
            $data["end"] = $alldates2[count($alldates2) - 1];
            $data["disabled"] = $dis; 
            $data["id"] = $lid;


             return $data;
    }


    
    public function individual_reservation_list() {

        #$userId = "39999999999"; #$this->getSession('userId');
        $userId =$this->getSession('userId');
        $data= $this->reservationModel->reservationList($userId);
        $this-> view("individual_reservation_list", $data);
    }

    public function individual_reservation($rid) {
        #$userId = "39999999999"; #$this->getSession('userId');
        $userId =$this->getSession('userId');
        $data= $this->reservationModel->reservation($rid);
        $this-> view("individual_reservation", $data);
    }

    // public function reservation_edit()
    // {
    //     $this-> view("reservation_edit");
    // }
    public function owner_listing_reservation_confirm()
    {
        $this-> view("owner_listing_reservation_confirm");
    }
    public function owner_listing_reservation_list()
    {
        $this-> view("owner_listing_reservation_list");
    }
    

 public function get_available_dates_ex($lid, $rid)
    {
        
        $data2 = $this->reservationModel -> listing($lid);
        $data3 = $this->reservationModel -> listingreservationsexcluded($lid, $rid);
        foreach($data2 as $val) {
        $start = $val->dataNuo;
        $end = $val->dataIki;
        }
        $rstart = [];
        $rend = [];
        foreach($data3 as $val)
        {
            array_push($rstart, $val->pradzia);
            array_push($rend, $val->pabaiga);
        }

        $disabled = [];


        for ($i = 0; $i<count($rstart); $i++) {
            array_push($disabled, $rstart[$i]);
            array_push($disabled, $rend[$i]);
        }



        $date = new DateTime($start);
        $date2 = new DateTime($end);
        $date2 = $date2->modify('+1 day');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($date, $interval, $date2);
        $alldates = [];
        $alldates2 = [];
          foreach ($period as $dt) {
            $newd = date("m-d-Y", strtotime($dt));
              $format = $dt->format('Y-m-d');
              array_push($alldates2, $format);
          }
          foreach ($alldates2 as $val)
          {
              array_push($alldates, $val);
          }

        $dis = [];
        $dis2 = [];
        $is = false;
        for ($i = 0; $i < count($rstart); $i++)
        {
            foreach ($alldates as $num=>$all)
            {
                if ($alldates[$num] == $rstart[$i])
                {
                    $is = true;
                }
                if ($is)
                {
                    for ($k = $num; $k<$rend[$i]; $k++)
                    {
                        if ($alldates[$k] == $rend[$i])
                        {
                            array_push($dis, $alldates[$k]);
                            unset($alldates[$k]);
                            break;
                        }
                        array_push($dis, $alldates[$k]);
                       unset($alldates[$k]);
                    }
                    $is = false;
                    break;

                }
            }
        }


        $available = [];
        foreach ($alldates as $date)
        {
            array_push($available, $date);
        }

    
        $available2 = [];
        $last = count($available) - 1;
        $first = 0;
        foreach ($available as $num=>$date)
        {
            if ($num != $first && $num != $last)
            {

                $timestamp = strtotime($available[$num]);
                $date = date("d", $timestamp);
                $numb = intval($date);
                $timestamp2 = strtotime($available[$num-1]);
                $date2 = date("d", $timestamp2);
                $numb2 = intval($date2);
                $timestamp3 = strtotime($available[$num+1]);
                $date3 = date("d", $timestamp3);
                $numb3 = intval($date3);

                if ($numb - $numb2 != 1 && $numb3 - $numb != 1)
                {
                    array_push($dis, $available[$num]);

                }

            }
            else if ($num == $first)
            {
                $timestamp = strtotime($available[$num]);
                $date = date("d", $timestamp);
                $numb = intval($date);
                $timestamp2 = strtotime($available[$num+1]);
                $date2 = date("d", $timestamp2);
                $numb2 = intval($date2);

                if ($numb2 - $numb != 1)
                {
                    array_push($dis, $available[$num]);

                }
            }
            else if ($num == $last)
            {
                $timestamp = strtotime($available[$num]);
                $date = date("d", $timestamp);
                $numb = intval($date);
                $timestamp2 = strtotime($available[$num-1]);
                $date2 = date("d", $timestamp2);
                $numb2 = intval($date2);

                if ($numb - $numb2 != 1)
                {
                    // print_r($numb);
                    // print_r($numb2);
                    array_push($dis, $available[$num]);
                }


            }
           
            }
            $data["start"] = $alldates2[0];
            $data["end"] = $alldates2[count($alldates2) - 1];
            $data["disabled"] = $dis; 
            $data["id"] = $lid;


             return $data;
    }

}

 ?>