<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Common {
	private $CI;
	public $foot=true;
	public $db2;
	private $instansi_rs = "";
	function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('session');
		//$db2=$this->CI->load->database('otherdb1', TRUE);
	}
	
	/*
	 * Untuk Menghasilkan Periode Tutup/Buka Di Bulan Sebelumnya, Jika Tutup Maka Hasilnya 0, Jika Buka Maka Hasilnya 1,
	 */
	 
	public function db2()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('session');
		$db2=$this->CI->load->database('otherdb1', TRUE);
		return $db2;
	}
	public function getPeriodeLastMonth($year,$month,$kd_unit_far){
		if($month==1){
			$month=12;
			$year=($year-1);
		}else{
			$month-=1;
		}
		return $this->getPeriodeThisMonth($year, $month, $kd_unit_far);
	}
	
	/*
	 * Untuk Menghasilkan Periode Tutup/Buka, Jika Tutup Maka Hasilnya 0, Jika Buka Maka Hasilnya 1,
	 */
	public function getPeriodeThisMonth($year,$month,$kd_unit_far){
		$data=$this->CI->db->query("SELECT m".$month." AS bulan FROM periode_inv WHERE kd_unit_far='".$kd_unit_far."' AND years=".$year);
		if(count($data->result())>0){
			$periode=$data->row();
			return $periode->bulan;
		}else{
			$this->CI->db->trans_begin();
			$periode_inv=array();
			$periode_inv['kd_unit_far']=$kd_unit_far;
			$periode_inv['years']=$year;
				
			/*
			 * insert postgre
			 */
			$this->CI->db->insert('periode_inv',$periode_inv);
			/*
			 * insert sql server
			*/
			// _QMS_insert('periode_inv',$periode_inv);
				
			if ($this->CI->db->trans_status() === FALSE){
				$this->CI->db->trans_rollback();
			}else{
				$this->CI->db->trans_commit();
			}
				
			return 0;
		}
	}
	
	/*
	 * Untuk menghasilkan nama bulan Bulan(indonesia) Berdasarkan indexnya
	 */
	public function getMonthByIndex($i){
		if($i==0){
			return 'Januari';
		}else if($i==1){
			return 'Februari';
		}else if($i==2){
			return 'Maret';
		}else if($i==3){
			return 'April';
		}else if($i==4){
			return 'Mei';
		}else if($i==5){
			return 'Juni';
		}else if($i==6){
			return 'Juli';
		}else if($i==7){
			return 'Agustus';
		}else if($i==8){
			return 'September';
		}else if($i==9){
			return 'Oktober';
		}else if($i==10){
			return 'November';
		}else if($i==11){
			return 'Desember';
		}
	}
	
	/*
	 * Untuk Menghasilkan Print Logo Rumah Sakit
	 */
	public function getIconRS(){
		$kd_rs=$this->CI->session->userdata['user_id']['kd_rs'];
		$rs=$this->CI->db->query("SELECT * FROM db_rs ")->row();
		$telp='';
		$fax='';
		if(($rs->phone1 != null && $rs->phone1 != '')|| ($rs->phone2 != null && $rs->phone2 != '')){
			$telp='Telp. ';
			$telp1=false;
			if($rs->phone1 != null && $rs->phone1 != ''){
				$telp1=true;
				$telp.=$rs->phone1;
			}
			if($rs->phone2 != null && $rs->phone2 != ''){
				if($telp1==true){
					$telp.='/'.$rs->phone2.'.';
				}else{
					$telp.=$rs->phone2.'.';
				}
			}else{
				$telp.='.';
			}
		}
		if($rs->fax != null && $rs->fax != ''){
			$fax='Fax. '.$rs->fax.'.';
				
		}
		return "<table style='font-size: 18;font-family: Arial, Helvetica, sans-serif;' cellspacing='0' border='0'>
   			<tr>
   				<td align='left'>
   					<img src='./assets/images/logo_.jpg' width='62' height='82' />
   				</td>
   				<td align='left' width='90%'>
   					<font style='font-size: 10px;'>".strtoupper($this->instansi_rs)."<br></font>
   					<b>".strtoupper($rs->name)."</b><br>
			   		<font style='font-size: 9px;'>".$rs->address.", ".$rs->state.", ".$rs->zip."</font><br>
			   		<font style='font-size: 9px;'>Email : ".$rs->email.", Website : ".$rs->Website."</font><br>
			   		<font style='font-size: 8px;'>".$telp." ".$fax."</font>
   				</td>
   			</tr>
   		</table>";
	}
	
	/*
	 * untuk menghasilkan empdf potrait
	 */
	public function getPDF_penunjang($type,$title,$prop=array()){
		$name=$this->CI->session->userdata['user_id']['username'];
		$this->CI->load->library('m_pdf');
		$this->CI->m_pdf->load();
		$marginLeft  = 10;
		$marginTop   = 10;
		$marginRight = 10;
		if($prop != NULL){
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-top'])){
				$marginTop=$prop['margin-top'];
			}
			if(isset($prop['margin-right'])){
				$marginRight=$prop['margin-right'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
		}
		
		
		$mpdf= new mPDF('utf-8', 'A4');
		$mpdf->AddPage($type, // L - landscape, P - portrait
				'', '', '', '',
				$marginLeft, // margin_left
				$marginRight, // margin right
				$marginTop, // margin top
				15, // margin bottom
				0, // margin header
				12); // margin footer
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
		$mpdf->pagenumPrefix = 'Hal : ';
		$mpdf->pagenumSuffix = '';
		$mpdf->nbpgPrefix = ' Dari ';
		$mpdf->nbpgSuffix = '';
		date_default_timezone_set("Asia/Jakarta"); 
		$date = gmdate("d-M-Y / H:i", time()+60*60*7);
		//$date = date("d-M-Y / H:i");
		$arr = array (
				'odd' => array (
						'L' => array (
								'content' => 'Operator : '.$name,
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'C' => array (
								'content' => "Tgl/Jam : ".$date."",
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'R' => array (
								'content' => '{PAGENO}{nbpg}',
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'line' => 0,
				),
				'even' => array ()
		);
		if($this->foot==true){
			$mpdf->SetFooter($arr);
		}
		$mpdf->SetTitle($title);
		$mpdf->WriteHTML("
           <style>
   				table{
	   				width: 100%;
					font-family: Arial, Helvetica, sans-serif;
   					border-collapse: collapse;
   					font-size: 10;
   				}
           </style>
           ");
		$mpdf->WriteHTML($this->getIconRS());
		return $mpdf;
	}
	public function setPdf_penunjang($type,$title,$html,$prop=array()){
		$this->CI->load->library('common');
		if(isset($prop['foot'])){
			$this->foot=$prop['foot'];
		}
		
		$mpdf=$this->getPDF_penunjang($type,$title,$prop);
		$mpdf->WriteHTML($html);
		//echo $html;
		$mpdf->Output($pdfFilePath, "I");
		header ( 'Content-type: application/pdf' );
		header ( 'Content-Disposition: attachment; filename="'.$title.'.pdf"' );
		readfile ( 'original.pdf' );
	}
	
	public function getPDF($type,$title,$prop=array()){
		$name=$this->CI->session->userdata['user_id']['username'];
		$this->CI->load->library('m_pdf');
		$this->CI->m_pdf->load();
		$marginLeft  = 10;
		$marginTop   = 10;
		$marginRight = 10;
		$type='A4';
		if($prop != NULL){
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-top'])){
				$marginTop=$prop['margin-top'];
			}
			if(isset($prop['margin-right'])){
				$marginRight=$prop['margin-right'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['type'])){
				$type=$prop['type'];
			}
		}
		
		
		$mpdf= new mPDF('utf-8', $type);
		$mpdf->AddPage($type, // L - landscape, P - portrait
				'', '', '', '',
				$marginLeft, // margin_left
				$marginRight, // margin right
				$marginTop, // margin top
				15, // margin bottom
				0, // margin header
				12); // margin footer
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
		$mpdf->pagenumPrefix = 'Hal : ';
		$mpdf->pagenumSuffix = '';
		$mpdf->nbpgPrefix = ' Dari ';
		$mpdf->nbpgSuffix = '';
		date_default_timezone_set("Asia/Jakarta"); 
		$date = gmdate("d-M-Y / H:i", time()+60*60*7);
		//$date = date("d-M-Y / H:i");
		$arr = array (
				'odd' => array (
						'L' => array (
								'content' => 'Operator : '.$name,
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'C' => array (
								'content' => "Tgl/Jam : ".$date."",
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'R' => array (
								'content' => '{PAGENO}{nbpg}',
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'line' => 0,
				),
				'even' => array ()
		);
		if($this->foot==true){
			$mpdf->SetFooter($arr);
		}
		$mpdf->SetTitle($title);
		$mpdf->WriteHTML("
           <style>
   				table{
	   				width: 100%;
					font-family: Arial, Helvetica, sans-serif;
   					border-collapse: collapse;
   					font-size: 10;
   				}
           </style>
           ");
		$mpdf->WriteHTML($this->getIconRS());
		return $mpdf;
	}
	
	/*
	 * Unutuk Menghasilkan Kode Unit Far
	 */
	public function getKodeUnit(){
		return $this->CI->session->userdata['user_id']['aptkdunitfar'];
	}
	
	public function setPdf($type,$title,$html,$prop=array()){
		$this->CI->load->library('common');
		if(isset($prop['foot'])){
			$this->foot=$prop['foot'];
		}
		
		$mpdf=$this->getPdf($type,$title,$prop);
		$mpdf->WriteHTML($html);
		//echo $html;
		$mpdf->Output($pdfFilePath, "I");
		header ( 'Content-type: application/pdf' );
		header ( 'Content-Disposition: attachment; filename="'.$title.'.pdf"' );
		readfile ( 'original.pdf' );
	}
	public function setPdf2($type,$title,$html,$prop=array()){
		$this->CI->load->library('common');
		if(isset($prop['foot'])){
			$this->foot=$prop['foot'];
		}
		
		$mpdf=$this->getPdf2($type,$title,$prop);
		$mpdf->WriteHTML($html);
		//echo $html;
		$mpdf->Output($pdfFilePath, "I");
		header ( 'Content-type: application/pdf' );
		header ( 'Content-Disposition: attachment; filename="'.$title.'.pdf"' );
		readfile ( 'original.pdf' );
	}
	public function setPdf3($type,$title,$html,$prop=array()){
		$this->CI->load->library('common');
		if(isset($prop['foot'])){
			$this->foot=$prop['foot'];
		}
		
		$mpdf=$this->getPdf3($type,$title,$prop);
		$mpdf->WriteHTML($html);
		//echo $html;
		$mpdf->Output($pdfFilePath, "I");
		header ( 'Content-type: application/pdf' );
		header ( 'Content-Disposition: attachment; filename="'.$title.'.pdf"' );
		readfile ( 'original.pdf' );
	}
	public function getPDF2($type,$title,$prop=array()){
		$name=$this->CI->session->userdata['user_id']['username'];
		$this->CI->load->library('m_pdf');
		$this->CI->m_pdf->load();
		$marginLeft=15;
		if($prop != NULL){
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
		}
		
		
		$mpdf= new mPDF('utf-8', 'A4');
		$mpdf->AddPage($type, // L - landscape, P - portrait
				'', '', '', '',
				$marginLeft, // margin_left
				15, // margin right
				15, // margin top
				15, // margin bottom
				0, // margin header
				12); // margin footer
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
		$mpdf->pagenumPrefix = 'Hal : ';
		$mpdf->pagenumSuffix = '';
		$mpdf->nbpgPrefix = ' Dari ';
		$mpdf->nbpgSuffix = '';
		date_default_timezone_set("Asia/Jakarta"); 
		$date = gmdate("d-M-Y / H:i", time()+60*60*7);
		//$date = date("d-M-Y / H:i");
		$arr = array (
				'odd' => array (
						'L' => array (
								'content' => 'Operator : '.$name,
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'C' => array (
								'content' => "Tgl/Jam : ".$date."",
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'R' => array (
								'content' => '{PAGENO}{nbpg}',
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'line' => 0,
				),
				'even' => array ()
		);
		if($this->foot==true){
			$mpdf->SetFooter($arr);
		}
		$mpdf->SetTitle($title);
		$mpdf->WriteHTML("
           <style>
   				table{
	   				width: 100%;
					font-family: Arial, Helvetica, sans-serif;
   					border-collapse: collapse;
   					font-size: 12;
   				}
           </style>
           ");
		$mpdf->WriteHTML($this->getIconRS2());
		return $mpdf;
	}
	public function getPDF3($type,$title,$prop=array()){
		$name=$this->CI->session->userdata['user_id']['username'];
		$this->CI->load->library('m_pdf');
		$this->CI->m_pdf->load();
		$marginLeft=15;
		$marginTop=15;
		$marginRight=15;
		$marginBottom=15;
		$header=true;
		$paper='A4';
		if($prop != NULL){
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-top'])){
				$marginTop=$prop['margin-top'];
			}
			if(isset($prop['margin-right'])){
				$marginRight=$prop['margin-right'];
			}
			if(isset($prop['margin-bottom'])){
				$marginBottom=$prop['margin-bottom'];
			}
			if(isset($prop['paper'])){
				$paper=$prop['paper'];
			}
			if(isset($prop['header'])){
				$header=$prop['header'];
			}
		}
		
		
		$mpdf= new mPDF('utf-8', $paper);
		$mpdf->AddPage($type, // L - landscape, P - portrait
				'', '', '', '',
				$marginLeft, // margin_left
				$marginRight, // margin right
				$marginTop, // margin top
				$marginBottom, // margin bottom
				0, // margin header
				12); // margin footer
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
		$mpdf->pagenumPrefix = 'Hal : ';
		$mpdf->pagenumSuffix = '';
		$mpdf->nbpgPrefix = ' Dari ';
		$mpdf->nbpgSuffix = '';
		date_default_timezone_set("Asia/Jakarta"); 
		$date = gmdate("d-M-Y / H:i", time()+60*60*7);
		//$date = date("d-M-Y / H:i");
		$arr = array (
				'odd' => array (
						'L' => array (
								'content' => 'Operator : '.$name,
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'C' => array (
								'content' => "Tgl/Jam : ".$date."",
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'R' => array (
								'content' => '{PAGENO}{nbpg}',
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'line' => 0,
				),
				'even' => array ()
		);
		if($this->foot==true){
			$mpdf->SetFooter($arr);
		}
		$mpdf->SetTitle($title);
		// $mpdf->WriteHTML("
           // <style>
   				// table{
	   				// width: 100%;
					// font-family: Arial, Helvetica, sans-serif;
   					// border-collapse: collapse;
   					// font-size: 12;
   				// }
           // </style>
           // ");
		if($header==true){
			$mpdf->WriteHTML($this->getIconRS());
		}
		return $mpdf;
	}
	public function getIconRS2(){
		//$kd_rs=$this->CI->session->userdata['user_id']['kd_rs'];
		$rs=$this->CI->db->query("SELECT * FROM db_rs ")->row();
		$telp='';
		$fax='';
		if(($rs->phone1 != null && $rs->phone1 != '')|| ($rs->phone2 != null && $rs->phone2 != '')){
			$telp='Telp. ';
			$telp1=false;
			if($rs->phone1 != null && $rs->phone1 != ''){
				$telp1=true;
				$telp.=$rs->phone1;
			}
			if($rs->phone2 != null && $rs->phone2 != ''){
				if($telp1==true){
					$telp.='/'.$rs->phone2.'.';
				}else{
					$telp.=$rs->phone2.'.';
				}
			}else{
				$telp.='.';
			}
		}
		if($rs->fax != null && $rs->fax != ''){
			$fax='<br>Fax. '.$rs->fax.'.';
				
		}
		return "<table style='font-size: 9;font-family: Arial, Helvetica, sans-serif;' cellspacing='0' border='0' width='100%'>
   			<tr>
   				<td width='50' rowspan='2'>
   					<img src='./ui/images/Logo/RSSM.png' width='100' height='100' />
   				</td>
   				<td width='916' rowspan='2' align='center'>
   					<font style='font-size: 19px;'><p><b>PEMERINTAH PROPINSI JAWA TIMUR<br>
   					  RUMAH SAKIT UMUM dr. SOEDONO MADIUN
   					</b><br></font>
			   		<font style='font-size: 12px;'>".$rs->address.", ".$rs->city." ".$telp."</font>
			   		<font style='font-size: 12px;'>".$fax."</font>
   				</td>
				<td width='10'>
					<font style='font-size: 14px;'>RSSM/FRRS/032/006</font>
				</td>
   			</tr>
   			<tr>
   			  <td>&nbsp;</td>
  </tr>
   		</table><u><hr></u>";
	}
	
	
	public function setPdfRAB($tahun_anggaran_ta,$type,$title,$html,$prop=array(),$tahun_anggaran_ta){
		$this->CI->load->library('common');
		if(isset($prop['foot'])){
			$this->foot=$prop['foot'];
		}
		
		$mpdf=$this->getPDFRAB($tahun_anggaran_ta,$type,$title,$prop);
		$mpdf->WriteHTML($html);
		//echo $html;
		$mpdf->Output($pdfFilePath, "I");
		header ( 'Content-type: application/pdf' );
		header ( 'Content-Disposition: attachment; filename="'.$title.'.pdf"' );
		readfile ( 'original.pdf' );
	}
	
	
	public function getPDFRAB($tahun_anggaran_ta,$type,$title,$prop=array()){
		$kd_rs=$this->CI->session->userdata['user_id']['kd_rs'];
		$rs=$this->CI->db->query("SELECT * FROM db_rs ")->row();
		$telp='';
		$fax='';
		if(($rs->phone1 != null && $rs->phone1 != '')|| ($rs->phone2 != null && $rs->phone2 != '')){
			$telp='<br>Telp. ';
			$telp1=false;
			if($rs->phone1 != null && $rs->phone1 != ''){
				$telp1=true;
				$telp.=$rs->phone1;
			}
			if($rs->phone2 != null && $rs->phone2 != ''){
				if($telp1==true){
					$telp.='/'.$rs->phone2.'.';
				}else{
					$telp.=$rs->phone2.'.';
				}
			}else{
				$telp.='.';
			}
		}
		if($rs->fax != null && $rs->fax != ''){
			$fax='<br>Fax. '.$rs->fax.'.';
				
		}
		$name=$this->CI->session->userdata['user_id']['username'];
		$this->CI->load->library('m_pdf');
		$this->CI->m_pdf->load();
		
		
		$marginLeft=15;
		if($prop != NULL){
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
		}
		
		
		$mpdf= new mPDF('utf-8', 'A4');
		$mpdf->AddPage($type, // L - landscape, P - portrait
				'', '', '', '',
				$marginLeft, // margin_left
				15, // margin right
				15, // margin top
				15, // margin bottom
				0, // margin header
				12); // margin footer
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
		$mpdf->pagenumPrefix = 'Hal : ';
		$mpdf->pagenumSuffix = '';
		$mpdf->nbpgPrefix = ' Dari ';
		$mpdf->nbpgSuffix = '';
		date_default_timezone_set("Asia/Jakarta"); 
		$date = gmdate("d-M-Y", time()+60*60*7);
		//$date = date("d-M-Y / H:i");
		$arr = array (
				'odd' => array (
						'L' => array (
								'content' => 'Operator : '.$name,
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						/* 'C' => array (
								'content' => "Tgl/Jam : ".$date."",
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						), */
						'R' => array (
								'content' => '{PAGENO}{nbpg}',
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'serif',
								'color'=>'#000000'
						),
						'line' => 0,
				),
				'even' => array ()
		);
		if($this->foot==true){
			$mpdf->SetFooter($arr);
		}
		$mpdf->SetTitle($title);
		$mpdf->WriteHTML("
           <style>
   				table{
	   				width: 100%;
					font-family: Arial, Helvetica, sans-serif;
   					border-collapse: collapse;
   					font-size: 11;
   				}
           </style>
           ");
		
		return $mpdf;
	}
}