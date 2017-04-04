<?php

namespace Jacob\Helper;

use \Abraham\TwitterOAuth\TwitterOAuth;

final class Twitter
{
    private static $consumerKey = "bffvyTxxeHCmuvDRrHcAqOAwy";
    private static $consumerSecret = "uW7C42kdwLawqClmKlraoHGKxwKQWeiW1t1IjIqSWSXKpP4VcN";

    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new TwitterOAuth(self::$consumerKey, self::$consumerSecret, null, null);
        }
        return $inst;
    }

    private function __construct(){}
}
?>