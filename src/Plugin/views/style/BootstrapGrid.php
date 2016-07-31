<?php
/**
 * @file
 * Contains \Drupal\bootstrap_grid\Plugin\views\style\BootstrapGrid.
 */
namespace Drupal\bootstrap_grid\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render each item into owl carousel.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "bootstrapGrid",
 *   title = @Translation("Bootstrap Grid"),
 *   help = @Translation("Responsive Bootstrap Grid."),
 *   theme = "bootstrap_grid_views",
 *   display_types = {"normal"}
 * )
 */
class BootstrapGrid extends StylePluginBase {
  /**
   * Does the style plugin allows to use style plugins.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;
  /**
   * Does the style plugin support custom css class for the rows.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * Set default options
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['sm'] = array('default' => 6);
    $options['md'] = array('default' => 4);
    $options['lg'] = array('default' => 4);

    return $options;
  }

  function getTitle($size) {
    if (!is_numeric($size)) {
      return t('None');
    }
    return t("@size items per row", array('@size' => 12 / $size));
  }

  function buildSelectList() {
    $options = array(
      '' => t('None'),
      12 => $this->getTitle(12),
      6 => $this->getTitle(6),
      4 => $this->getTitle(4),
      3 => $this->getTitle(3),
      2 => $this->getTitle(2),
    );

    return $options;
  }

  /**
   * Render the given style.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['sm'] = array(
      '#title' => t("Small devices"),
      '#type' => 'select',
      '#options' => $this->buildSelectList(),
      '#default_value' => $this->options['sm'],
    );

    $form['md'] = array(
      '#title' => t("Medium devices"),
      '#type' => 'select',
      '#options' => $this->buildSelectList(),
      '#default_value' => $this->options['md'],
    );

    $form['lg'] = array(
      '#title' => t("Large devices"),
      '#type' => 'select',
      '#options' => $this->buildSelectList(),
      '#default_value' => $this->options['lg'],
    );

  }
}