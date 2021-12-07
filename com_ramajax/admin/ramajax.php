Write some help...

<header> Check if componente com_ramajax is working:</header>
<p>Access the folowing URL:</p>
http://joomla_clasificados/index.php?option=com_ramajax&task=ajax.getSlaveValues&format=json&masterFieldName=league&slaveFieldName=team&league=NBA

You should see this message:

{"success":true,"message":null,"messages":null,"data":["Phoenix Suns","Los Angeles Lakers","Golden State Warriors"]}


How to improve this component:

1. Instead of hardconding the tables inside the model, use a bd.
2. Create a form to enter the combo specifications