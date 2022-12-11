<?php

namespace Drupal\api_lemon_pleiade\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure API Pléiade LemonLDAP fields settings.
 */
class PleiadeSSOapiFieldsConfig extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'api_lemon_pleiade.settings';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'api_lemon_pleiade_config_form';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['field_lemon_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Field LemonLDAP url'),
      '#default_value' => $config->get('field_lemon_url'),
      '#description' => $this->t('Enter the auth LemonLDAP endpoint url'),
    ];  

    $form['field_lemon_myapplications_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Field LemonLDAP Myapplications  url'),
      '#default_value' => $config->get('field_lemon_myapplications_url'),
      '#description' => $this->t('Enter  the auth LemonLDAP myapplications endpoint url (usually myapplications)'),
    ];

    $form['field_pastell_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Field Pastell url'),
        '#default_value' => $config->get('field_pastell_url'),
        '#description' => $this->t('Enter the Pastell url'),
    ];  

    $form['field_parapheur_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Field parapheur url'),
        '#default_value' => $config->get('field_parapheur_url'),
        '#description' => $this->t('Enter the base parapheur url'),
    ];

    $form['field_ged_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Field GED url'),
        '#default_value' => $config->get('field_ged_url'),
        '#description' => $this->t('Enter the GED url'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->configFactory->getEditable(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('field_lemon_myapplications_url', $form_state->getValue('field_lemon_myapplications_url'))
      ->set('field_lemon_url', $form_state->getValue('field_lemon_url'))
      ->set('field_pastell_url', $form_state->getValue('field_pastell_url'))
      ->set('field_parapheur_url', $form_state->getValue('field_parapheur_url'))
      ->set('field_ged_url', $form_state->getValue('field_ged_url'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}