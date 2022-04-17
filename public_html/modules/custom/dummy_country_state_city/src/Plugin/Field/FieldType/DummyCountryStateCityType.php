<?php

namespace Drupal\dummy_country_state_city\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'country_state_city_type' field type.
 *
 * @FieldType(
 *   id = "dummy_country_state_city_type",
 *   label = @Translation("Dummy Country state city type"),
 *   description = @Translation("Dummy Country ,state and city plugin"),
 *   default_widget = "dummy_country_state_city_widget",
 *
 * )
 */


class DummyCountryStateCityType extends FieldItemBase {

  /**
   * {@inheritdoc}
   *
   * Объявляем поля для таблицы где будут храниться значения нашего поля. Нам
   * хватит одного значения value типа text и размером tiny.
   *
   * @see https://www.drupal.org/node/159605
   */

  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => [
        'country' => [
          'type' => 'varchar',
          'length' => 255,
        ],
      ]
    );


  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['country'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Country'));

    return $properties;
  }

}
