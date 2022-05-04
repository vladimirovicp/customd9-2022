<?php

namespace  Drupal\dummy_ajax\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Link;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Implementing a ajax form.
 */
class AjaxFormDemo2 extends FormBase{


  public function getFormId(){
    return 'dummyajaxdemo2';
  }

  public function buildForm(array $form, FormStateInterface $form_state){



    $state_options = static::getFirstDropdownOptionOptions();


    if(empty($form_state->getValue('state_dropdown'))){
      $select_option = key($state_options);
    }
    else {
      $select_option = $form_state->getValue('state_dropdown');
    }




    //$country_options = [];

    $country_options = static::getCountryOption();


    $form['country'] = [
      '#type' => 'select',
      '#title' => $this->t('Country'),
      '#empty_option' => $this->t('-- Select an option --'),
      '#options' => $country_options,
    ];

    $form['option_state_fieldset'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Choose State'),
    ];

    $form['option_state_fieldset']['state_dropdown'] = [
      '#type' => 'select',
      '#title' => $this->t('State'),
      '#options' => $state_options,
      '#default_value' => $select_option,
      '#ajax' => [
        'callback' => '::instrumentDropdownCallback',
        'wrapper' => 'state-fieldset-container',
        'event' => 'change',
      ],
    ];


    $form['select_fieldset_container'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'state-fieldset-container'],
    ];

    $form['select_fieldset_container']['select_fieldset'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Choose an one'),
    ];

    $form['select_fieldset_container']['select_fieldset']['select_dropdown'] = [
      '#type' => 'select',
      '#title' => $state_options[$select_option] . '  ' . $this->t('State'),
      '#options' => static ::getSecondDropdownOptions($select_option),
      '#default_value' => !empty($form_state->getValue('select_drobdown')) ? $form_state->getValue('select_dropdown') : 'none',
    ];

    $form['select_fieldset_container']['select_fieldset']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    if($select_option == 'none'){
      $form['select_fieldset_container']['select_fieldset']['select_dropdown']['title'] = $this->t('dfgdfghfg');
      $form['select_fieldset_container']['select_fieldset']['select_dropdown']['#disabled'] = true;
      $form['select_fieldset_container']['select_fieldset']['submit']['#disabled'] = true;
    }


    return $form;
  }

  /**
   * Setting the message in our form.
   */
  public function setMessage(array $form, FormStateInterface $form_state) {

    $response = new AjaxResponse();
    $response->addCommand(
      new HtmlCommand(
        '.result_message',
        '<div class="my_top_message">' . t('The results is @result', ['@result' => ($form_state->getValue('number_1') + $form_state->getValue('number_2'))]) . '</div>'
      )
    );
    return $response;
  }

  public function instrumentDropdownCallback(array $form, FormStateInterface $form_state) {
    return $form['select_fieldset_container'];
  }


  public static function getCountryOption(){

    $module_handler = \Drupal::service('module_handler');
    $module_path = $module_handler->getModule('dummy_ajax')->getPath();

    //$country_options = [];

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


    return  $country_options;
  }


  public static function getFirstDropdownOptionOptions(){
      return[
        'none' => 'none',
        'x' => 'x',
        'y' => 'y',
      ];
  }


  public static function getSecondDropdownOptions($key = ''){
    switch ($key){
      case 'x':
        $options = [
          'Первый 1' => 'Первый 1',
          'Первый 2' => 'Первый 2',
        ];
        break;

      case 'y':
        $options = [
          'Второй 1' => 'Второй 1',
          'Второй 2' => 'Второй 2',
        ];
        break;

      default:
        $options = ['none' => 'none'];
        break;


    }

    return $options;
  }




    /**
   * Submitting the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
