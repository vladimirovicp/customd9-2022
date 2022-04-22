<?php

namespace Drupal\dummy\Controller;
use Drupal\Core\Controller\ControllerBase;
/**
 * Controller for the salutation message.
 */

class DummyController extends ControllerBase {
  /**
   * Dummy.
   *
   * @return array
   *   Our message.
   */

  public function pageDummy() {

    /*Путь к модулю*/
    $path_module = \Drupal::service('extension.list.module')->getPath('dummy_import_csv');

    $path_countries_files = \Drupal::service('extension.list.module')->getPath('dummy_country_state_city') . '/files/countries.csv';


    dpm($path_module);

    \Drupal::messenger()->addError("Error text");


    return [
      '#markup' => $this->t('Hello World <br>' . $path_module . '<br>' . $path_countries_files),
    ];
  }

}
