<?php

namespace Anax\View;

?>

<h2><?= $title ?></h2>
<h3>Validera genom html svar</h3>
<form class="ip_verify" method="post">
    <input type="text" name="ipAddress" placeholder="Ip adress" value="<?= $ip ?>" />
    <br>
    <p>
        <input class="buttons_input" type="submit" name="ipVerify" value="Validera" />
    </p>
</form>
<h3>Validera genom API svar</h3>
<form class="ip_verify" method="get" action="json_ip">
    <input type="text" name="ip" placeholder="Ip adress" />
    <br>
    <p>
        <input class="buttons_input" type="submit" value="Validera" />
    </p>
</form>
<a href="json_geo/?ip=8.8.8.8">Test API rätt svar</a>
<a href="json_geo/?ip=8.8.8">Test API fel svar</a>
<p>För att använda APIt använd följande URL: http://www.student.bth.se/~elpr18/dbwebb-kurser/ramverk1/me/redovisa/htdocs/json_ip/?ip=8.8.8.8 där det efter ip?= byts ut mot den IP address man vill validera.</p>
<?php if ($geoInfo) : ?>
    <div>
        <p>Ip: <?= $geoInfo["ip"]; ?></p>
        <p>Giltig ip adress: <?= $geoInfo["isValid"] ? "Godkänd" : "Ej godkänd"; ?></p>
        <p>Protokoll: <?= $geoInfo["protocol"]; ?></p>
        <p>Domän: <?= $geoInfo["domain"]; ?></p>
        <p>Geografisk position: <?= $geoInfo["lat"]; ?>, <?= $geoInfo["long"]; ?></p>
        <p>Ort: <?= $geoInfo["city"]; ?></p>
        <p>Land: <?= $geoInfo["country"]; ?></p>
        <p>Flagga: <img src="<?= $geoInfo["flag"]; ?>" width="40" height="30" alt="Flagga" /> </p>
        <!-- <p>Karta: <?= $geoInfo["map"]; ?></p>
        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=17.504696846008304%2C59.55902719842611%2C17.53379344940186%2C59.58580401594082&amp;layer=mapnik&amp;marker=59.572418270439364%2C17.519245147705078" style="border: 1px solid black"></iframe><br /><small><a href="https://www.openstreetmap.org/?mlat=59.5724&amp;mlon=17.5192#map=15/59.5724/17.5192">Visa större karta</a></small> -->
        <a href="json_geo/?ip=<?= $geoInfo["ip"]; ?>">API svar</a>
    </div>
<?php endif ?>