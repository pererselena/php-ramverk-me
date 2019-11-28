<?php

namespace Anax\View;

?>

<h2><?= $title ?></h2>
<h3>Söka väderprognos</h3>
<form class="ip_verify" method="post">
    <label>Ip adress:<br>
        <input type="text" name="ipAddress" value="<?= $ip ?>" />
    </label>
    <br>
    <label>Ort:<br>
        <input type="text" name="city" placeholder="Ort" />
    </label>
    <br>
    <label>
        <input type="radio" name="search_type" value="history" />
        Historik
    </label>
    <br>
    <label>
        <input type="radio" name="search_type" value="forecast" />
        Forecast
    </label>
    <br>
    <label>
        <input type="radio" name="search_type" value="currently" />
        Väder idag
    </label>
    <br>
    <p>
        <input class="buttons_input" type="submit" name="weather" value="Söka" />
    </p>
</form>
<?php if ($weather) : ?>
    <div>
        <a href="json_geo/?ip=<?= $ip; ?>">API svar</a>
        <p>Ip: <?= $ip; ?></p>
        <div>
            <iframe class="map" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $weather["embed"]; ?>&amp;layer=mapnik&amp;marker=<?= $weather["lat"]; ?>%2C<?= $weather["long"]; ?>" style="border: 1px solid black"></iframe><br /><small><a href="https://www.openstreetmap.org/?mlat=<?= $weather["lat"]; ?>&amp;mlon=<?= $weather["long"]; ?>#map=15/<?= $weather["lat"]; ?>/<?= $weather["long"]; ?>">Visa större karta</a></small>
        </div>
    </div>
<?php endif ?>