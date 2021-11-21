<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo ROOT_URL ?>listing_controller/index">Būstų nuomos IS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item">
            <?php if(!$_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/accountController/signup'>Registruotis</a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>accountController/signup">
            Registracija</a>-->
        </li>
        <li class="nav-item">
            <?php if(!$_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/accountController/signin'>Prisijungti</a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>accountController/signin">
            Prisijungimas</a>-->
        </li>
        <li class="nav-item">
            <?php if($_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/accountController/profile'>Paskyra</a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>accountController/profile">
            Paskyra</a>-->
        </li>
        <li class="nav-item">
            <a style="color: lightgreen;" class="nav-link" href="<?php echo ROOT_URL ?>listing_controller/list">
            Skelbimai</a>
        </li>
        <li class="nav-item">
            <?php if($_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/listing_controller/individual_property_list'>Mano būstai</a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>listing_controller/individual_property_list">
            Mano būstai</a>-->
        </li>
        <li class="nav-item">
            <?php if($_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/listing_controller/individual_listing_list'>Mano skelbimai</a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>listing_controller/individual_listing_list">
            Mano skelbimai</a>-->
        </li>
        <li class="nav-item">
            <?php if($_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/reservation_controller/individual_reservation_list'>Mano rezervacijos</a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>reservation_controller/individual_reservation_list">
            Mano rezervacijos</a>-->
        </li>
        <li class="nav-item">
            <?php if($_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/inspection_controller/user_list'>Naudotojų sąrašas</a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>view/user_list.php">
            Naudotojų sąrašas</a>-->
        </li>
        <li class="nav-item">
            <?php if($_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/inspection_controller/inspectionList'>Patikros būstų sąrašas</a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>view/inspection_property_list.php">
            Patikros būstų sąrašas</a>-->
        </li>
        <li class="nav-item">
            <?php if($_SESSION["userId"]): echo "<a class='nav-link'
             href='http://localhost/ISP-Projektas/code/accountController/logout'><p style='color: red; margin: 0px;'>Atsijungti</p></a>"; endif;?>
            <!--<a class="nav-link" href="<?php echo ROOT_URL ?>accountController/logout">
            <p style='color: red; margin: 0px;'>Atsijungti</p></a>-->
        </li>
        </ul>
    </div>
</nav>