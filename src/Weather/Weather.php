<?php

/**
 * Weather.
 */

namespace Anax\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Anax\IpGeo\IpGeo;

/**
 * Showing off a standard class with methods and properties.
 */
class Weather implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    protected $apiKey;

    /**
     * Constructor for object.
     *
     *
     */

    public function __construct($di)
    {
        $this->di = $di;
        $this->ipGeo = new IpGeo();
        $this->output = [
            "currently" => "",
            "daily" => "",
            "history" => "",
            "long" => "",
            "lat" => "",
            "country" => "",
            "city" => "",
            "map" => "",
            "embed" => "",
        ];
        $allKeys = require ANAX_INSTALL_PATH . "/config/api_keys.php";
        $this->apiKey = $allKeys["darkSky"];
        $this->curl = $this->di->get("curl");
    }

    /**
     * Get data.
     *
     */

    public function getCity(string $lat, string $long)
    {
        $url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=$lat&lon=$long&email=rutger@rutger.se&limit=1";
        $response = $this->curl->getData($url);
        $this->output["city"] = $response["display_name"];
    }

    /**
     * Get data.
     *
     */

    public function getCoords(string $city)
    {
        $url = "https://nominatim.openstreetmap.org/?format=json&q=$city&format=json&email=rutger@rutger.se&limit=1";
        $response = $this->curl->getData($url)[0];
        return [
            "long" => $response["lon"],
            "lat" => $response["lat"],
        ];
    }

    /**
     * Get data.
     *
     */

    public function getForecast(string $lat, string $long)
    {
        $url = "https://api.darksky.net/forecast/$this->apiKey/$lat,$long?lang=sv&units=si&exclude=hourly,minutely,alerts,flags";
        $response = $this->curl->getData($url);
        $this->output["currently"] = $response["currently"];
        $this->output["daily"] = $response["daily"];
        $this->output["long"] = $response["longitude"];
        $this->output["lat"] = $response["latitude"];
    }

    /**
     * Get data.
     *
     */

    public function getHistory(string $lat, string $long)
    {
        $time = new \DateTime();
        $urls = array();
        
        for ($i=1; $i < 30; $i++) {
            $unixTime = $time->getTimestamp();
            $url = "https://api.darkskye.net/forecast/$this->apiKey/$lat,$long,$unixTime?exclude=minutely,hourly,daily,alerts,flags&lang=sv&units=si";
            $urls[$i] = $url;
            $time->sub(new \DateInterval('P1D'));
        }

        $response = $this->curl->getMultiData($urls);
        $this->output["history"] = $response;
    }

    /**
     * Get data.
     *
     */

    public function getWeather(string $lat, string $long)
    {
        $this->getCity($lat, $long);
        $this->getForecast($lat, $long);
        $this->getHistory($lat, $long);
        $this->output["embed"] = $this->ipGeo->createEmbedMap($long, $lat);

        return $this->output;
    }
}
