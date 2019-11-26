<?php

namespace Anax\View;

?>

<?php if ($weather) : ?>
    <div>
        <p>Datum: <?= date("Y-m-d", $weather["time"]); ?></p>
        <p>Väder: <?= $weather["summary"]; ?></p>
        <p>Temperatur: <?= $weather["temperature"]; ?></p>
        <p>Vindhastighet: <?= $weather["windSpeed"]; ?></p>
        <p>Uv-index: <?= $weather["uvIndex"]; ?></p>
    </div>
<?php endif ?>