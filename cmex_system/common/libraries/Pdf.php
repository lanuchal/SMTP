<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF//TCPDF
{ 
    //public $fpdi;
    function __construct() 
    { 
        parent::__construct(); 
        //$fpdi = new FPDI();
    }
    
    /*
    public function mergeFile($filename){
        $this.setSourceFile($filename);
        $this.useTemplate($this->importPage(1));
    }
    */
    
    public function Header() {
        // Logo
        $image_file = base_url('../../common/assets/images/logo_cmex.png');//K_PATH_IMAGES.'logo_example.jpg';
        //Image( $file, $x = '', $y = '', $w = 0, $h = 0, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false, $alt = false, $altimgs = array() )
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        //echo base_url('assets/fonts/THSarabun.ttf') . "<br>";
        $fontname = TCPDF_FONTS::addTTFfont(base_url('assets/fonts/thai/THSarabun.ttf'), 'TrueTypeUnicode', '', 96);

        // use the font
        //$this->SetFont("$fontname", 'B', 20, '', false);
        $this->SetFont("thsarabunpsk", 'B', 20, '', false);

        //$this->SetFont('courier', 'B', 20);
        // Title
        $this->Cell(0, 15, 'ศูนย์ความเป็นเลิศทางการแพทย์ คณะแพทยศาสตร์ มหาวิทยาลัยเชียงใหม่', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 15, 'ใบสมัครงาน', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        
        //$this->SetFont('helvetica', 'I', 8);
        $this->SetFont("thsarabunpsk", 'B', 20, '', false);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
/*Author:Tutsway.com */
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */