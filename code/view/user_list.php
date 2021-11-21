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
            <h1>Vartotojų sąrašas</h1>

            <table class="table table-dark">
            <tr>
                <th>Data Laikas</th>
                <th>Būsena</th>
                <th>Būstas</th>
		        <th></th>
	       </tr>
            <?php

            foreach($data as $key => $val) {
            $link = ROOT_URL."inspection_controller/confirmInspection/".$val->id_Patikra;
			echo
                "<tr href='<?php echo {$link}; ?>'>"

                    . "<td>{$val->data}</td>"
					. "<td>{$val->busena}</td>"
                    . "<td>{$val->fk_Bustasid_Bustas}</td>"
				. "</tr>";
		}

    ?>
    </table>
        </div>
    </body>
</html>