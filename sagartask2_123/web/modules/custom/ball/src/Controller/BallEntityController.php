<?php

namespace Drupal\ball\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\ball\Entity\BallEntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityViewBuilder;

/**
 * Class BallEntityController.
 *
 *  Returns responses for Ball entity routes.
 */

class BallEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->dateFormatter = $container->get('date.formatter');
    $instance->renderer = $container->get('renderer');
    return $instance;
  }

  /**
   * Displays a Ball entity revision.
   *
   * @param int $ball_entity_revision
   *   The Ball entity revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($ball_entity_revision) {
    $ball_entity = $this->entityTypeManager()->getStorage('ball_entity')
      ->loadRevision($ball_entity_revision);
    $view_builder = $this->entityTypeManager()->getViewBuilder('ball_entity');

    return $view_builder->view($ball_entity);
  }

  /**
   * Page title callback for a Ball entity revision.
   *
   * @param int $ball_entity_revision
   *   The Ball entity revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($ball_entity_revision) {
    $ball_entity = $this->entityTypeManager()->getStorage('ball_entity')
      ->loadRevision($ball_entity_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $ball_entity->label(),
      '%date' => $this->dateFormatter->format($ball_entity->getRevisionCreationTime()),
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Ball entity.
   *
   * @param \Drupal\ball\Entity\BallEntityInterface $ball_entity
   *   A Ball entity object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(BallEntityInterface $ball_entity) {
    $account = $this->currentUser();
    $ball_entity_storage = $this->entityTypeManager()->getStorage('ball_entity');

    $langcode = $ball_entity->language()->getId();
    $langname = $ball_entity->language()->getName();
    $languages = $ball_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $ball_entity->label()]) : $this->t('Revisions for %title', ['%title' => $ball_entity->label()]);

    $header = [$this->t('Revision'), $this->t('Operations')];
    $revert_permission = (($account->hasPermission("revert all ball entity revisions") || $account->hasPermission('administer ball entity entities')));
    $delete_permission = (($account->hasPermission("delete all ball entity revisions") || $account->hasPermission('administer ball entity entities')));

    $rows = [];

    $vids = $ball_entity_storage->revisionIds($ball_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\ball\Entity\BallEntityInterface $revision */
      $revision = $ball_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = $this->dateFormatter->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $ball_entity->getRevisionId()) {
          $link = Link::fromTextAndUrl($date, new Url('entity.ball_entity.revision', [
            'ball_entity' => $ball_entity->id(),
            'ball_entity_revision' => $vid,
          ]))->toString();
        }
        else {
          $link = $ball_entity->toLink($date)->toString();
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => $this->renderer->renderPlain($username),
              'message' => [
                '#markup' => $revision->getRevisionLogMessage(),
                '#allowed_tags' => Xss::getHtmlTagList(),
              ],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.ball_entity.translation_revert', [
                'ball_entity' => $ball_entity->id(),
                'ball_entity_revision' => $vid,
                'langcode' => $langcode,
              ]) :
              Url::fromRoute('entity.ball_entity.revision_revert', [
                'ball_entity' => $ball_entity->id(),
                'ball_entity_revision' => $vid,
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.ball_entity.revision_delete', [
                'ball_entity' => $ball_entity->id(),
                'ball_entity_revision' => $vid,
              ]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['ball_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

  

}
