<?php

namespace Anax\View;

?>

<h2><?= $title ?></h2>
<h3>Validera genom html svar</h3>
<form class="ip_verify" method="post">
    <input type="text" name="ipAddress" placeholder="Ip adress" value="<?= $ip ?>" />
    <br>
    <input type="text" name="city" placeholder="Ort" />
    <br>
    <p>
        <input class="buttons_input" type="submit" name="weather" value="Söka" />
    </p>
</form>
<?php if ($weather) : ?>
    <div>
        <a href="json_geo/?ip=<?= $ip; ?>">API svar</a>
        <p>Ip: <?= $ip; ?></p>
        <p>Väder idag: <?= $weather["currently"]["summary"]; ?></p>
        <p>Temperatur idag: <?= $weather["currently"]["temperature"]; ?></p>
        <p>Vindhastighet idag: <?= $weather["currently"]["windSpeed"]; ?></p>
        <p>Uv-index idag: <?= $weather["currently"]["uvIndex"]; ?></p>
        <p>Geografisk position: <?= $weather["lat"]; ?>, <?= $weather["long"]; ?></p>
        <p>Ort: <?= $weather["city"]; ?></p>
        <!-- <p>Land: <?= $geoInfo["country"]; ?></p> -->
        <!-- <div>
            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $geoInfo["embed"]; ?>&amp;layer=mapnik&amp;marker=<?= $geoInfo["lat"]; ?>%2C<?= $geoInfo["long"]; ?>" style="border: 1px solid black"></iframe><br /><small><a href="https://www.openstreetmap.org/?mlat=<?= $geoInfo["lat"]; ?>&amp;mlon=<?= $geoInfo["long"]; ?>#map=15/<?= $geoInfo["lat"]; ?>/<?= $geoInfo["long"]; ?>">Visa större karta</a></small>
        </div> -->
    </div>
<?php endif ?>