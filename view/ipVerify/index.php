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

<?php if ($validationMsg) : ?>
    <div>
        <p><?= $validationMsg; ?></p>
        <p>Domän: <?= $domain; ?></p>
    </div>
<?php endif ?>
