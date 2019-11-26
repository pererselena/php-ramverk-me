<?php

namespace Anax\View;

?>

<?php if ($weather) : ?>
    <div>
        <p>Väder idag: <?= $weather["currently"]["summary"]; ?></p>
        <p>Temperatur idag: <?= $weather["currently"]["temperature"]; ?></p>
        <p>Vindhastighet idag: <?= $weather["currently"]["windSpeed"]; ?></p>
        <p>Uv-index idag: <?= $weather["currently"]["uvIndex"]; ?></p>
        <p>Geografisk position: <?= $weather["lat"]; ?>, <?= $weather["long"]; ?></p>
        <p>Ort: <?= $weather["city"]; ?></p>
<?php endif ?>