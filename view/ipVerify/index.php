<?php

namespace Anax\View;

?>
<h2><?= $title ?></h2>
<form class="ip_verify" method="post">
    <input type="text" name="ipAddress" placeholder="Ip adress" />
    <br>
    <p>
        <input class="buttons_input" type="submit" name="ipVerify" value="Validera" />
    </p>
</form>
<a href="json_ip/?ip=8.8.8.8">API svar</a>

<?php if ($validationMsg) : ?>
    <div>
        <p><?= $validationMsg; ?></p>
        <p>Domän: <?= $domain; ?></p>
        <a href="json_ip/?ip=<?= $ip ?>">API svar</a>
    </div>
<?php endif ?>