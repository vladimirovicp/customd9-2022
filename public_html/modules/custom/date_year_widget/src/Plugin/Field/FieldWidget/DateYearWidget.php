<?php

namespace Drupal\date_year_widget\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\datetime\Plugin\Field\FieldWidget\DateTimeWidgetBase;

/**
 * Plugin implementation of the 'date_year_widget' widget.
 *
 * @FieldWidget(
 *   id = "date_year_widget",
 *   module = "date_year_widget",
 *   label = @Translation("Date year widget"),
 *   field_types = {
 *     "datetime"
 *   }
 * )
 */
class DateYearWidget extends DateTimeWidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {

//    dpm('defaultSettings');
//    dpm(  parent::defaultSettings());
    return [
        'date_order' => 'Y',
      ] + parent::defaultSettings();
	//return [
        //'date_order' => 'YD',
     // ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);

    // Wrap all of the select elements with a fieldset.
    $element['#theme_wrappers'][] = 'fieldset';

//    $date_order = $this->getSetting('date_order');

//    dpm('formElement');


    $date_part_order = ['year'];

//    switch ($date_order) {
//      default:
//      case 'Y':
//        $date_part_order = ['year'];
//        break;
//
//      case 'MY':
//        $date_part_order = ['month', 'year'];
//        break;
//
//    }

//    dpm($date_part_order);
//    dpm($element['value']);

    $element['value'] = [
        '#type' => 'datelist',
        '#date_part_order' => $date_part_order,
      ] + $element['value'];

//    dpm($element['value']);

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element = parent::settingsForm($form, $form_state);

    dpm('settingsForm');

    $element['date_order'] = [
      '#type' => 'select',
      '#title' => t('Date part order'),
      '#default_value' => $this->getSetting('date_order'),
//      '#options' => ['MY' => t('Month/Year'), 'Y' => t('Year')],
      '#options' => ['Y' => t('Year')],
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

//    dpm($this->getSetting('date_order'));

    $summary[] = t('Date part order: @order', ['@order' => $this->getSetting('date_order')]);

    return $summary;
  }

}
