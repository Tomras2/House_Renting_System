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
        <?php $this->flash('created', 'alert alert-success') ?>
        <div class="container text-white mt-3">
            <h1>Mano skelbimų sąrašas</h1>
            <a href="<?php echo ROOT_URL ?>listing_controller/form" class="btn btn-success">Naujas skelbimas</a>
            <table class="table table-hover table-dark mt-2">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Antraštė</th>
                <th scope="col">Tipas</th>
                <th scope="col">Lovų skaičius</th>
                <th scope="col">Kambarių skaičius</th>
                <th scope="col">Kaina</th>
                <th scope="col">Matomumas</th>
                <th scope="col">Rezervacijų sąrašas</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($data)): ?>
                    <?php $i = 1; ?>
                    <?php foreach($data as $listing): ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><a href="<?php echo ROOT_URL.'listing_controller/individual_listing/'.$listing->id_Skelbimas?>"><?php echo $listing->antraste; ?></a></td>
                            <td><?php echo ucwords($listing->name); ?></td>
                            <td><?php echo $listing->lovu_skaicius; ?></td>
                            <td><?php echo $listing->kambariu_skaicius; ?></td>
                            <td><?php echo $listing->kaina; ?></td>
                            <td><?php echo $listing->matomumas == 1 ? "Matomas" : "Nematomas"; ?></td>
                            <td><a href="<?php echo ROOT_URL.'reservation_controller/owner_reservations_list/'.$listing->id_Skelbimas?>">Rezervacijų sąrašas</a></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach;?>
                <?php endif; ?>
            </tbody>
            </table>
        </div>
    </body>
</html>