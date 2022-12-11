<?php

namespace Drupal\api_lemon_pleiade;

use Drupal\Component\Serialization\Json;
use GuzzleHttp\Exception\RequestException;
/**
 * Basic manager of module.
 */
class LemonDataApiManager {
  /**
   * The request url of the API.
   */
  // @TODO : get from admin param settings, hardcoded for the moment !
  const LEMON_API_URL = 'https://authdev.ecollectivites.fr/myapplications';
 
  public $client;
  /**
   * Constructor.
   */
  public function __construct() {
    if (!isset($_COOKIE['lemonldap'])) {
      $msg = 'Pas authentifié dans le SSO Lemon';
      \Drupal::logger('api_lemon_pleiade')->error($msg);
      return;
    }
    $this->client = \Drupal::httpClient();
  }

  /**
   * Do CURL request with authorization.
   *
   * @param string $resource
   *   A request action of api.
   * @param string $method
   *   A method of curl request.
   * @param Array $inputs
   *   A data of curl request.
   *
   * @return array
   *   An associate array with respond data.
   */
  private function executeCurl($resource, $method, $inputs, $api) {
    if (!isset($_COOKIE['lemonldap'])) {
      $msg = 'Pas authentifié dans le SSO Lemon';
      \Drupal::logger('api_lemon_pleiade')->error($msg);
      return NULL;
    }

    \Drupal::logger('api_lemon_pleiade')->info($_COOKIE['lemonldap']);

    if(is_array($resource)){
      $LEMON_API_URL =  $api;
      foreach ($resource as $res){
        $LEMON_API_URL.="/".$res;
      }
    }else{
      $LEMON_API_URL = $api . "/" . $resource;
    }
    
    $options = [
      'headers' => [
        'Content-Type' => 'application/json',
        'Cookie'=> 'llnglanguage=fr; lemonldap=' . $_COOKIE['lemonldap']
      ],
    ];

    if (!empty($inputs)) {
      
      if($method == 'GET'){
        $LEMON_API_URL.= '?' . self::arrayKeyfirst($inputs) . '=' . array_shift($inputs);
        foreach($inputs as $param => $value){
            $LEMON_API_URL.= '&' . $param . '=' . $value;
        }
      }else{
        //POST request send data in array index form_params.
        //$options['body'] = $inputs;
      }
    }

    try {
      $clientRequest = $this->client->request($method, $LEMON_API_URL, $options);
      $body = $clientRequest->getBody();
    } catch (RequestException $e) {
      \Drupal::logger('api_lemon_pleiade')->error('Curl error: @error', ['@error' => $e->getMessage()]);
    }

    return Json::decode($body);
  }

  /**
   * Get Request of API.
   *
   * @param string $resource
   *   A request action.
   * @param string $input
   *   A data of curl request.
   *
   * @return array
   *   A respond data.
   */
  public function curlGet($resource, $inputs, $api) {
    return $this->executeCurl($resource, "GET", $inputs, $api);
  }

  /**
   * Post Request of API.
   *
   * @param string $resource
   *   A request action.
   * @param string $inputs
   *   A data of curl request.
   *
   * @return array
   *   A respond data.
   */
  public function curlPost($resource, $inputs, $api) {
    return $this->executeCurl($resource, "POST", $inputs, $api);
  }

  public function searchByGroupes($groupes) {
    $resources = [
      "groupes",
      $siret,
    ];
    return $this->curlGet($resources, [], self::LEMON_API_URL);
  }

  public function searchMyApps($null) {
    $resources = [
      "myapplications",
      $null,
    ];
    return $this->curlGet($resources, [], self::LEMON_API_URL);
  }
  
  public function searchByName($name) {
    $resources = [
      "full_text",
      $name,
    ];
    return $this->curlGet($resources, [], self::LEMON_API_URL);
  }
  
  /**
   * Function to return first element of the array, compatability with PHP 5, note that array_key_first is only available for PHP > 7.3.
   *
   * @param array $array
   *   Associative array.
   *
   * @return string
   *   The first key data.
   */
  public static function arrayKeyfirst($array){
    if (!function_exists('array_key_first')) {
        foreach($array as $key => $unused) {
            return $key;
        }
        return NULL;
    }else{
        return array_key_first($array);
    }
  }

}
