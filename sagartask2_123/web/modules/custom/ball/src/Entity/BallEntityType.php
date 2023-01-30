<?php

namespace Drupal\ball\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Ball entity type entity.
 *
 * @ConfigEntityType(
 *   id = "ball_entity_type",
 *   label = @Translation("Ball entity type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ball\BallEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ball\Form\BallEntityTypeForm",
 *       "edit" = "Drupal\ball\Form\BallEntityTypeForm",
 *       "delete" = "Drupal\ball\Form\BallEntityTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ball\BallEntityTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_export = {
 *     "id",
 *     "label"
 *   },
 *   config_prefix = "ball_entity_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "ball_entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/ball_entity_type/{ball_entity_type}",
 *     "add-form" = "/admin/structure/ball_entity_type/add",
 *     "edit-form" = "/admin/structure/ball_entity_type/{ball_entity_type}/edit",
 *     "delete-form" = "/admin/structure/ball_entity_type/{ball_entity_type}/delete",
 *     "collection" = "/admin/structure/ball_entity_type"
 *   }
 * )
 */
class BallEntityType extends ConfigEntityBundleBase implements BallEntityTypeInterface {

  /**
   * The Ball entity type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Ball entity type label.
   *
   * @var string
   */
  protected $label;

}
