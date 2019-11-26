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
    <input type="radio" name="search_type" value="history" />
    <br>
    <input type="radio" name="search_type" value="forecast" />
    <br>
    <input type="radio" name="search_type" value="currently" />
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
            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $weather["embed"]; ?>&amp;layer=mapnik&amp;marker=<?= $weather["lat"]; ?>%2C<?= $weather["long"]; ?>" style="border: 1px solid black"></iframe><br /><small><a href="https://www.openstreetmap.org/?mlat=<?= $weather["lat"]; ?>&amp;mlon=<?= $weather["long"]; ?>#map=15/<?= $weather["lat"]; ?>/<?= $weather["long"]; ?>">Visa större karta</a></small>
        </div>
    </div>
<?php endif ?>