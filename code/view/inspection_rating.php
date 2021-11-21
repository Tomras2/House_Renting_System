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
            <h1>Būsto patikros įvertinimas</h1>
            <form>
            <div class="form-group">
                    <label for="exampleFormControlSelect1">Rezultatas:</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>Tenkina</option>
                    <option>Netenkina</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Komentaras</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1">
                </div>
               
                <button class="btn btn-primary" type="submit">Pateikti</button>
            </form>
        </div>
    </body>
</html>