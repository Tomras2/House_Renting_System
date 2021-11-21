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
          
          
<?php
            foreach($data as $key => $val) {
                $id = $val->id_Patikra;
            echo 
                    "<table class='table table-dark'>"
				    . "<tr>"
                    . "<td>{$val->data}</td>"
					. "<td>{$val->busena}</td>"                   
				. "</tr>"
                . "<table>";

            }

?>
           
            
            <a href="<?php echo ROOT_URL.'inspection_controller/reportForm/'.$id;  ?>">Sukurti ataskaitą</a><br>
        </div>
    </body>
</html>