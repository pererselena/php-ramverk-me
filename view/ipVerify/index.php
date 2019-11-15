<?php

namespace Anax\View;

?>

<h2><?= $title ?></h2>
<h3>Validera genom html svar</h3>
<form class="ip_verify" method="post">
    <input type="text" name="ipAddress" placeholder="Ip adress" />
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
<a href="json_ip/?ip=8.8.8.8">Test API rätt svar</a>
<a href="json_ip/?ip=8.8.8">Test API fel svar</a>

<?php if ($protocol) : ?>
    <div>
        <p>Ip: <?= $ip; ?></p>
        <p>Giltig ip adress: <?= $isValid; ?></p>
        <p>Protokoll: <?= $protocol; ?></p>
        <p>Domän: <?= $domain; ?></p>
        <a href="json_ip/?ip=<?= $ip ?>">API svar</a>
    </div>
<?php endif ?>