<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&family=Gowun+Dodum&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div class="nav-list">
                <div class="nav-img">
                    <a href="#">
                        <img src="imgs/weather_img.png" alt="WeatherLogo" class="img">
                    </a>
                </div>
                <h4 class="nav-desc">
                    <em>Explore Morocco weather for free !</em>
                </h4>
            </div>
        </nav>
    </header>
    <div class="container">
        <main>
            <h2 class="w-title">- Weather forecasts, fast and elegant way in Morocco : </h2>
            <form action="" method="post">
                <div class="aside">
                    <div class="w-select">
                        <label for="city">
                            Cities :
                        </label>
                        <select name="city" id="city">
                            <option value="Morocco">Select your city..</option>
                            <option name="AGADIR">Agadir</option>
                            <option name="BERKANE">Berkane</option>
                            <option name="CASABLANCA">Casablanca</option>
                            <option name="CHEFCHAOUEN">Chefchaouen</option>
                            <option name="ESSAOUIRA">Essaouira</option>
                            <option name="FEZ">Fez</option>
                            <option name="GUELMIM">Guelmim</option>
                            <option name="IFRANE">Ifrane</option>
                            <option name="KENITRA">Kenitra</option>
                            <option name="KHEMISSET">Khemisset</option>
                            <option name="KHOURIBGA">Khouribga</option>
                            <option name="LAAYOUNE">Laayoune</option>
                            <option name="LARACHE">Larache</option>
                            <option name="MARRAKECH">Marrakech</option>
                            <option name="MEKNES">Meknes</option>
                            <option name="MOHAMMEDIA">Mohammedia</option>
                            <option name="NADOR">Nador</option>
                            <option name="OUARZAZATE">Ouarzazate</option>
                            <option name="OUJDA">Oujda</option>
                            <option name="RABAT">Rabat</option>
                            <option name="SAFI">Safi</option>
                            <option name="SALE">Salé</option>
                            <option name="SETTAT">Settat</option>
                            <option name="TANGER">Tangier</option>
                            <option name="TETOUAN">Tetouan</option>
                        </select>
                    </div>
                    <button type="submit" name="getWeather">Explore!</button>
                </div>
                <div class="timer">
                    <div class="time_ma">

                        <h1 id="date"></h1>
                        <h2 id="tdate"></h2>
                    </div>
                    <div class="weather-re">
                        <div id="res">
                            <h1>
                                <?php
                                if (isset($_POST["getWeather"])) {
                                    $city = $_POST["city"];
                                    $apiKey = "274f853363629dd30b1905d0a20b88b0";
                                    $url = "https://api.openweathermap.org/data/2.5/weather?q=$city,MA&appid=$apiKey&units=metric";
                                    $request = curl_init();
                                    curl_setopt($request, CURLOPT_URL, $url);
                                    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
                                    $response = curl_exec($request);
                                    curl_close($request);
                                    if ($response) {
                                        $data = json_decode($response, true);
                                        if (isset($data["main"]["temp"])) {
                                            $temp = $data["main"]["temp"];
                                            $w_main = $data["weather"][0]["main"];
                                            $weather = $data["weather"][0]["description"];
                                            $humidity = $data["main"]["humidity"];
                                            $max = $data["main"]["temp_min"];
                                            $min = $data["main"]["temp_max"];
                                            $wind = $data["wind"]["speed"];
                                            echo $city . ",MA<br>";
                                        }
                                    }
                                }
                                ?><?php
                                    if (isset($data["main"]["temp"])) {
                                        echo ceil($temp) . "°C";
                                    }
                                    ?>
                            </h1>
                            <hr>
                            <div class="weath-img">
                                <?php
                                if (isset($data["main"]["temp"])) {
                                    if ($w_main == "Clouds") {
                                        echo '<img src="imgs/cloud.png" alt="Weather Icon">';
                                    } elseif ($w_main == "Rain") {
                                        echo '<img src="imgs/rain.png" alt="Weather Icon">';
                                    } elseif ($w_main == "Thunderstorm") {
                                        echo '<img src="imgs/thunderstorm.png" alt="Weather Icon">';
                                    } elseif ($w_main == "Drizzle") {
                                        echo '<img src="imgs/drizzler.png" alt="Weather Icon">';
                                    } elseif ($w_main == "Snow") {
                                        echo '<img src="imgs/snow.png" alt="Weather Icon">';
                                    } elseif ($w_main == "Clear") {
                                        $hour = date("H");
                                        if ($hour >= 6 && $hour <= 11) {
                                            echo '<img src="imgs/clear.png" alt="Weather Icon">';
                                        } elseif ($hour >= 17 || $hour <= 6) {
                                            echo '<img src="imgs/clearnight.png" alt="Weather Icon">';
                                        } else {
                                            echo '<img src="imgs/clear.png" alt="Weather Icon">';
                                        }
                                    }
                                    echo "<h3 class='weath'>" . ucwords($weather) . "</h3>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <h1 class="info">
                <?php
                if (isset($data["main"]["temp"])) {
                    echo "- High : " . ceil($min) . "° // ";
                    echo "Low : " . ceil($max) . "°<br>";
                    echo "- Wind : " . $wind . "°KpH<br>";
                    echo "- Humidity : $humidity%";
                }

                ?>
            </h1>
        </main>
    </div>
    <script>
        const date = document.getElementById("date")
        const tdate = document.getElementById("tdate")
        const mins = new Date().getMinutes()
        const hours = new Date().getHours()
        date.innerText = (hours.toString().length === 1 ? "0" + hours : hours) + " : " + (mins.toString().length === 1 ? "0" + mins : mins)
        tdate.innerText = (new Date().toLocaleString('en-us', {
            weekday: 'long'
        })).slice(0, 3) + ". " + new Date().getUTCDate() + " / " + (new Date().getMonth() + 1) + " / " + new Date().getFullYear()
    </script>
</body>

</html>