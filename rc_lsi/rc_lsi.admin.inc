<?php
/**
 * Form callback; returns the RC LSI Configuration settings form.
 *
 * @see rc_lsi_menu()
 */
function rc_lsi_form_settings($form, &$form_state) {
  $form['rc_lsi_client_key'] = [
    '#type' => 'textfield',
    '#title' => t('LSI Client KEY'),
    '#description' => t('Client key to be used in the url of the lsi file.'),
    '#default_value' => variable_get('rc_lsi_client_key', NULL),
  ];

  $form['rc_lsi_user_key'] = [
    '#type' => 'textfield',
    '#title' => t('LSI User Key'),
    '#description' => t('User key to be used in the url of the lsi file.'),
    '#default_value' => variable_get('rc_lsi_user_key', NULL),
  ];

  $form['rc_lsi_more_configs'] = [
    '#type' => 'markup',
    '#markup' => '<p>For additional configurations. Please go <a target="_blank" href="/admin/rescms/engines/manage/1/reviews">here.</a></p>'
  ];

  drupal_set_title('LSI Reviews Settings');

  return system_settings_form($form);
}
