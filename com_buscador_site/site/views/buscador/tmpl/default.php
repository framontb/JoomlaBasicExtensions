<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>

<form action="index.php?option=com_buscador_site&view=buscador" method="post" id="adminForm" name="adminForm">
    <div class="btn-wrapper input-append">
        <input type="text" name="filter[search]" id="filter_search" value="" class="js-stools-search-string" placeholder="Search">
        <button type="submit" class="btn hasTooltip" title="" aria-label="Search" data-original-title="Search">
            <span class="icon-search" aria-hidden="true"></span>
        </button>
    </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="1%"><?php echo JText::_('NUM'); ?></th>
            <th width="2%">
                <?php echo JHtml::_('grid.checkall'); ?>
            </th>
            <th width="60%">
                <?php echo JText::_('NAME') ;?>
            </th>
            <th width="5%">
                <?php echo JText::_('PUBLISHED'); ?>
            </th>
            <th width="2%">
                <?php echo JText::_('ID'); ?>
            </th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="5">
                    <p>Footer</p>
                    <?php echo $this->pagination->getListFooter(); ?>
                    <?php echo $this->pagination->getLimitBox(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $row) : ?>

                    <tr>
                        <td>
                            <?php echo $this->pagination->getRowOffset($i); ?>
                        </td>
                        <td>
                            <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                        </td>
                        <td>
                            <?php echo $row->greeting; ?>
                        </td>
                        <td align="center">
                            <?php echo JHtml::_('jgrid.published', $row->published, $i, 'buscador.', true, 'cb'); ?>
                        </td>
                        <td align="center">
                            <?php echo $row->id; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</form>