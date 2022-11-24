<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Weatherly</title>
    <meta name="description" content="Free and reliable weather information for you!">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
</head>

<?php

if (!isset($_POST["city"])) {
    $city = "Dhaka";
    $url = "https://api.openweathermap.org/data/2.5/weather?lat=23.77&lon=90.39&units=metric&appid=50311b86f032a40ec6eb630472f728a6";
    $clima = file_get_contents($url);
    $content = json_decode($clima);
}

else {
    $city = $_POST["city"];
    $url = "http://api.openweathermap.org/geo/1.0/direct?q=$city&limit=5&appid=50311b86f032a40ec6eb630472f728a6";
    $clima = file_get_contents($url);
    $content = json_decode($clima);
    $city = $content[0]->name;
    $lat = $content[0]->lat;
    $lon = $content[0]->lon;
    $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&units=metric&appid=50311b86f032a40ec6eb630472f728a6";
    $clima = file_get_contents($url);
    $content = json_decode($clima);
}


?>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="72">
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav" style="background: var(--bs-indigo);color: rgb(27,109,191);">
        <div class="container"><a class="navbar-brand" href="#page-top">Weatherly</a>
            
        </div>
    </nav>
    <header class="text-center text-white bg-primary masthead">
        <h2 class="text-uppercase text-center text-secondary">Current Temperature is:</h2>
        <div class="container">
            <h1 style="margin-top: 64px;font-size: 50px;"><?php echo $content->main->temp ?> Degrees (<?php echo $city?>)</h1>

            <form class="row g-3 mt-4" method="post" action="">
                <div class="col-auto">
                    <input type="text" class="form-control" id="inputLocation" placeholder="Enter Name of the City" name="city">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary mb-3">Get Weather!</button>
                </div>
            </form>
        </div>
    </header>
    <section id="portfolio" class="portfolio">
        <div class="container" style="padding-top: 0px;">
            <h1 style="padding-top: 0px;margin-top: 37px;margin-bottom: 54px;padding-bottom: 0px;">3 Days Temperature Forecasts for <?php echo $city?>:</h1>
        </div>
        <div class="container">
            <p class="fs-3">
                <?php
                $url = "http://api.openweathermap.org/data/2.5/forecast?lat=$lat&lon=$lon&units=metric&appid=50311b86f032a40ec6eb630472f728a6";
                $clima = file_get_contents($url);
                $content = json_decode($clima);
                for ($i=0; $i<40 ;$i++) {
                    echo "<b>Date and time of the forecast: </b>".$content->list[$i]->dt_txt."<br>";
                    echo "<u>Weather Details</u>: ".$content->list[$i]->weather[0]->main."<br>";
                    echo "<u>Temperature</u>: ".$content->list[$i]->main->temp."° Celsius<br>";
                    echo "<u>Lowest Temperature</u>: ".$content->list[$i]->main->temp_min."° Celsius<br>";
                    echo "<u>Highest Temperature</u>: ".$content->list[$i]->main->temp_max."° Celsius<br>";
                    echo "------------------------<br>";
                }
                ?>
            </p>
        </div>
    </section>

    <div class="text-center text-white copyright py-4" style="margin-bottom: -24px;">
        <div class="container"><small>Copyright ©&nbsp;Weatherly 2022</small></div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>

<!--
now, I need to be able to convert utc time to normal date and time.
next I'll have to extract the max and min and temp for each of the array members.






-->