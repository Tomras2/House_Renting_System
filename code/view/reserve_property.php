<?php 
  include(realpath("../config/config.php"));
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Būstų nuomos IS</title>

        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/> -->
        <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
        <!-- <script src="<?php echo BASEURL; ?>javascript/datepicker.js"></script> -->
    </head>
    <body>
        <?php include(ROOT_DIR."view/navbar.php") ?>
        <?php $this->flash('failed', 'alert alert-danger') ?>
        <?php $this->flash('created', 'alert alert-success') ?>
        <div class="container text-white mt-3">
            <h1>Rezervavimas</h1>
            <form action ="<?php echo BASEURL.'reservation_controller/create_Reservation/'.$data["id"]?>" method="post">
            <!-- <div class="input-group input-daterange">
    <input type="text" class="form-control">
    <div class="input-group-addon">to</div>
    <input type="text" class="form-control">
</div> -->
<?php  $new = []; ?>
<?php if (!empty($data["disabled"])) {
  foreach ($data["disabled"] as $dat)
  {
    $date = date("m-d-Y", strtotime($dat));
    array_push($new, $date);
  }
}
?>
<?php
if (!empty($data["start"]) && !empty($data["end"]))
{
  $start= $data["start"];
  $end = $data["end"];
}
 ?>
<script>
 var disabled = <?php echo json_encode($new); ?>;
 var start =   <?php echo json_encode($start); ?>;
 var end =   <?php echo json_encode($end); ?>;
 
function nationalDays(date) {
  var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
      if($.inArray((m+1) + '-' + d + '-' + y,disabled) != -1 || new Date() > date) {
          return [false];
      }
  return [true];
}

jQuery(document).ready(function() {
  jQuery('#dt').datepicker({
      minDate: new Date(start),
      maxDate: new Date(end),
      dateFormat: 'yy-mm-dd',
      constrainInput: true,
      beforeShowDay: nationalDays
  });
  jQuery('#dt2').datepicker({
      minDate: new Date(start),
      maxDate: new Date(end),
      dateFormat: 'yy-mm-dd',
      constrainInput: true,
      beforeShowDay: nationalDays
  });
}); </script>

<div class="form-group">
 <label for="pradzia">Pradžia</label>
<input type="text" class = "form-control" id="dt" name = "pradzia" />
</div>
<div class="form-group">
 <label for="pabaiga">Pabaiga</label>
<input type ="text" class = "form-control" id="dt2" name = "pabaiga" />
</div>
      <div class="form-group"> <!-- Submit button -->
        <button class="btn btn-primary " name="submit" type="submit">Rezervuoti</button>
      </div>
     </form>
        </div>
    </body>
</html>