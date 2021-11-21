<?php 
  include(realpath("../config/config.php"));
  
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Būstų nuomos IS</title>
        
    </head>
    <body>
        <?php include(ROOT_DIR."view/navbar.php") ?>
        <div class="container text-white mt-3">
            <h1>Mano būstų sąrašas</h1>
            <table class="table table-hover table-dark mt-2">
            <a href="<?php echo ROOT_URL ?>listing_controller/property_form" class="btn btn-success">Naujas būstas</a>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Pavadinimas</th>
                <th scope="col">Tipas</th>
                <th scope="col">Lovų skaičius</th>
                <th scope="col">Aukštas</th>
                <th scope="col">Įvertinimas</th>
                
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($data)): ?>
                    <?php $i = 1; ?>
                    <?php foreach($data as $property): ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><a href="<?php echo ROOT_URL.'listing_controller/individual_property/'.$property->id_Bustas?>"><?php echo $property->pavadinimas; ?></a></td>
                            <td><?php echo ucwords($property->name); ?></td>
                            <td><?php echo $property->lovu_skaicius; ?></td>
                            <td><?php echo $property->aukstas; ?></td>
                            <td><?php echo empty($property->administracijos_ivertinimas) ? "Nėra" : $property->administracijos_ivertinimas; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach;?>
                <?php endif; ?>
            </tbody>
            </table>
            
        </div>
    </body>
</html>