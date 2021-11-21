<?php
  include(realpath("../config/config.php"));
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <script src="<?php echo BASEURL; ?>javascript/modal.js"></script>

        <title>Būstų nuomos IS</title>
    </head>
    <body>
        <?php include(ROOT_DIR."view/navbar.php") ?>
        <?php $this->flash('created', 'alert alert-success') ?>
        <?php $this->flash('failed', 'alert alert-danger') ?>
        <div class="container text-white mt-3">
            <h1><?php echo $data->antraste; ?></h1>

            <p><?php echo $data->aprasymas; ?></p>
            <p><?php echo $data->papildoma_informacija; ?></p>
            <div>
                <button onclick="location.href='<?php echo ROOT_URL.'reservation_controller/reserve_property/'.$data->id_Skelbimas?>'"
                 class="btn btn-primary" <?php if(!$_SESSION["userId"]): echo "disabled"; endif;?>>Rezervuoti</button>
            </div>
            <table class="table table-hover table-dark mt-4">
            <tbody>
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
            <div>
                <div>

                    <button onclick="location.href='<?php echo ROOT_URL.'comment_controller/comment_create/'.$data->id_Skelbimas?>'"
                     class="btn btn-primary" <?php if(!$_SESSION["userId"]): echo "disabled"; endif;?>>Kurti komentarą</button>
                </div>

                <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Vardas</th>
                            <th scope="col">Pavardė</th>
                            <th scope="col">Atsiliepimas</th>
                            <th scope="col">Data</th>
                            <th scope="col">Įvertinimas</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($data2)): ?>
                                <?php $i = 1; ?>
                                <?php foreach($data2 as $comment): ?>
                                    <tr>
                                        <td><?php echo $comment->vardas; ?></a></td>
                                        <td><?php echo $comment->pavarde; ?></a></td>
                                        <td><?php echo $comment->tekstas; ?></a></td>
                                        <td><?php echo $comment->data; ?></a></td>
                                        <td><?php echo $comment->ivertinimu_skaicius; ?></a></td>
                                        <td> <a href="<?php echo ROOT_URL.'comment_controller/increase_rating/'.$comment->id_Atsiliepimas?>" class="btn btn-primary"> +1 </a> </td>
                                        <td> <a href="<?php echo ROOT_URL.'comment_controller/decrease_rating/'.$comment->id_Atsiliepimas?>" class="btn btn-primary"> -1 </a> </td>
                                        <td> <a href="<?php echo ROOT_URL.'comment_controller/comment_edit/'.$comment->id_Atsiliepimas?>" class="btn btn-primary"> Redaguoti </a> </td>
                                        <td> <a href="<?php echo ROOT_URL.'comment_controller/remove_comment/'.$comment->id_Atsiliepimas?>" class="btn btn-primary" onclick="return confirm('Ar tikrai norite istrinti atsiliepima?');"> Salinti </a> </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </body>
</html>