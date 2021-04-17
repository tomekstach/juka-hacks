<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = $this->item->params;
$tpl_params = JFactory::getApplication()->getTemplate(true)->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info = $params->get('info_block_position', 0);
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author'));

// Post Format
$post_attribs = new JRegistry(json_decode($this->item->attribs));
$post_format = $post_attribs->get('post_format', 'standard');
?>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate()) || ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) :
?>
  <div class="system-unpublished">
  <?php endif; ?>
  <?php
  $attribs = json_decode($this->item->attribs);

  $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)); ?>

  <div class="sp-simpleportfolio-overlay-wrapper clearfix">


    <img class="sp-simpleportfolio-img" src="<?php echo $attribs->spfeatured_image; ?>" alt="Gastronomia">

    <div class="sp-simpleportfolio-overlay">
      <div class="sp-vertical-middle">
        <div>
          <div class="sp-simpleportfolio-btns">
            <a class="btn-zoom" href="<?php echo $link; ?>" data-featherlight="image"><i class="fa fa-photo"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="sp-simpleportfolio-info">
    <h3 class="sp-simpleportfolio-title">
      <a href="<?php echo $link; ?>"><?php echo $this->item->title; ?></a>
    </h3>

  </div>

  <?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate()) || ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) :
  ?>
  </div>
<?php endif; ?>

<?php if ($params->get('show_tags') && !empty($this->item->tags->itemTags)) : ?>
  <?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>