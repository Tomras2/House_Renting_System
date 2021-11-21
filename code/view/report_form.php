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
            <h1>Ataskaitos pildymas</h1>
            <form method="POST" action="<?php echo ROOT_URL.'inspection_controller/newReport/'.$data?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Būklė</label>
                    <input name="aprasymas" type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Higiena</label>
                    <input name="komentaras" type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Duomenų atitikimas</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Kaina</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>Tinkama</option>
                    <option>Per didelė</option>
                    <option>Vagis</option>
                    <option>Chill man!</option>
                    </select>
                </div>
              
                <button class="btn btn-primary" type="submit">Pateikti</button>
            </form>
        </div>
    </body>
</html>