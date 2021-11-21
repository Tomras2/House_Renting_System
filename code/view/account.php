<?php
  include(realpath("../config/config.php"));
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <?php $this->flash('deleted', 'alert alert-success') ?>
        <?php $this->flash('notDeleted', 'alert alert-danger') ?>
        <?php $this->flash('accountEdited', 'alert alert-success') ?>
        <?php $this->flash('accountNotEdited', 'alert alert-danger') ?>
        <?php $this->flash('failed', 'alert alert-danger') ?>
        <title>Būstų nuomos IS</title>
    </head>
    <body>
    <?php if(!empty($data)): ?>
      <?php foreach($data as $listing): ?>
        <?php include(ROOT_DIR."view/navbar.php") ?>
        <div class="container text-white mt-3">
            <h1>Paskyra</h1>

            <div class="container">
            <div class="row">
              <div class="col-lg-3 col-sm-6">

                      <div class="card hovercard">
                          <div class="cardheader">

                          </div>
                          <div class="avatar">
                              <img alt="" src="https://image.flaticon.com/icons/png/512/18/18148.png">
                          </div>
                          <div class="info">
                              <div class="title">
                                  <a target="_blank"><?php echo $listing->vardas; ?></a>
                                  <a target="_blank"><?php echo $listing->pavarde; ?></a>
                              </div>
                              <div class="desc">E-mail: <?php echo $listing->elektroninis_pastas; ?></div>
                              <div class="desc">Tel.: <?php echo $listing->telefono_numeris; ?></div>
                              <div class="desc">A.k.: <?php echo $listing->asmens_kodas; ?></div>
                          </div>
                          <div class="bottom">
                          <a class="btn btn-primary" data-toggle="modal" data-target="#modalLoginForm">Redaguoti paskyrą</a>
                          <a class="btn btn-danger"
                           onclick="return redirect('<?php echo ROOT_URL ?>accountController/deleteAccount');" href=""
                          >Naikinti paskyrą</a>

                            <div style="color: black;" class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold">Redaguoti paskyros duomenis</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="edit-form" action="<?php echo ROOT_URL ?>accountController/userEdit" method="POST">
                                  <div class="modal-body mx-3">
                                      <p style="margin-bottom: 0px;">Vardas</p>
                                      <input type="text" style="margin-bottom: 20px;" name="r_vardas" value="<?php echo $listing->vardas; ?>">
                                      <div class="error">
                                        <small><?php if($data['vardasError']): echo $data['vardasError']; endif;?></small>
                                      </div>

                                      <p style="margin-bottom: 0px;">Pavardė</p>
                                      <input type="text" style="margin-bottom: 20px;" name="r_pavarde" value="<?php echo $listing->pavarde; ?>">


                                      <p style="margin-bottom: 0px;">Telefono nr.</p>
                                      <input type="text" style="margin-bottom: 20px;" name="r_telefonas" value="<?php echo $listing->telefono_numeris; ?>">

                                      <p style="margin-bottom: 0px;">Asmens kodas</p>
                                      <input type="text" style="margin-bottom: 20px;" name="r_kodas" value="<?php echo $listing->asmens_kodas; ?>">
                                  </div>
                                  <div class="modal-footer d-flex justify-content-center">
                                  <button name="submit" type="submit" class="btn btn-primary">Redaguoti</button>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div>


                          </div>
                      </div>

                  </div>

            </div>
          </div>

        </div>
        <?php endforeach;?>
        <?php endif; ?>
    </body>
</html>
<script>
function redirect(url) {
  if (confirm('Ar tikrai norite panaikinti savo paskyrą?')) {
    window.location.href=url;
  }
  return false;
}
</script>
<style>
.card {
    padding-top: 20px;
    margin: 10px 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card .card-heading {
    padding: 0 20px;
    margin: 0;
}

.card .card-heading.simple {
    font-size: 20px;
    font-weight: 300;
    color: #777;
    border-bottom: 1px solid #e5e5e5;
}

.card .card-heading.image img {
    display: inline-block;
    width: 46px;
    height: 46px;
    margin-right: 15px;
    vertical-align: top;
    border: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}

.card .card-heading.image .card-heading-header {
    display: inline-block;
    vertical-align: top;
}

.card .card-heading.image .card-heading-header h3 {
    margin: 0;
    font-size: 14px;
    line-height: 16px;
    color: #262626;
}

.card .card-heading.image .card-heading-header span {
    font-size: 12px;
    color: #999999;
}

.card .card-body {
    padding: 0 20px;
    margin-top: 20px;
}

.card .card-media {
    padding: 0 20px;
    margin: 0 -14px;
}

.card .card-media img {
    max-width: 100%;
    max-height: 100%;
}

.card .card-actions {
    min-height: 30px;
    padding: 0 20px 20px 20px;
    margin: 20px 0 0 0;
}

.card .card-comments {
    padding: 20px;
    margin: 0;
    background-color: #f8f8f8;
}

.card .card-comments .comments-collapse-toggle {
    padding: 0;
    margin: 0 20px 12px 20px;
}

.card .card-comments .comments-collapse-toggle a,
.card .card-comments .comments-collapse-toggle span {
    padding-right: 5px;
    overflow: hidden;
    font-size: 12px;
    color: #999;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card-comments .media-heading {
    font-size: 13px;
    font-weight: bold;
}

.card.people {
    position: relative;
    display: inline-block;
    width: 170px;
    height: 300px;
    padding-top: 0;
    margin-left: 20px;
    overflow: hidden;
    vertical-align: top;
}

.card.people:first-child {
    margin-left: 0;
}

.card.people .card-top {
    position: absolute;
    top: 0;
    left: 0;
    display: inline-block;
    width: 170px;
    height: 150px;
    background-color: #ffffff;
}

.card.people .card-top.green {
    background-color: #53a93f;
}

.card.people .card-top.blue {
    background-color: #427fed;
}

.card.people .card-info {
    position: absolute;
    top: 150px;
    display: inline-block;
    width: 100%;
    height: 101px;
    overflow: hidden;
    background: #ffffff;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.people .card-info .title {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    color: #404040;
}

.card.people .card-info .desc {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 12px;
    line-height: 16px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.people .card-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    display: inline-block;
    width: 100%;
    padding: 10px 20px;
    line-height: 29px;
    text-align: center;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
}

.card.hovercard .cardheader {
    background: url("https://wallpaperaccess.com/full/869.jpg");
    background-size: cover;
    height: 135px;
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    background-color: rgb(200, 200, 200);
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard .info .title {
    margin-bottom: 10px;
    font-size: 24px;
    line-height: 1;
    color: #000000;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    font-size: 16px;
    line-height: 26px;
    color: #939393;
    text-overflow: ellipsis;
}

.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 20px;
}

.btn {
  width: 100px;
  height: 50px;
  font-size: 13px;
}
</style>