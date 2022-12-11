<?php

namespace Drupal\api_lemon_pleiade\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\Component\Serialization\JSON;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\api_lemon_pleiade\LemonDataApiManager;

class PleiadeAjaxController extends ControllerBase {
  
  //function for autocomplete
  public function pleiade_data_autocomplete(Request $request){
    $return = []; //our variable to fill with data to return to autocomplete result
    
    $search = "global"; // all apps rights in lemon
    // $search_string = \Drupal::request()->request->get('myapplications');
    // if(strlen($search_string)) $search = "myapplications";

    $edataApi = new LemonDataApiManager();
    switch($search){
      case 'global':
        $return = $edataApi->searchMyApps($search_string); // empty param default
        break;
    }

    return new JsonResponse(json_encode($return), 200, [], true);
  }
  
}