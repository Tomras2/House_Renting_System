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
            <h1>Patikros būstų sąrašas</h1>
            <table class="table table-dark">
            <tr>   
                 <th>Data Laikas</th>
                <th>Būsena</th>
		        <th>Administratorius</th>
                <th>Būstas</th>
		        <th></th>
	       </tr>
            <?php
           
            foreach($data as $key => $val) {
			echo
				"<tr>"
                    . "<td>{$val->data}</td>"
					. "<td>{$val->busena}</td>"
					. "<td>{$val->fk_Administratoriustabelio_numeris}</td>"
                    . "<td>{$val->fk_Bustasid_Bustas}</td>"                    
				. "</tr>";
		}
        
    ?>
    </table>
        </div>
    </body>
</html>