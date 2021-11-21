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
            <h1>Mano rezervacijų sąrašas</h1>
            <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Skelbimo antraštė</th>
      <th scope="col">Pradzia</th>
      <th scope="col">Pabaiga</th>
      <th scope="col">Mokėtina suma</th>
      <th scope="col">Būsena</th>

    </tr>
  </thead>
  <tbody>
  <?php if(!empty($data)): ?>
                    <?php $i = 1; ?>
                    <?php foreach($data as $reservation): ?>
                        <tr>
                           
                            <td><a href="<?php echo ROOT_URL.'reservation_controller/individual_reservation/'.$reservation->id_Rezervacija?>"><?php echo $reservation->antraste?></a></td>
                            <td><?php echo $reservation->pradzia; ?></td>
                            <td><?php echo $reservation->pabaiga; ?></td>
                            <td><?php echo $reservation->moketina_suma; ?></td>
                            <td><?php echo $reservation->name ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach;?>
                <?php endif; ?>
  </tbody>
</table>
        </div>
    </body>
</html>