<?php
/**
 * Ip verifier.
 */

namespace Anax\IpVerify;

/**
 * Showing off a standard class with methods and properties.
 */
class IpVerify
{
    /**
     * Validates ip address.
     *
     * @return bool
     */

    public function ipVerify(string $ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validates ip address.
     *
     * @return string
     */

    public function getIpInfo(string $ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return "$ip is a valid IPV4 address";
        } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return "$ip is a valid IPV6 address";
        }
        else {
            return "$ip is not a valid IP address";
        }
    }

    /**
     * Gets domain.
     *
     * @return string
     */

    public function getDomain(string $ip)
    {

        $host = gethostbyaddr($ip);

        if ($host == false) {
            return "Saknas";
        } else {
            return $host;
        }
    }
}
