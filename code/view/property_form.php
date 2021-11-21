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
            <h1>Naujas būstas</h1>
            <form action="<?php echo BASEURL; ?>listing_controller/createProperty" method="POST">
                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input type="text" class="form-control" id="pavadinimas" name="pavadinimas">
                </div>
                <div class="form-group">
                    <label for="tipas">Būsto tipas</label>
                    <select class="form-control" id="tipas" name="tipas">
                    <option value="2">Butas</option>
                    <option value="1">Namas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="salis">Šalis</label>
                    <input type="text" class="form-control" id="salis" name="salis">
                </div>
                <div class="form-group">
                    <label for="miestas">Miestas</label>
                    <input type="text" class="form-control" id="miestas" name="miestas">
                </div>
                <div class="form-group">
                    <label for="rajonas">Rajonas</label>
                    <input type="text" class="form-control" id="rajonas" name="rajonas">
                </div>
                <div class="form-group">
                    <label for="gatve">Gatvė</label>
                    <input type="text" class="form-control" id="gatve" name="gatve">
                </div>
                <div class="form-group">
                    <label for="nr">Namo numeris</label>
                    <input type="text" class="form-control" id="nr" name="nr">
                </div>
                <div class="form-group">
                    <label for="plotas">Plotas</label>
                    <input type="text" class="form-control" id="plotas" name="plotas">
                </div>
                <div class="form-group">
                    <label for="kambariai">Kambarių skaičius</label>
                    <input type="text" class="form-control" id="kambariai" name="kambariai">
                </div>
                <div class="form-group">
                    <label for="lovos">Lovų skaičius</label>
                    <input type="text" class="form-control" id="lovos" name="lovos">
                </div>
                <div class="form-group">
                    <label for="aukstas">Aukšto numeris</label>
                    <input type="text" class="form-control" id="aukstas" name="aukstas">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="terasa"  name="terasa">
                    <label class="form-check-label" for="terasa">
                        Būste yra terasa
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="wifi"  name="wifi">
                    <label class="form-check-label" for="wifi">
                        Būste yra Wi-Fi prieiga
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="vonia"  name="vonia">
                    <label class="form-check-label" for="vonia">
                        Būste yra vonia
                    </label>
                </div>
                <div class="form-group">
                    <label for="info">Papildoma informacija</label>
                    <textarea class="form-control" id="info" rows="2" name="info"></textarea>
                </div>
                <button class="btn btn-primary" type="submit" value="bustas">Kurti būstą</button>
            </form>
        </div>
    </body>
</html>