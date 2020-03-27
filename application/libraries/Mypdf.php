<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


require_once('assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

class Mypdf {

	protected $ci;

	public function __construct(){
		$this->ci =& get_instance();		
	}

	public function generate($html ,$filename,$orientation, $paper = 'A4'){

		$dompdf = new Dompdf();
		// $html = $this->ci->load->view($view, $data, TRUE);
		$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
		$dompdf->setPaper($paper, $orientation);

// Render the HTML as PDF
		$dompdf->render();
		ob_clean();

// Output the generated PDF to Browser
		$dompdf->stream($filename . ".pdf",array("Attachment" => 0));

		// return $dompdf->stream($filename . ".pdf");
	}
}

/* End of file Mypdf.php */
/* Location: ./system/application/libraries/Mypdf.php */