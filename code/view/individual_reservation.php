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
            <h1>Mano rezervacija</h1>
            <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Pradžia</th>
      <th scope="col">Pabaiga</th>
      <th scope="col">Mokėtina suma</th>
      <th scope="col">Būsena</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($data)): ?>
                    <?php foreach($data as $reservation): ?>
                        <tr>
                           
                            <td><?php echo $reservation->pradzia; ?></td>
                            <td><?php echo $reservation->pabaiga; ?></td>
                            <td><?php echo $reservation->moketina_suma; ?></td>
                            <td><?php echo $reservation->name ?></td>
                        </tr>
                    <?php endforeach;?>
                <?php endif; ?>
  </tbody>
</table>
<div class="btn-toolbar">
<div class="btn-group mr-3">
<a href="<?php echo ROOT_URL.'reservation_controller/reservation_edit/'.$data[0]->id_Rezervacija?>" class="btn btn-primary">Redaguoti</a>

                </div>  
                <div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Naikinti</button>
                </div>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Ar tikrai norite pašalinti rezervaciją?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="<?php echo ROOT_URL.'reservation_controller/remove_reservation/'.$data[0]->id_Rezervacija;?>" method="POST">
                                <button type="submit" class="btn btn-warning">Taip</button>
                            </form>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ne</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>