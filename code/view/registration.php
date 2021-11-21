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
        <?php $this->flash('accountCreated', 'alert alert-success') ?>
        <?php $this->flash('accountNotCreated', 'alert alert-danger') ?>
        <?php $this->flash('deleted', 'alert alert-success') ?>
        <div class="container text-white mt-3">


            <form class="form-horizontal" action="<?php echo ROOT_URL ?>accountController/createAccount" method="POST">
              <fieldset>
                <div id="legend">
                  <legend class="">Registracija</legend>
                </div>
                <div class="control-group">

                  <!-- Username -->
                  <label class="control-label"  for="username">Naudotojo vardas</label>
                  <div class="controls">
                    <input type="text" id="username" name="vardas" placeholder="" class="input-xlarge"
                    value="<?php if($data['vardas']): echo $data['vardas']; endif;?>">
                    <div class="error">
                        <small><?php if($data['vardasError']): echo $data['vardasError']; endif;?></small>
                    </div>
                    <p class="help-block"></p>
                  </div>
                </div>


                <div class="control-group">

                  <!-- Username -->
                  <label class="control-label"  for="username">Naudotojo pavardė</label>
                  <div class="controls">
                    <input type="text" id="username" name="pavarde" placeholder="" class="input-xlarge"
                    value="<?php if($data['pavarde']): echo $data['pavarde']; endif;?>">
                    <div class="error">
                        <small><?php if($data['pavardeError']): echo $data['pavardeError']; endif;?></small>
                    </div>
                    <p class="help-block"></p>
                  </div>
                </div>


                <div class="control-group">
                  <!-- E-mail -->
                  <label class="control-label" for="email">El. paštas</label>
                  <div class="controls">
                    <input type="text" id="email" name="epastas" placeholder="" class="input-xlarge"
                    value="<?php if($data['elektroninis_pastas']): echo $data['elektroninis_pastas']; endif;?>">
                    <div class="error">
                        <small><?php if($data['elektroninis_pastasError']): echo $data['elektroninis_pastasError']; endif;?></small>
                    </div>
                    <p class="help-block"></p>
                  </div>
                </div>

                <div class="control-group">
                <!-- Username -->
                <label class="control-label"  for="username">Asmens kodas</label>
                  <div class="controls">
                    <input type="text" id="username" name="kodas" placeholder="" class="input-xlarge"
                    value="<?php if($data['asmens_kodas']): echo $data['asmens_kodas']; endif;?>">
                    <div class="error">
                        <small><?php if($data['asmens_kodasError']): echo $data['asmens_kodasError']; endif;?></small>
                    </div>
                    <p class="help-block"></p>
                  </div>
                </div>

                <div class="control-group">
                <!-- Username -->
                <label class="control-label"  for="username">Telefono numeris</label>
                  <div class="controls">
                    <input type="text" id="username" name="telefonas" placeholder="" class="input-xlarge"
                    value="<?php if($data['telefono_numeris']): echo $data['telefono_numeris']; endif;?>">
                    <div class="error">
                        <small><?php if($data['telefono_numerisError']): echo $data['telefono_numerisError']; endif;?></small>
                    </div>
                    <p class="help-block"></p>
                  </div>
                </div>

                <div class="control-group">
                  <!-- Password-->
                  <label class="control-label" for="password">Slaptažodis</label>
                  <div class="controls">
                    <input type="password" id="password" name="slaptazodis" placeholder="" class="input-xlarge">
                    <div class="error">
                        <small><?php if($data['slaptazodisError']): echo $data['slaptazodisError']; endif;?></small>
                    </div>
                    <p class="help-block"></p>
                  </div>
                </div>

                <!--<div class="control-group">

                  <label class="control-label"  for="password_confirm">Pakartokite slaptažodį</label>
                  <div class="controls">
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
                    <p class="help-block"></p>
                  </div>
                </div>-->

                <div class="control-group">
                  <!-- Button -->
                  <div class="controls">
                    <button class="btn btn-success" name="submit" type="submit">Patvirtinti</button>
                  </div>
                </div>
              </fieldset>
            </form>


        </div>
    </body>
</html>