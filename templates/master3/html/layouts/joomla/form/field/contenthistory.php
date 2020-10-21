<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\CMS\HTML\HTMLHelper;
/**
 * Layout variables
 * ---------------------
 * @var  string   $item The item id number
 * @var  string   $link The link text
 * @var  string   $label The label text
 */
extract($displayData);

HTMLHelper::_('behavior.modal', 'button.modal_' . $item);
?>
<button class="uk-button modal_<?php echo $item; ?>" title="<?php echo $label; ?>" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 800, y: 500}}">
    <span class="uk-margin-small-right" data-uk-icon="icon:database" aria-hidden="true"></span><?php echo $label; ?>
</button>
