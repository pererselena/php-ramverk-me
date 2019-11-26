<?php

/**
 * CurlModel.
 */

namespace Anax\CurlModel;

/**
 * Showing off a standard class with methods and properties.
 */
class CurlModel
{

    /**
     * Fetch data.
     *
     * @return array
     */

    public function getData(string $link)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $link);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);

        return json_decode($data, true);
    }

    /**
     * Fetch multidata.
     *
     * @return array
     */

    public function getMultiData(array $links)
    {
        $multiCurl = array();
        $outputArr = array();
        //create the multiple cURL handle
        $mh = curl_multi_init();

        foreach ($links as $url) {
            $ch1 = curl_init();

            // set URL and other appropriate options
            curl_setopt($ch1, CURLOPT_URL, $url);
            curl_setopt($ch1, CURLOPT_HEADER, 0);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

            //add the two handles
            curl_multi_add_handle($mh, $ch1);
            array_push($multiCurl, $ch1);
        }

        //execute the multi handle
        $active = null;
        do {
            curl_multi_exec($mh, $active);
        } while ($active);

        //close the handles
        foreach ($multiCurl as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }

        curl_multi_close($mh);

        foreach ($multiCurl as $ch) {
            $data = curl_multi_getcontent($ch);
            array_push($outputArr, json_decode($data, true));
        }

        return $outputArr;
    }
}
