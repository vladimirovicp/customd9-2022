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

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;

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
    $module_path = $module_handler->getModule('dummy_country_state_city')->getPath(); // modules/custom/dummy_country_state_city
    $array = $fields = [];

    $country_options = [];
    $state_options = [];
    $city_options = [];

    $i = 0;
    $handle = @fopen($module_path . '/files/countries.csv', "r");

    if ($handle) {
      while (($row = fgetcsv($handle,  4096, ';')) !== FALSE) {
        if (empty($fields)) {
          $fields = $row;
          continue;
        }
        foreach ($row as $k => $value) {
          $array[$i][$fields[$k]] = $value;
          $country_options[$array[$i]['id']] = $array[$i]['nameRu'];
        }
        $i++;
      }

      if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
      }

      fclose($handle);

    }

    //dpm($array);

    //https://niklan.net/blog/133



    $element['country'] = [
      '#type' => 'select',
      '#title' => !empty($this->getFieldSetting('country_lable')) ? $this->getFieldSetting('country_lable') : $this->t('Country'),
      '#empty_option' => $this->t('-- Select an option --'),
      '#options' => $country_options,
//    '#default_value' => '182',
      '#suffix' => '<div id="edit-output">tid = <span id="country-tid"></span></div>',
//      '#ajax' => [
//        'callback' => '_ajaxFillState',
//        'event' => 'change',
//      ],
      '#ajax' => [
        'callback' => '::logSomething',
      ],
    ];

    $element['state'] = [
      '#type' => 'select',
      '#title' => !empty($this->getFieldSetting('state_lable')) ? $this->getFieldSetting('state_lable') : $this->t('Region'),
      '#empty_option' => $this->t('-- Select an option --'),
      '#disabled' => 'disabled',
    ];

    $element['city'] = [
      '#type' => 'select',
      '#title' => !empty($this->getFieldSetting('city_lable')) ? $this->getFieldSetting('city_lable') : $this->t('City'),
      '#empty_option' => $this->t('-- Select an option --'),
      '#disabled' => 'disabled',
    ];



    $element['#attached']['library'][] = 'ajax_form_submit_js/loggy';

    return $element;

  }

  public function _ajaxFillState(array $form, FormStateInterface $form_state) {

    //$id_country = '182';

    //dpm('123');


    //$response = new AjaxResponse();
   // $response->addCommand(new HtmlCommand('#country-tid', $id_country));
    //$response->addCommand(new HtmlCommand('#edit-field-dummy-csc-0-state', $id_country));

    //$response->addCommand(new InvokeCommand('.js-form-item-field-dummy-csc-0-state select', 'attr', array('disabled', false )));

    //#edit-field-dummy-csc-0-state

    //$response->addCommand(new InvokeCommand('.field--name-field-city select', 'attr', array('disabled', $field_city_disabled ))); // field-city select активный

  }

  /**
   * Setting the message in our form.
   */
  public function logSomething(array $form, FormStateInterface $form_state) {

    $response = new AjaxResponse();
    $response->addCommand(
      new InvokeCommand(NULL, 'loggy', ['hhhhhhh'])
    );
    return $response;
  }

}
