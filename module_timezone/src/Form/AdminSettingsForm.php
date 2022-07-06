<?php

namespace Drupal\module_timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AdminSettingsForm implements admin configuration form.
 */
class AdminSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'module_timezone.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admin_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('module_timezone.settings');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
      '#size' => 60,
      '#maxlength' => 128,
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CIty'),
      '#default_value' => $config->get('city'),
      '#size' => 60,
      '#maxlength' => 128,
    ];
    $form['time_zone'] = [
      '#type' => 'select',
      '#title' => $this->t('Select TimeZone'),
      '#options' => [
        'America/Chicago' => t('America/Chicago'),
        'America/New_York' => t('America/New_York'),
        'Asia/Tokyo' => t('Asia/Tokyo'),
        'Asia/Dubai' => t('Asia/Dubai'),
        'Asia/Kolkata' => t('Asia/Kolkata'),
        'Europe/Amsterdam' => t('Europe/Amsterdam'),
        'Europe/Oslo' => t('Europe/Oslo'),
        'Europe/London' => t('Europe/London'),
      ],
      '#default_value' => $config->get('time_zone'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('module_timezone.settings')
      ->set('city', $form_state->getValue('city'))
      ->set('time_zone', $form_state->getValue('time_zone'))
      ->set('country', $form_state->getValue('country'))
      ->save();
  }

}
