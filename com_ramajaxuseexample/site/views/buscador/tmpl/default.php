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
?>

<form action="index.php?option=com_ramajaxuseexample&view=buscador" method="post" id="adminForm" name="adminForm">
    <hr>
    <h1><?php echo JText::_('RAMAJAX_SEARCH') ?></h1>
    <button  id="filter_clear" class="btn waves-effect waves-light red"  type="Button"> <?php echo JText::_('RAMAJAX_BUTTON_RESET') ?> </button>
    <input type="submit" value="<?php echo JText::_('RAMAJAX_BUTTON_SUBMIT') ?>">
    <?php 
        echo $this->filterForm->renderField('league', 'filter'); 
        echo $this->filterForm->renderField('team', 'filter'); 
        echo $this->filterForm->renderField('player', 'filter'); 
        echo $this->filterForm->renderField('player_country', 'filter'); 
    ?>
    <hr>
    <h1><?php echo JText::_('RAMAJAX_RESULTS') ?></h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="10%">
                <?php echo JText::_('LEAGUE') ;?>
            </th>
            <th width="20%">
                <?php echo JText::_('COM_RAMAJAXUSEEXAMPLE_TEAM') ;?>
            </th>
            <th width="20%">
                <?php echo JText::_('PLAYER') ;?>
            </th>
            <th width="20%">
                <?php echo JText::_('PLAYER_COUNTRY') ;?>
            </th>
            <th width="10%">
                <?php echo JText::_('PLAYER_STATE') ;?>
            </th>
            <th width="20%">
                <?php echo JText::_('PLAYER_CITY') ;?>
            </th>
            <th width="10%">
                <?php echo JText::_('WAGE') ;?>
            </th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="5">
                    <?php echo $this->pagination->getListFooter(); ?>
                    <?php echo $this->filterForm->renderField('limit', 'list');  ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $row) : ?>

                    <tr>
                        <td>
                            <?php echo JText::_($row->league); ?>
                        </td>
                        <td>
                            <?php echo JText::_($row->team); ?>
                        </td>
                        <td>
                            <?php echo $row->player; ?>
                        </td>
                        <td>
                            <?php echo JText::_($row->player_country); ?>
                        </td>
                        <td>
                            <?php echo JText::_($row->player_state); ?>
                        </td>
                        <td>
                            <?php echo JText::_($row->player_city); ?>
                        </td>
                        <td>
                            <?php echo $row->wage; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <input type="hidden" name="langTag" id="langTag" value="<?php echo $this->langTag; ?>" />
    <input type="hidden" name="task" />
	<?php echo JHtml::_('form.token'); ?>
</form>