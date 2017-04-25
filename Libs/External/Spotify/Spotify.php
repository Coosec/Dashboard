<?php

/**
 * Spotify Metadata API class
 * Class Documentation: https://github.com/cosenary/Spotify-PHP-API
 * 
 * @author Christian Metz
 * @since 26.11.2011
 * @copyright Christian Metz - MetzWeb Networks
 * @version 1.2
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * 
 * Enpoint was changed to new api by Konrad Zapala 25.04.2017
 */

namespace Libs\External\Spotify;

class Spotify {

  const API_URL = 'https://api.spotify.com/v1';

  //todo consider add more api examples
  public static function searchArtist($name, $limit = 5) {
    return self::_makeCall('/search', array('q' => $name, 'type' => 'artist', 'limit' => $limit));
  }

  public static function getUri($obj, $count = 0) {
    if (true === is_object($obj)) {
      $array = self::_objectToArray($obj);
      $type = $array['info']['type'] . 's';
      return $array[$type][$count]['href'];
    } else {
      throw new Exception("Error: getUri() - Requires JSON object returned by a search method.");
    }
  }

  private static function _objectToArray($object) {
    if (!is_object($object) && !is_array($object)) {
      return $object;
    }
    if (is_object($object)) {
      $object = get_object_vars($object);
    }
    return array_map(array(self, '_objectToArray'), $object);
  }

  private static function _makeCall($function, $params) {
    $params = '?' . utf8_encode(http_build_query($params));
    $apiCall = self::API_URL.$function.$params;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiCall);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    
    $jsonData = curl_exec($ch);
    curl_close($ch);
    return json_decode($jsonData);
  }

}