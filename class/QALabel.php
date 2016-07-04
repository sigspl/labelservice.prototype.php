<?php

/**

	Generates visual representation of a software quality label (no logic, only encoded geometry and standard colors as in the EU energy labels)

*/
class QALabel
{

	private $labels = array();
	private $image;
	private $fillcolor;
	private $text='?';
	private $text_color;
	
	private $width=40;
	private $height=16;
	private $left_margin=12;
	private $internal_font_id=4;
	
	
	public function __construct()
	{
		
		// source: https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/EC_tyre_label_CA.svg/2000px-EC_tyre_label_CA.svg.png
		
		$this->labels["A"] =array(0, 144, 54); // green
		$this->labels["B"] =array(87, 171, 39); // green
		$this->labels["C"] =array(201,210,0); // lime
		$this->labels["D"] =array(255,237,0); // yellow
		$this->labels["E"] =array(250,187,0); // orange yellow
		$this->labels["F"] =array(235,105,11); // orange
		$this->labels["G"] =array(226,0,26); // red
		$this->labels["unknown"] =array(160, 160, 160); // gray
		
		
		
	}

		/**
			Draw the label geometry (polygon) with label text and set matching label background color
		*/
		public function setLabel($label)
		{
			$labels = $this->labels;
			$this->image = imagecreatetruecolor($this->width, $this->height);
			$this->text_color = imagecolorallocate( $this->image, 255, 255, 255 ); // white label text
			
			$this->setTransparency();
			
		
			
			if ($label=='A' || $label=='B' || $label=='C' || $label=='D' || $label=='E' || $label=='F' || $label=='G')
			{
				$this->fillcolor = imagecolorallocate( $this->image, $labels[$label][0], $labels[$label][1], $labels[$label][2] );
				$this->text= $label;
			}
			else
			{
				$label = "unknown";
				$this->fillcolor = imagecolorallocate( $this->image, $labels[$label][0], $labels[$label][1], $labels[$label][2] );
			}
	
			$h = $this->height;
			$w = $this->width;
			imagefilledpolygon($this->image, array(
				0,   $h/2,
				$h/2, 0,
				$w, 0,
				$w, $h,
				$h/2, $h
				
			),
			5, // number of points in label polygon
			$this->fillcolor);

			imagestring( $this->image, $this->internal_font_id, $this->left_margin, 0, $this->text, $this->text_color );	
	
		}
		
		/** Output the label image to the browser with proper header
		*/
		public function sendImage()
		{
			header('Content-type: image/png');
			
			imagepng($this->image);
			imagedestroy($this->image);
			
		}
		
		
		public function setWidth($w)
		{
			$this->width = $w;
		}
		
		public function setHeight($h)
		{
			$this->height=$h;
		}
		
		
		public function setTransparency()
		{
			$color = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
			imagefill($this->image, 0, 0, $color);
			imagesavealpha($this->image, TRUE); // it took me a good 10 minutes to figure this part out
		}
		
		
}
