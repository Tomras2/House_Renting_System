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
            <h1>Būsto patikra</h1>
          
            <table class="table table-dark">
            <tbody>
                <tr>
                <td>Būklė</td>
                <td>70%</td>
                </tr>
                <tr>
                <td>Higiena</td>
                <td>80%</td>
                </tr>
                <tr>
                <td>Duomenų atitikimas</td>
                <td>100%</td>
                </tr>
                <tr>
                <td>Kaina</td>
                <td>Tinkama</td>
                </tr>
            </tbody>
            <table> 
            <a href="report_view.php">Gauti ataskaitą</a><br>
            <a href="inspection_rating.php">Vertinti patikrą</a>
        </div>
    </body>
</html>