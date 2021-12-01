# JoomlaBasicExtensions

[API Guides](https://docs.joomla.org/API_Guides)

This is a series of Joomla 3 little examples of Joomla 3 extensions

## Form examples

### com_sample_form1
More info: [Joomla Documentation: Basic form guide](https://docs.joomla.org/Basic_form_guide)

Install and go to `yoursite/index.php?option=com_sample_form1`

### com_sample_form2
More info: [Joomla Documentation: Basic form guide](https://docs.joomla.org/Basic_form_guide)

Install and go to `yoursite/index.php?option=com_sample_form2&view=form&layout=edit`

### com_buscador_site

#### Search and filter for custom component in front end
This is a little example of how to use Joomla 3 capabilites 
for searching and filtering in the front end.

Install and go to `yoursite/index.php?option=com_buscador_site&view=buscador`

#### Use Ajax for multiple dynamic select
It includes an example of using Ajax to fill a multiple dynamic select 
for one of the select filters (specialty) depending on what you selected in another (profession).

The files involved in the Ajax feature are:
* Controller:       `site/controllers/ajax.json.php`
* Model:            `site/models/ajax.php`
* Javascript:       `site/views/buscador/ajaxSpecialties.js`
* View:             `site/views/buscador/view.html.php`
    * Add `$this->setDocument();` to the end of `display()`
    * Add Javascript to the view: `function setDocument()`



You can see the ajax response going to:
`yoursite/index.php?option=com_buscador_site&task=ajax.specialties&format=json&profession=fontaneria`


