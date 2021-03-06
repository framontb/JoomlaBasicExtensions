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


<form action="index.php?option=com_buscador_site&view=buscador" method="post" id="adminForm" name="adminForm">
    <button  id="filter_clear" class="btn waves-effect waves-light red"  type="Button"> Reset </button>
    <input type="submit" value="Submit">
    <?php 
        // Search and filter tools
        // Load search tools
        //echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));

        // Manually render filter form fields in layout
        // https://joomla.stackexchange.com/questions/23516/manually-render-filter-form-fields-in-layout
        //echo $this->filterForm->renderField('published', 'filter'); 
        echo $this->filterForm->renderField('search', 'filter'); 
        echo $this->filterForm->renderField('profession', 'filter'); 
        echo $this->filterForm->renderField('specialty', 'filter'); 
        echo $this->filterForm->renderField('limit', 'list'); 
    ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="1%"><?php echo JText::_('NUM'); ?></th>
            <th width="2%">
                <?php echo JHtml::_('grid.checkall'); ?>
            </th>
            <th width="20%">
                <?php echo JText::_('NAME') ;?>
            </th>
            <th width="20%">
                <?php echo JText::_('PROFESSION') ;?>
            </th>
            <th width="20%">
                <?php echo JText::_('SPECIALTY') ;?>
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
                            <?php echo $row->name; ?>
                        </td>
                        <td>
                            <?php echo $row->profession; ?>
                        </td>
                        <td>
                            <?php echo $row->specialty; ?>
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
    <input type="hidden" name="task" />
	<?php echo JHtml::_('form.token'); ?>
</form>