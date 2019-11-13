<?php
namespace Anax\View;

?>
<h2><?= $title ?></h2>
<form class="ip_verify" method="post">
    <input type="text" name="ip" placeholder="Ip adress" />
    <br>
    <p>
        <input class="buttons_input" type="submit" name="ipVerify" value="Validera" />
    </p>
</form>

<?php if ($resultset) : ?>
    <?php var_dump($resultset); ?>
<?php endif ?>
