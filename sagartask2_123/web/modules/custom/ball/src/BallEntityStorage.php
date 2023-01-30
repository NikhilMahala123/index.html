<?php

namespace Drupal\ball;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
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
class BallEntityStorage extends SqlContentEntityStorage implements BallEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(BallEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {ball_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {ball_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(BallEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {ball_entity_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('ball_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
