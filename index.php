<?php

    // API Key = e0e474d48e123e1bfdec4fed4a1d6a89

    $display = "";

    $weather = '';


    

    


    if ($_POST) {

        $city = $_POST['location'];

        $urlApi = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid=e0e474d48e123e1bfdec4fed4a1d6a89');

        $weatherArray = json_decode($urlApi, true);

        if ($_POST['location'] == "" OR $weatherArray['cod'] != 200) {

             $display .= "<div class='alert alert-danger' role='alert'>Please enter correct Location!</div>";

        }

        if ($weatherArray['cod'] == 200) {

            $looksLike = $weatherArray['weather'][0]['description'];

            $tempKevin = $weatherArray['main']['temp'] ;

            $tempF = intval(1.8 * ($tempKevin - 273) + 32)." &#x2109;";

            $weather = "Weather in ".$city." is currently '".$looksLike." with a temperature of ".$tempF."'.";

        }

    }

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <title>Weather</title>

</head>

<body>

    <div class="card text-center">

        <h3 class="card-header">Weather</h3>

        <div class="card-body">

            <h4 class="card-title">Search</h4>

            <form class="form-group" method="post">

                <div class="display"><?php if ($display != "") { echo $display; } ?></div>

                <input class="form-control text-center" type="text" name="location" placeholder="City &#38; State">

                <input class="btn btn-primary btn-block" type="submit" value="Search">

                <div class="weather">

                    <?php

                        if ($weather) {

                            echo '<div class="alert alert-success" role="alert">'.$weather.'</div>'; 

                        }

                    ?>                

                </div>

            </form>

        </div>

    </div>

</body>

</html>
