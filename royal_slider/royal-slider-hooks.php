<?php

/**
 * These hooks were created and used in this site: https://www.compassresorts.com/silver-beach-towers
 * Client wanted to include a youtube video in the third slide of the image carousel.
 * I added 2 hooks to alter the royal slider functionality and insert the youtube info coming from the taxonomy term (additional field).
 * 
 */


/**
* Implements hook_preprocess_HOOK().
* Preprocess variables for the RoyalSlider template.
*/
function vrfusion_site_preprocess_royalslider(&$variables) {
  $taxonomy_term = taxonomy_term_load(arg(2));

  if(empty($taxonomy_term)) {
    return;
  }

  $key_exists = NULL;
  $pagraphs_item_id = drupal_array_get_nested_value($taxonomy_term->field_extra_description, [LANGUAGE_NONE, 0, 'value'], $key_exists);
  
  if (empty($key_exists)) {
    return;
  }
    
  $entities = entity_load('paragraphs_item', [$pagraphs_item_id]);

  if(empty($entities)){
    return;
  }

  foreach ($entities as $entity) {
    $video_url = drupal_array_get_nested_value($entity->field_video_embed, [LANGUAGE_NONE, 0, 'video_url'], $key_exists);
    
    if (empty($key_exists)) {
      continue;
    }
    
    // Get first slide and apply the video url.
    $variables['items_processed'][2]['#item']['video_url'] = $video_url;
    $variables['attributes_array']['class'][] = 'rsVideo';
  }
}

/**
 * Implements hook_preprocess_HOOK().
 * Preprocess variables for the RoyalSlider Item template.
 */
function vrfusion_site_preprocess_royalslider_item(&$variables) {
  // Only implement video on the first slide of royal slider.
  if($variables['id'] === 3) {
    $key_exists = NULL;
    $video_url = drupal_array_get_nested_value($variables, ['item', 'video_url'], $key_exists);

    if (empty($key_exists)) {
      return;
    }

    $video_code = vrfusion_site_get_video_id($video_url);

    if(!$video_code) {
      return;
    }

    $variables['video'] = $video_code;
  }
}

/**
 * Get YouTube or vimeo video ID.
 *
 * @param string $url
 *   Accepts video URLs in following formats:
 *   - youtube.com/watch?v=VIDEO_ID
 *   - youtu.be/VIDEO_ID
 *   - vimeo.com/VIDEO_ID
 *
 * @return string
 *   Video ID or FALSE.
 */
function vrfusion_site_get_video_id($url) {
  if (strstr($url, 'youtube.com/watch?') && preg_match('/v=[^&]*(?=&|$)/', $url, $matches)) {
    $video_id = ltrim($matches[0], 'v=');
  }
  elseif (strstr($url, 'youtu.be/')) {
    $anchor = 'be/';
    $position = strpos($url, $anchor);
    $video_id = trim(substr($url, $position + strlen($anchor)));
  }
  elseif (strstr($url, 'vimeo.com/') && preg_match('([0-9]+)', $url, $matches)) {
    $video_id = $matches[0];
  }

  if (!empty($video_id)) {
    return $video_id;
  }

  return FALSE;
}
