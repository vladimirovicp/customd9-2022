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
