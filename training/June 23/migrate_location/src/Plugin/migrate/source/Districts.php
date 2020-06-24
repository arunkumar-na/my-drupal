<?php
namespace Drupal\migrate_location\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for the districts.
 *
 * @MigrateSource(
 *   id = "districts"
 * )
 */
class Districts extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('districts', 'd')
      ->fields('d', ['id', 'name', 'description']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('District ID'),
      'name' => $this->t('District Name'),
      'description' => $this->t('District Description'),
      /* 'states' => $this->t('States'), */
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
        'alias' => 'd',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $states = $this->select('states', 'g')
      ->fields('g', ['id'])
      ->condition('district_id', $row->getSourceProperty('id'))
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('states', $states);
    return parent::prepareRow($row);
  }
}