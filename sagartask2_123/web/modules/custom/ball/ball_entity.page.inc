<?php

/**
 * @file
 * Contains ball_entity.page.inc.
 *
 * Page callback for Ball entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Ball entity templates.
 *
 * Default template: ball_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_ball_entity(array &$variables) {
  // Fetch BallEntity Entity Object.
  $ball_entity = $variables['elements']['#ball_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
