<?php

require_once ('class/QALabel.php');
require_once ('class/LabelService.php');

if (isset($_GET['showlabel']))
{
	$s = new LabelService();
	$s->showLabelVisual();
	
}

if (isset ($_GET['componentlabel'])) 
{
	$s = new LabelService();
	$s->displayComponentLabel( $_GET['componentlabel'], $_GET['category']);
}

