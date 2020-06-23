/**
 * This a the code from a function called via ajax to get the specials info from a specific property in this site.
 * https://www.hatterasrealty.com/vacation-rentals
 * When adding the arrival and departure dates, if a property has a special price it will display a pop up with all the content.
 */


// This is the "See All Specials" html code
<button if="{ specials }" onclick="{ quoteSpecialsClicked }" class="all-specials-link">
  See all specials
</button>


// This is the javascript function
(function($, tag) {
  tag.quoteSpecialsClicked = function(e) {
    $(e.target).addClass('pending').prop('disabled', true);
      $.getJSON('/ajax/vrfusion/specials/' + opts.eid)
      .done(function (data) {
        RiotTagsModal.show($(data.content), 'medium');
      })
      .always(function() {
        $(e.target).removeClass('pending').prop('disabled', false);
      });
  };
})(jQuery, this);

<?php

/**
 * Implements hook_menu().
 */
function vrfusion_site_menu() {
  $menu['ajax/vrfusion/specials'] = [
    'title' => 'Get all specials by item',
    'type' => MENU_CALLBACK,
    'page callback' => 'vrfusion_site_get_specials_by_eid',
    'access callback' => TRUE, // allows access to any user
  ];

  return $menu;
}

/**
 * Theme callback; returns the rendered markup for the specials_teaser_popup.
 * This function loads a view programatically and returns the result as json code.
 *
 * @see vrweb_specials_theme()
 */
function vrfusion_site_get_specials_by_eid($eid) {
  $result = '';
  
  // Get specials view info.
  if ($specials = _btm_specials_get_valid_specials(NULL, $eid)) {
    $nids = implode('+', array_keys($specials));
    $result = views_embed_view('specials_popup', 'block', $nids);
  }

  // Get rate overrides view info.
  $result .= views_embed_view('rate_overrides', 'block_rate_overrides', $eid);

  if(!empty($result)) {
    drupal_json_output(array('status' => 1, 'content' => $result));
    return;
  } 
  else {
    drupal_json_output(array('status' => 1, 'content' => '<h4>No specials available for this property.</h4>'));
  }
}
