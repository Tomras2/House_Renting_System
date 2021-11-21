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
            <h1>Registracija patikrai</h1>
            <form method="POST" action="<?php echo ROOT_URL.'inspection_controller/register/'.$data?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Vardas</label>
                    <input name="vardas" type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Pavardė</label>
                    <input name="pavarde" type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Data</label>
                    <input name="data" type="date" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Laikas</label>
                    <input name="laikas" type="time" class="form-control" id="exampleFormControlInput1">
                </div>
               
                <button class="btn btn-primary type="submit>Registruotis</button>
            </form>
        </div>
    </body>
</html>