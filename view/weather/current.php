<?php

namespace Anax\View;

?>

<?php if ($weather) : ?>
    <div class="weather-card">
        <h4>Ort: <?= $weather["city"]; ?></h4>
        <p>Väder idag: <?= $weather["currently"]["summary"]; ?></p>
        <p>Temperatur idag: <?= $weather["currently"]["temperature"]; ?>&ordm;C</p>
        <p>Vindhastighet idag: <?= $weather["currently"]["windSpeed"]; ?></p>
        <p>Uv-index idag: <?= $weather["currently"]["uvIndex"]; ?></p>
        <p>Geografisk position: <?= $weather["lat"]; ?>, <?= $weather["long"]; ?></p>
    <?php endif ?>