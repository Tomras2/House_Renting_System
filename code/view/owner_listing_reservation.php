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
            <h1>Rezervacijos tvirtinimas</h1>
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
                        <tr>
                            <td><?php echo $data->pradzia; ?></td>
                            <td><?php echo $data->pabaiga; ?></td>
                            <td><?php echo $data->moketina_suma; ?></td>
                            <td><?php echo $data->name ?></td>
                        </tr>
                <?php endif; ?>
  </tbody>
</table>
<div>

                </div>  
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Patvirtinti</button>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Ar tikrai norite patvirtinti rezervaciją?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="<?php echo ROOT_URL.'reservation_controller/confirm_reservation/'.$data->id_Rezervacija;?>" method="POST">
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