<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Form\Form;
use Joomla\CMS\Factory;

$form = Form::getInstance("sample", __DIR__ . "/sample_form.xml", array("control" => "myform"));
$prefillData = array("email" => ".@.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	$app   = JFactory::getApplication();
	$data = $app->input->post->get('myform', array(), "array");
	echo "Message was " . $data["message"] . 
		", email was " . $data["email"] . 
		", and telephone was " . $data["telephone"] . "<br>";
	$filteredData = $form->filter($data);
	$result = $form->validate($filteredData);
	if ($result)
	{
		echo "Validation passed ok<br>";
	}
	else
	{
		echo "Validation failed<br>";
		$errors = $form->getErrors();
		foreach ($errors as $error)
		{
			echo $error->getMessage() . "<br>";
		}
		// in the redisplayed form show what the user entered (after data is filtered)
		$prefillData = $filteredData;
	}
}

$form->bind($prefillData);
?>
<form action="<?php echo JRoute::_('index.php?option=com_sample_form1'); ?>"
    method="post" name="sampleForm" id="adminForm" enctype="multipart/form-data">

	<?php echo $form->renderField('message');  ?>
	
	<?php echo $form->renderField('email');  ?>
	
	<?php echo $form->renderField('telephone');  ?>
	
	<button type="submit">Submit</button>
</form>