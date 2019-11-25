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

        foreach ($links as $url) {
            $ch1 = curl_init();

            // set URL and other appropriate options
            curl_setopt($ch1, CURLOPT_URL, $url);
            curl_setopt($ch1, CURLOPT_HEADER, 0);

            //create the multiple cURL handle
            $mh = curl_multi_init();

            //add the two handles
            curl_multi_add_handle($mh, $ch1);
            array_push($multiCurl, $ch1);
        }

        //execute the multi handle
        do {
            $status = curl_multi_exec($mh, $active);
            if ($active) {
                // Wait a short time for more activity
                curl_multi_select($mh);
            }
        } while ($active && $status == CURLM_OK);

        //close the handles
        foreach ($multiCurl as $ch) {
            $data = curl_multi_getcontent($ch);
            curl_multi_remove_handle($mh, $ch);
            array_push($outputArr, json_decode($data, true));
        }
        

        curl_multi_close($mh);

        return $outputArr;
    }
}
