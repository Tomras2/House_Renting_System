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
            <h1>Naujas skelbimas</h1>
            <p>Norint kurti skelbimą reikia sukurti būstą. <a href="<?php echo ROOT_URL ?>listing_controller/property_form">Spauskite čia</a> jei norite jį sukurti.</p>
            
            <form action="<?php echo BASEURL; ?>listing_controller/createListing" method="POST">
                <div class="form-group">
                    <label for="antraste">Antraštė</label>
                    <div class="error">
                        <small><?php if($data['antrasteError']): echo $data['antrasteError']; endif;?></small>
                    </div>
                    <input type="text" class="form-control" id="antraste" name="antraste" value="<?php if($data['antraste']): echo $data['antraste']; endif; ?>">
                </div>
                <div class="form-group">
                    <label for="bustas">Pasirinkti būstą</label>
                    <select class="form-control" id="bustas" name="bustas">
                    <?php if(!empty($data)): ?>
                        <?php foreach($data["properties"] as $property): ?>
                            <tr>
                                <option value="<?php echo $property->id_Bustas; ?>"<?php if($data['bustas'] == $property->id_Bustas) echo ' selected="selected"'; ?>><?php echo $property->pavadinimas; ?></option>
                            </tr>
                        <?php endforeach;?>
                    <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="aprasymas">Aprašymas</label>
                    <div class="error">
                        <small><?php if($data['aprasymasError']): echo $data['aprasymasError']; endif;?></small>
                    </div>
                    <textarea class="form-control" id="aprasymas" name="aprasymas" rows="3"><?php if($data['aprasymas']): echo $data['aprasymas']; endif; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="kaina">Kaina</label>
                    <div class="error">
                        <small><?php if($data['kainaError']): echo $data['kainaError']; endif;?></small>
                    </div>
                    <input type="text" class="form-control" id="kaina" name="kaina" value="<?php if($data['kaina']): echo $data['kaina']; endif; ?>">
                </div>
                <div class="form-group">
                    <label for="dataNuo">Data Nuo</label>
                    <div class="error">
                        <small><?php if($data['dataNuoError']): echo $data['dataNuoError']; endif;?></small>
                    </div>
                    <input type="text" class="form-control" id="dataNuo" name="dataNuo" value="<?php if($data['dataNuo']): echo $data['dataNuo']; endif; ?>">
                </div>
                <div class="form-group">
                    <label for="dataIki">Data Iki</label>
                    <div class="error">
                        <small><?php if($data['dataIkiError']): echo $data['dataIkiError']; endif;?></small>
                    </div>
                    <input type="text" class="form-control" id="dataIki" name="dataIki" value="<?php if($data['dataIki']): echo $data['dataIki']; endif; ?>">
                </div>
                <div class="form-group">
                    <label for="atvykimoLaikas">Atvykimo laikas (Check-in time)</label>
                    <div class="error">
                        <small><?php if($data['atvykimoLaikasError']): echo $data['atvykimoLaikasError']; endif;?></small>
                    </div>
                    <input type="text" class="form-control" id="atvykimoLaikas" name="atvykimoLaikas" value="<?php if($data['atvykimoLaikas']): echo $data['atvykimoLaikas']; endif; ?>">
                </div>
                <div class="form-group">
                    <label for="isvykimoLaikas">Išvykimo laikas (Check-out time)</label>
                    <div class="error">
                        <small><?php if($data['isvykimoLaikasError']): echo $data['isvykimoLaikasError']; endif;?></small>
                    </div>
                    <input type="text" class="form-control" id="isvykimoLaikas" name="isvykimoLaikas" value="<?php if($data['isvykimoLaikas']): echo $data['isvykimoLaikas']; endif; ?>">
                </div>
                <div class="form-group form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="matomumas"  name="matomumas" <?php if ($data['matomumas'] == '1') echo "checked='checked'"; ?>>
                    <label class="form-check-label" for="matomumas">
                        Ar norite, kad skelbimas būtų visiems matomas?
                    </label>
                </div>
                <button class="btn btn-primary" type="submit">Kurti skelbimą</button>
            </form>
            
        </div>
    </body>
</html>