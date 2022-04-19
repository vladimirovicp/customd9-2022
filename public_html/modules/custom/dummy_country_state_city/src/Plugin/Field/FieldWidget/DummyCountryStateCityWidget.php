<?php

/**
 * @file
 * Contains \Drupal\dummy_country_state_city\Plugin\Field\FieldWidget\DummyCountryStateCityWidget.
 */

namespace Drupal\dummy_country_state_city\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Plugin implementation of the 'dummy_country_state_city_widget' widget.
 *
 * @FieldWidget(
 *   id = "dummy_country_state_city_widget",
 *   label = @Translation("Dummy Country state city widget"),
 *   field_types = {
 *     "dummy_country_state_city_type"
 *   }
 * )
 */

class DummyCountryStateCityWidget extends WidgetBase
{

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
  {

    $module_handler = \Drupal::service('module_handler');

    //dpm($module_handler);
    $module_path = $module_handler->getModule('dummy_country_state_city')->getPath(); // modules/custom/dummy_country_state_city

//    dpm($module_path);

    //https://niklan.net/blog/133

    $array = $fields = [];
    $i = 0;

    //$handle = @fopen($module_path . '/states.csv', "r");

    //fopen($this->file->getFileUri());

    dpm($handle);

//    if ($handle) {
//      while (($row = fgetcsv($handle, 4096)) !== FALSE) {
//        if (empty($fields)) {
//          $fields = $row;
//          continue;
//        }
//        foreach ($row as $k => $value) {
//          $array[$i][$fields[$k]] = $value;
//        }
//        $i++;
//      }
//      if (!feof($handle)) {
//        echo "Error: unexpected fgets() fail\n";
//      }
//      fclose($handle);
//    }
//
//
//    dpm($array);

    $countries = [];


    $element['country'] = [
      '#type' => 'select',
      '#options' => [
        '1' => $this
          ->t('One'),
        '2' => [
          '2.1' => $this
            ->t('Two point one'),
          '2.2' => $this
            ->t('Two point two'),
        ],
        '3' => $this
          ->t('Three'),
      ],
      '#default_value' => '1',
//      '#empty_option' => $this->t('-- Select an option --'),
    ];

    return $element;

  }

}
