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
        <?php $this->flash('failed', 'alert alert-danger') ?>
        <?php $this->flash('created', 'alert alert-success') ?>
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
        <div class="container text-white mt-3">
            <h1>Redaguoti komentarą</h1>
            <form action="<?php echo ROOT_URL.'comment_controller/editComment/'.$data; ?>" method="POST">
            <div class="form-group">
                <label for="comment">Komentaras:</label>
                <textarea name="komentaras" class="form-control" rows="5" id="comment" placeholder="Senas komentaras čia…"></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" onclick="terms_changed(this)">
                <label class="form-check-label" for="exampleCheck1">Sutinku su komentavimo taisyklemis</label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" id="submit_button" disabled>Pateikti komentarą</button>
            </div>
            </form>
        </div>
    </body>
</html>