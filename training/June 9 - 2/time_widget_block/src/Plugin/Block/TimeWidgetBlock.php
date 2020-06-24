<?php

namespace Drupal\time_widget_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'ShowTimeWidgetBlock' block.
 *
 * @Block(
 *  id = "time_widget_block",
 *  admin_label = @Translation("Time widget"),
 * )
 */

class TimeWidgetBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#description' => $this->t('To add message'),
      '#default_value' => $this->t('Time widget Sidebar'),
      '#weight' => '0',
    ];
   /*  $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#default_value' => $this->t('Time widget developed by Arun'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ]; */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['message'] = $form_state->getValue('message');/* 
    $this->configuration['name'] = $form_state->getValue('name'); */
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'time_widget_block';
    $build['#content'][] = $this->configuration['message'];/* 
    $build['#content'][] = $this->configuration['name']; */
    return $build;
  }

}
