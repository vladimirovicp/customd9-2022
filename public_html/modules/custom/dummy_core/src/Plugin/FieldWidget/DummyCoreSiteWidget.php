<?php

namespace Drupal\dummy_core\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 *
 * @FieldWidget(
 *   id = "dummy_core_site",
 *   label = @Translation("Widget fo City"),
 *   field_types = {
 *     "entity_reference"
 *   },
 * )
 */

class DummyCountryStateCityWidget extends WidgetBase implements ContainerFactoryPluginInterface
{
  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
  {
    $element['target_id'] = [
      '#type' => 'textfield',
      '#title' => 'AddictionTaxonomy',
      '#description' => 'Custom field to be used for alpha-numeric values',
      '#default_value' => isset($items[$delta]->title) ? $items[$delta]->title : NULL,
      '#weight' => 0,
      ];

    return $element;
  }

}
