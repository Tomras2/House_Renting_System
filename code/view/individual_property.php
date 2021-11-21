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
            <?php if($data != 0): ?>
            <h1><?php echo ucwords($data->pavadinimas);?></h1>
            <a href="<?php echo ROOT_URL.'inspection_controller/createInspection/'.$data->id_Bustas;  ?>">Registruotis būsto patikrai</a><br>
            <a href="<?php echo ROOT_URL.'inspection_controller/viewInspection/'.$data->id_Bustas;  ?>">Peržiūrėti patikrą</a><br>
            <table class="table table-hover table-dark">
            <tbody>
                <tr>
                <td>Plotas</td>
                <td><?php echo $data->plotas; ?> kv. m.</td>
                </tr>
                <tr>
                <td>Tipas</td>
                <td><?php echo ucwords($data->name); ?></td>
                </tr>
                <tr>
                <td>Lovų skaičius</td>
                <td><?php echo $data->lovu_skaicius; ?></td>
                </tr>
                <tr>
                <td>Kambarių skaičius</td>
                <td><?php echo $data->lovu_skaicius; ?></td>
                </tr>
                <tr>
                <td>Wi-fi priega</td>
                <td><?php echo $data->wifi_prieiga == 1 ? "Yra" : "Nėra"; ?></td>
                </tr>
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