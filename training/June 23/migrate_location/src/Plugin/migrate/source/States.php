<?php

namespace Drupal\migrate_location\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for the states.
 *
 * @MigrateSource(
 *   id = "states"
 * )
 */
class States extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('states', 'g')
      ->fields('g', ['id', 'district_id', 'name']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('State ID'),
      'district_id' => $this->t('District ID'),
      'name' => $this->t('State name'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'g',
      ],
    ];
  }
}