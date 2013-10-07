<?php
    /*
	* Subject                  : Export pdf using mpdf
	* Author                   : Eddy
	* @Created Date    			: 17-07-2013
	* Version                  : CodeIgniter
	* @Warning             		: Any change in this file may cause abnormal behaviour of application.
	*
	*/
	
	if ( ! function_exists('exportMeAsMPDF'))
	{
	    function exportMeAsMPDF($htmView,$fileName) {
	
            $CI =& get_instance();
            $CI->load->library('mpdf');
           // $CI->mpdf=new mPDF('c','A4','','',32,25,27,25,16,13);
            $CI->mpdf->AliasNbPages('[pagetotal]');
            $CI->mpdf->SetHTMLHeader('{PAGENO}/{nb}', '1',true);
            $CI->mpdf->SetDisplayMode('fullpage');
            $CI->mpdf->pagenumPrefix = 'Page number ';
            $CI->mpdf->pagenumSuffix = ' - ';
            $CI->mpdf->nbpgPrefix = ' out of ';
            $CI->mpdf->nbpgSuffix = ' pages';
            $CI->mpdf->SetHeader('{PAGENO}{nbpg}');
            $CI->mpdf = new mPDF('', 'A4', 0, '', 12, 12, 10, 10, 5, 5);
            //$style = base_url().'assets/css/bootstrap.css';
            //$stylesheet = file_get_contents( $style);
            //$CI->mpdf->WriteHTML($stylesheet,1);    
			//$CI->mpdf->WriteHTML($stylesheet2,2);                    
            $CI->mpdf->WriteHTML($htmView,1);                       
            //$CI->mpdf->Output(''.$filename.'.pdf','D');
            $CI->mpdf->Output(''.$fileName.'.pdf','I');
	    }
	}
