<?php

/**
 * Ip verifier.
 */

namespace Anax\IpGeo;

use Anax\IpVerify\IpVerify;

/**
 * Showing off a standard class with methods and properties.
 */
class IpGeo
{

    protected $apiKey;

    /**
     * Constructor for object.
     *
     * 
     */

    public function __construct()
    {
        $this->ipVerify = new IpVerify();
        $this->output = [
            "ip" => "",
            "protocol" => "",
            "isValid" => "",
            "domain" => "",
            "long" => "",
            "lat" => "",
            "country" => "",
            "city" => "",
            "map" => "",
            "flag" => "",
        ];
        $allKeys = require ANAX_INSTALL_PATH . "/config/api_keys.php";
        $this->apiKey = $allKeys["ipstack"];
    }

    /**
     * Get locaation.
     *
     * @return bool
     */

    public function getLocation(string $ipAdress)
    {
        $this->output["ip"] = $ipAdress;

        if ($this->ipVerify->ipVerify($ipAdress)) {
            $geoData = $this->getData($ipAdress);

            $this->output["isValid"] = true;
            $this->output["protocol"] = $this->ipVerify->getIpInfo($ipAdress);
            $this->output["domain"] = $this->ipVerify->getDomain($ipAdress);
            $this->output["long"] = $geoData["longitude"];
            $this->output["lat"] = $geoData["latitude"];
            $this->output["country"] = $geoData["country_name"];
            $this->output["city"] = $geoData["city"];
            $this->output["flag"] = $geoData["location"]["country_flag"];
            $this->output["map"] = $this->createMapLink($geoData["longitude"], $geoData["latitude"]);

            return $this->output;
        } else {
            $this->output["isValid"] = false;
            return $this->output;
        }
    }

    /**
     * Fetch data.
     *
     * @return array
     */

    public function getData(string $ipAdress)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "http://api.ipstack.com/$ipAdress?access_key=$this->apiKey");

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);

        return json_decode($data, true);
    }

    /**
     * Create map link.
     *
     * @return string
     */

    public function createMapLink(string $long, string $lat)
    {
        return "https://www.openstreetmap.org/#map=15/$lat/$long";
    }
}
