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
    <button  id="filter_clear" class="btn waves-effect waves-light red"  type="Button"> Reset </button>
    <input type="submit" value="Submit">
    <?php 
        echo $this->filterForm->renderField('league', 'filter'); 
        echo $this->filterForm->renderField('team', 'filter'); 
        echo $this->filterForm->renderField('player', 'filter'); 
    ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="30%">
                <?php echo JText::_('LEAGUE') ;?>
            </th>
            <th width="30%">
                <?php echo JText::_('TEAM') ;?>
            </th>
            <th width="30%">
                <?php echo JText::_('PLAYER') ;?>
            </th>
            <th width="10%">
                <?php echo JText::_('WAGE') ;?>
            </th>
        </tr>
        </thead>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $row) : ?>

                    <tr>
                        <td>
                            <?php echo $row->league; ?>
                        </td>
                        <td>
                            <?php echo $row->team; ?>
                        </td>
                        <td>
                            <?php echo $row->player; ?>
                        </td>
                        <td>
                            <?php echo $row->wage; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <input type="hidden" name="task" />
	<?php echo JHtml::_('form.token'); ?>
</form>