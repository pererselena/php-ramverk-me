<?php

namespace Anax\View;

?>

<?php if ($weather) : ?>
    <h4>Väderhistorik för 30 dagar</h4>
    <div class="weather-card">
        <?php foreach ($weather as $day) :; ?>
            <div class="cards">
                <div class="card-left card">
                    <h5 class="card-heading"><?= date("Y-m-d", $day["time"]); ?></h5>
                    <p><?= $day["summary"]; ?></p>
                </div>
                <div class="card-right card">
                    <p><?= $day["temperature"]; ?>&ordm;C</p>
                    <p>Vind: <?= $day["windSpeed"]; ?>m/s</p>
                    <p>Uv-index: <?= $day["uvIndex"]; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif ?>