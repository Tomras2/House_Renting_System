<?php
  include(realpath("../config/config.php"));
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <link rel="stylesheet" href="<?php echo BASEURL . "css/bootstrap-slider.min.css" ?>">
        <script src="<?php echo BASEURL . "javascript/bootstrap-slider.min.js" ?>"></script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6-cgfFFGOukVlFctUvzZCjnz-wNRpXBQ&libraries=&v=weekly"
    ></script>

    <script>
    function initMap(coords) {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: coords,
        });
        return map
    }
    </script>
        <title>Būstų nuomos IS</title>
    </head>
    <body>
        <?php include(ROOT_DIR."view/navbar.php") ?>
        <div class="container text-white mt-3">
            <h1>Skelbimų sąrašas</h1>

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home" class="nav-link active">Visi skelbimai</a></li>
                <li><a data-toggle="tab" href="#menu1" class="nav-link">Ieškoti žemėlapyje</a></li>
                <li><a data-toggle="tab" href="#menu2" class="nav-link">Filtruoti</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in show active">
                    <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Antraštė</th>
                            <th scope="col">Tipas</th>
                            <th scope="col">Miestas</th>
                            <th scope="col">Lovų skaičius</th>
                            <th scope="col">Kambarių skaičius</th>
                            <th scope="col">Kaina</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($data)): ?>
                                <?php $i = 1; ?>
                                <?php foreach($data as $listing): ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><a href="<?php echo ROOT_URL.'listing_controller/listing/'.$listing->id_Skelbimas?>"><?php echo $listing->antraste; ?></a></td>
                                        <td><?php echo ucwords($listing->name); ?></td>
                                        <td><?php echo $listing->miestas; ?></td>
                                        <td><?php echo $listing->lovu_skaicius; ?></td>
                                        <td><?php echo $listing->kambariu_skaicius; ?></td>
                                        <td><?php echo $listing->kaina; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="form-inline md-form mb-4 mt-4">
                        <label for="city">Įveskite ieškomą miestą:</label><br>
                        <input class="form-control mr-sm-2 ml-3" id="city" type="text" placeholder="Search" aria-label="Search" style="width:40%">
                        <a href="#" id="search" class="btn btn-outline-success btn-rounded" type="submit">Search</a>
                    </div>
                    <div id="map"></div>
                </div>

                <div id="menu2" class="tab-pane fade">
                    <div class="form mb-4">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="miestas">Miestas: </label>
                                <input type="text" id="miestas" class="form-control">
                            </div>
                            <div class="col">

                            <label for="ex2">Kainos intervalas:</label><br>
                            <b>€ 5</b> <input id="ex2" type="text" class="span2" value="" data-provide="slider" data-slider-min="5" data-slider-max="300" data-slider-step="5" data-slider-value="[25,55]"/> <b>€ 300</b>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary" id="filter">
                    </div>
                    <div id="table"></div>
                </div>
            </div>

            <script>
                $("#ex2").slider({});
                $('#filter').click(function(){
                    let mst = $( "#miestas" ).val()
                    let kainos = $( "#ex2" ).val().split(',')
                    let txt;

                    const addrr = "<?php echo ROOT_URL.'listing_controller/filteredListings/'?>"
                    $.get( addrr, { miestas: mst, kain: kainos }).done(function( data ) {
                        data = JSON.parse(data)
                        console.log(data)
                        txt = '<table class="table table-hover table-dark" id="lentele">'+
                        '<tr><th>#</th><th>Antraštė</th><th>Tipas</th><th>Miestas</th><th>Lovų skaičius</th><th>Kambarių skaičius</th><th>Kaina</th></tr>';
                        let i = 1
                        data.forEach(function(value){
                            let tipas = value.name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            });
                            txt += "<tr><td>" + i + "</td><td><a href='<?php echo ROOT_URL.'listing_controller/listing/'?>"+ value.id_Skelbimas +"'>" + value.antraste + "</td><td>" + tipas +
                            "</td><td>" + value.miestas +"</td><td>" + value.lovu_skaicius +"</td><td>" + value.kambariu_skaicius +"</td><td>" + value.kaina +"</td></tr>";
                            i++
                        });
                        $( "#table" ).html(txt)

                    });
                });
            </script>

            <script>
             $('#search').click(function(){
                    let city = $( "#city" ).val()
                    let reqcity = "https://maps.googleapis.com/maps/api/geocode/json?address=+"+city+"&key=AIzaSyA6-cgfFFGOukVlFctUvzZCjnz-wNRpXBQ"
                    $.get( reqcity, function( data ) {
                        let coords = data.results[0].geometry.location
                        console.log(coords)
                        const map = initMap(coords);
                        $( "#map" ).css("height", "400px");
                        const adrr = "<?php echo ROOT_URL.'listing_controller/mapAddresses/'?>" + city;
                        console.log(adrr)
                        $.get(adrr , function( data ) {
                            const addresses = JSON.parse(data)
                            addresses.forEach(function(value){
                                let req = "https://maps.googleapis.com/maps/api/geocode/json?address=+"+value.namo_numeris+"+"+value.gatve+"+"+value.miestas+"&key=AIzaSyA6-cgfFFGOukVlFctUvzZCjnz-wNRpXBQ"
                                $.get( req, function( data ) {
                                    let coords = data.results[0].geometry.location
                                    console.log(coords)
                                    const marker = new google.maps.Marker({
                                        position: coords,
                                        map: map,
                                        url: "<?php echo ROOT_URL.'listing_controller/listing/'?>"+value.id_Skelbimas
                                    });
                                    marker.addListener("click", () => {
                                        window.location.href = marker.url;
                                    });
                                });
                            });

                        });
                    });

                    $( "#map" ).show();

                });
            </script>

        </div>
    </body>
</html>