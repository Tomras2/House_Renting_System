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
        <?php $this->flash('failed', 'alert alert-danger') ?>
        <?php $this->flash('created', 'alert alert-success') ?>
        <div class="container text-white mt-3">
        <?php if(!empty($data->id_Skelbimas)): ?>
            <h1><?php echo $data->antraste; ?></h1>
            
            <p><?php echo $data->aprasymas; ?></p>
            <p><?php echo $data->papildoma_informacija; ?></p>

            <div class="btn-toolbar">
                <div class="btn-group mr-3">
                    <a href="<?php echo ROOT_URL.'listing_controller/edit/'.$data->id_Skelbimas; ?>" class="btn btn-warning">Redaguoti</a><br>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Naikinti</button>
                </div>
            </div>
            

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Ar tikrai norite panaikinti skelbimą?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="<?php echo ROOT_URL.'listing_controller/remove/'.$data->id_Skelbimas; ?>" method="POST">
                                <button type="submit" class="btn btn-secondary">Taip</button>
                            </form>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ne</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <table class="table table-hover table-dark mt-4">
            <tbody>
                <tr>
                <td>Ar matomas kitiems?</td>
                <td><?php echo $data->matomumas == 1 ? "Taip" : "Ne"; ?></td>
                </tr>
                <tr>
                <td>Adresas</td>
                <td><?php echo $data->gatve." ".$data->namo_numeris.", ".$data->miestas; ?></td>
                </tr>
                <tr>
                <td>Tipas</td>
                <td><?php echo ucwords($data->name); ?></td>
                </tr>
                <tr>
                <td>Kaina</td>
                <td><?php echo $data->kaina; ?></td>
                </tr>
                <tr>
                <td>Lovų skaičius</td>
                <td><?php echo $data->lovu_skaicius; ?></td>
                </tr>
                <tr>
                <td>Kambarių skaičius</td>
                <td><?php echo $data->kambariu_skaicius; ?></td>
                </tr>
                <tr>
                <td>Wi-fi priega</td>
                <td><?php echo $data->wifi_prieiga == 1 ? "Yra" : "Nėra"; ?></td>
                <tr>
                <td>Vonia</td>
                <td><?php echo $data->vonia == 1 ? "Yra" : "Nėra"; ?></td>
                </tr>
                <tr>
                <td>Terasa</td>
                <td><?php echo $data->terasa == 1 ? "Yra" : "Nėra"; ?></td>
                </tr>
            </tbody>
            </table>
            <?php endif; ?>
        </div>
    </body>
</html>