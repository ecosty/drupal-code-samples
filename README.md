# drupal-code-samples
Some drupal code samples from different sites. All of these samples have been developed in Drupal 7.

Folder "call_specials_by_ajax" has some specific code used in this site:
https://www.hatterasrealty.com/vacation-rentals
When adding the arrival and departure dates, if a property has a special price it will display a pop up with all the content.

Folder rc_lsi is a submodule used to import reviews from an external source (lsi) that comes in XML format.
This module gets the external information and validates if there are new changes in the xml file, if so it loads the file from
the external source. Otherwise it uses the information stored in a cache variable. This code is used in greybeardrentals.com
For example: https://www.greybeardrentals.com/vacation-rentals/bear-tracks inside the reviews section

Folder royal_slider has some functions that alter the royal slider carousel in a taxonomy term in order to include a youtube
video in the third slide if available. This is used in compassresorts. For instace: https://www.compassresorts.com/silver-beach-towers
