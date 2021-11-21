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
            <h1>Mano skelbimo nepatvirtintų rezervacijų sąrašas</h1>
            <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Skelbimo antraštė</th>
      <th scope="col">Pradžia</th>
      <th scope="col">Pabaiga</th>
      <th scope="col">Mokėtina suma</th>
      <th scope="col">Būsena</th>
      <th scope="col">Tvirtinimas</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($data)): ?>
                    <?php $i = 1; ?>
                    <?php foreach($data as $reservation):
                      if ($reservation->busena == 2): ?>
                        <tr>
                            <td><?php echo $reservation->antraste; ?></td>
                            <td><?php echo $reservation->pradzia; ?></td>
                            <td><?php echo $reservation->pabaiga; ?></td>
                            <td><?php echo $reservation->moketina_suma; ?></td>
                            <td><?php echo $reservation->name ?></td>
                            <td><a href="<?php echo ROOT_URL.'reservation_controller/owner_reservation/'.$reservation->id_Rezervacija?>">Patvirtinti</a></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endif; ?>
                    <?php endforeach;?>
                <?php endif; ?>
  </tbody>
</table>
        </div>
    </body>
</html>