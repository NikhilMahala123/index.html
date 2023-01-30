<?php

namespace Drupal\ball;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\ball\Entity\BallEntityInterface;

/**
 * Defines the storage handler class for Ball entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Ball entity entities.
 *
 * @ingroup ball
 */
interface BallEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Ball entity revision IDs for a specific Ball entity.
   *
   * @param \Drupal\ball\Entity\BallEntityInterface $entity
   *   The Ball entity entity.
   *
   * @return int[]
   *   Ball entity revision IDs (in ascending order).
   */
  public function revisionIds(BallEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Ball entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Ball entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\ball\Entity\BallEntityInterface $entity
   *   The Ball entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(BallEntityInterface $entity);

  /**
   * Unsets the language for all Ball entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
