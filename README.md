# JoomlaBasicExtensions

This is a series of Joomla 3 little examples of Joomla 3 extensions

## Documentation

* General
    * [Joomla Doc: Documentation](https://developer.joomla.org/cms/documentation.html)

* API 
    * [Joomla Doc: API Guides](https://docs.joomla.org/API_Guides)

* Forms
    * [Joomla Doc: Basic form guide](https://docs.joomla.org/Basic_form_guide)
    * [Joomla Doc: Advanced form guide](https://docs.joomla.org/Advanced_form_guide)
    * [Joomla Doc: Developing an MVC Component/Adding a front-end form](https://docs.joomla.org/J3.x:Developing_an_MVC_Component/Adding_a_front-end_form)
    * [Joomla Doc: Campo de Formulario, Tipo sql](https://docs.joomla.org/SQL_form_field_type)
    * [Wikipedia: Cross-site request forgery](https://en.wikipedia.org/wiki/Cross-site_request_forgery)
    * [Wikipedia: Post/Redirect/Get](https://en.wikipedia.org/wiki/Post/Redirect/Get)

* Database
    * [Joomla Doc: Selecting data using JDatabase](https://docs.joomla.org/Selecting_data_using_JDatabase)

## Form examples

### com_sample_form1
More info: 
    * [Joomla Doc: Basic form guide](https://docs.joomla.org/Basic_form_guide)

Install and go to `yoursite/index.php?option=com_sample_form1`

### com_sample_form2
More info: 
    * [Joomla Doc: Basic form guide](https://docs.joomla.org/Basic_form_guide)

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
* Fields:           `site/models/fields/specialty.php`
* Javascript:       `site/views/buscador/buscador.js`
* View:             `site/views/buscador/view.html.php`
    * Add `$this->setDocument();` to the end of `display()`
    * Add Javascript to the view: `function setDocument()`

You can see the ajax response going to:
`yoursite/index.php?option=com_buscador_site&task=ajax.specialties&format=json&profession=fontaneria`


