<?php

namespace Drupal\ball\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Ball entity entities.
 *
 * @ingroup ball
 */
interface BallEntityInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Ball entity name.
   *
   * @return string
   *   Name of the Ball entity.
   */
  public function getName();

  /**
   * Sets the Ball entity name.
   *
   * @param string $name
   *   The Ball entity name.
   *
   * @return \Drupal\ball\Entity\BallEntityInterface
   *   The called Ball entity entity.
   */
  public function setName($name);

  /**
   * Gets the Ball entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Ball entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Ball entity creation timestamp.
   *
   * @param int $timestamp
   *   The Ball entity creation timestamp.
   *
   * @return \Drupal\ball\Entity\BallEntityInterface
   *   The called Ball entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Ball entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Ball entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\ball\Entity\BallEntityInterface
   *   The called Ball entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Ball entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Ball entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\ball\Entity\BallEntityInterface
   *   The called Ball entity entity.
   */
  public function setRevisionUserId($uid);

}
