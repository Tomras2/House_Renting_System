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
        <script>
            function terms_changed(exampleCheck1){
                //If the checkbox has been checked
                if(exampleCheck1.checked){
                    //Set the disabled property to FALSE and enable the button.
                    document.getElementById("submit_button").disabled = false;
                } else{
                    //Otherwise, disable the submit button.
                    document.getElementById("submit_button").disabled = true;
                }
            }
        </script>
        <?php include(ROOT_DIR."view/navbar.php") ?>
        <?php $this->flash('failed', 'alert alert-danger') ?>
        <div class="container text-white mt-3">
            <h1>Kurti komentarą</h1>
            <form method="POST" action="<?php echo ROOT_URL.'comment_controller/createComment/'.$data[0]?>">
            <div class="form-group">
                <label for="comment">Komentaras:</label>
                <textarea name="komentaras" class="form-control" rows="5" id="comment"></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" onclick="terms_changed(this)">
                <label class="form-check-label" for="exampleCheck1">Sutinku su komentavimo taisyklemis</label>
            </div>
                <button type="submit" class="btn btn-primary" id="submit_button" disabled>Pateikti komentarą</button>
            </form>
        </div>
    </body>
</html>