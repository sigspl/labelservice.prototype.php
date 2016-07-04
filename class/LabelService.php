<?php

class LabelService

{
	
	public function showLabelVisual()
	{
			$default_height=16;
			$default_width=32;

			$label = new QALabel();
			$label->setHeight($default_height);
			$label->setWidth($default_width);


			if (!isset($_GET['showlabel']))
				$param = "unknown";
			else
				$param =$_GET['showlabel'];

			$label->setLabel($param);
			$label->sendImage();

		
	}
	
	public function displayComponentLabel($component, $category)
	{
		// load data
		
		$label = new QALabel();
		$default_height=16;
		$default_width=32;
		$label->setHeight($default_height);
		$label->setWidth($default_width);
		$label->setLabel('unknown');
		$label->sendImage();
		
		
		// calculate data for category
		
		// display resulting data
	}
	
}