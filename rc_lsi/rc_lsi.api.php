<?php
/**
 * @file
 * Explains all hook offered by module.
 */

/**
 * Opens the chance to update all reviews data as obtained from source.
 *
 * Generally used to alter the number of reviews to process or to perform global
 * fixes in all raw data as coming.
 *
 * @param array $reviews, list of all reviews data as coming from source.
 * @param LDRCLodgingProduct $item, object that represents a property as currently analyzed.
 * @return void
 */
function hook_rc_lsi_reviews_source_alter(&$reviews, $item) {
  // Alter $reviews array...
}

/**
 * Opens the chance to update a specific review after data processed.
 *
 * Generally used to alter a given review at a given time
 *
 * @param array $review_processed, review data after base process on original review info.
 * @param array $review_source, original review data as obtained from source
 * @param LDRCLodgingProduct $item, object that represents a property as currently analyzed.
 * @return void
 */
function hook_rc_lsi_review_alter(&$review_processed, $review_source, $item) {
  // Alter $reviews array...
}
