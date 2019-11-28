<?php

namespace Anax\View;

?>

<?php if ($weather) : ?>
    <h4>Väderprognos</h4>
    <div class="weather-card">
        <?php foreach ($weather as $day) :; ?>
            <div class="cards">
                <div class="card-left card">
                    <h5 class="card-heading"><?= date("Y-m-d", $day["time"]); ?></h5>
                    <p><?= $day["summary"]; ?></p>
                    <img src="image/weather/<?= $day["icon"]; ?>.png?w=100" alt="<?= $day["icon"]; ?>">
                </div>
                <div class="card-right card">
                    <p>min: <?= round($day["temperatureMin"]); ?>&ordm;C</p>
                    <p>max: <?= round($day["temperatureMax"]); ?>&ordm;C</p>
                    <p>Vind:<?= round($day["windSpeed"]); ?>m/s</p>
                    <p>Uv-index: <?= $day["uvIndex"]; ?></p>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
<?php endif ?>