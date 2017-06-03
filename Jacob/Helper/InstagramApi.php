<?php

namespace Jacob\Helper;

use MetzWeb\Instagram\Instagram;


final class InstagramApi
{

    public static function Instance()
    {
	$instagram = new Instagram(array(
		'apiKey'      => '27b2f3516801495286425ec2e548d156',
		'apiSecret' => '6d734b0cdd594a5b8196f793f7660a8d',
		'apiCallback'=> 'http://dashboard.dev'));

return $instagram;
    }

    private function __construct(){}
}
?>
