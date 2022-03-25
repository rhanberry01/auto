<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', -1);
ini_set('mssql.connect_timeout',0);
ini_set('mssql.timeout',0);
set_time_limit(0);  
ini_set('memory_limit', -1);

//client_buffer_max_kb_size = '50240'
//sqlsrv.ClientBufferMaxKBSize = 50240

class Auto_ extends CI_Controller {
	
	public function __construct(){
		date_default_timezone_set('Asia/Manila');
		parent::__construct();
		$this->load->model("Auto_model_");
	}


	public function start_process(){
		echo 'data gathering please do not close'.PHP_EOL;
		$data = $this->Auto_model_->sample();
		echo $data.PHP_EOL;
	}

	public function get_received_po(){
		echo 'data gathering please do not close'.PHP_EOL;
		$ms_res = $this->Auto_model_->get_po();
		foreach ($ms_res as $i => $row) {

			$PurchaseOrderNo = $row->PurchaseOrderNo;
			$ReceivingNo = $row->ReceivingNo;
			$Branch = BRANCH_USE;
			$DateReceived = $row->DateReceived;
			$tot_extended = $row->tot_extended;
			$ReceivingID = $row->ReceivingID;

			$data = $this->Auto_model_->insert_ignore($PurchaseOrderNo,$ReceivingNo,$Branch,date('Y-m-d:h:i:s',strtotime($DateReceived)),$tot_extended,$ReceivingID);

			echo $PurchaseOrderNo.'~'.$ReceivingNo.'~'.$Branch.'~'.$DateReceived.'~'.$tot_extended.'~'.$ReceivingID.PHP_EOL;

			echo $data.PHP_EOL;
		}
	
		echo "===== Free Purchases =====".PHP_EOL;

		$ms_res = $this->Auto_model_->get_free_po();
		foreach ($ms_res as $i => $row) {

			$PurchaseOrderNo = $row->PurchaseOrderNo;
			$ReceivingNo = $row->ReceivingNo;
			$Branch = BRANCH_USE;
			$DateReceived = $row->DateReceived;
			$tot_extended = $row->tot_extended;
			$ReceivingID = $row->ReceivingID;

			$data = $this->Auto_model_->insert_free_po($PurchaseOrderNo,$ReceivingNo,$Branch,date('Y-m-d:h:i:s',strtotime($DateReceived)),$tot_extended,$ReceivingID);

			echo $PurchaseOrderNo.'~'.$ReceivingNo.'~'.$Branch.'~'.$DateReceived.'~'.$tot_extended.'~'.$ReceivingID.PHP_EOL;

			echo $data.PHP_EOL;
		}
	
		echo "===== Price Survey =====".PHP_EOL;
		$ms_res = $this->Auto_model_->get_survey_po();
		foreach ($ms_res as $i => $row) {
			
			$PurchaseOrderNo = $row->ReferenceNo;
			$ReceivingNo = $row->MovementNo;
			$Branch = BRANCH_USE;
			$DateReceived = $row->PostedDate;
			$tot_extended = $row->tot_extended;
			$ReceivingID = $row->MovementID;

			$data = $this->Auto_model_->insert_survey_po($PurchaseOrderNo,$ReceivingNo,$Branch,date('Y-m-d:h:i:s',strtotime($DateReceived)),$tot_extended,$ReceivingID);

			echo $PurchaseOrderNo.'~'.$ReceivingNo.'~'.$Branch.'~'.$DateReceived.'~'.$tot_extended.'~'.$ReceivingID.PHP_EOL;

			echo $data;
		}

	}

	public function consolidate_inventory(){
		//

		//$dates = array('2019-03-01','2019-04-01','2019-05-01','2019-06-01','2020-01-01','2020-02-01','2020-03-01','2020-04-01','2020-05-01','2020-06-01');
		// $dates = array('2017-10-01','2018-10-01');
			$dates = array('2020-05-01','2020-06-01');
	//	$first_day =  date('Y-m-01', strtotime('-1 MONTH'));
	//	$last_day =  date('Y-m-t', strtotime($first_day));
	//	$flastyear = date('Y-m-01', strtotime('-1 YEAR', strtotime($first_day)));
    //	$llastyear = date('Y-m-t', strtotime('-1 YEAR', strtotime($last_day)));
		//$dates = array($first_day,$last_day,$flastyear,$llastyear);
		//$dates = array($first_day,$flastyear);
	//	$dates = array($first_day);
		// print_r($dates); die();

		$ms_db ='branch_server';
		$db = 'gp';
		foreach ($dates as $key => $date) {
		 echo 'data gathering please do not close sa 148 nakatutok and database'.PHP_EOL;

			$start_date = $date;
		    echo "DATE:".$start_date.PHP_EOL;
			$dateto = date("Y-m-t",strtotime($start_date));
			$end_date = date('Y-m-d', strtotime($dateto. ' + 1 days'));

			$data = $this->Auto_model_->get_inventory($ms_db,$start_date,$end_date);
			
			$details = array(
				'years' => date('Y',strtotime($start_date)),
				'months' => date('m',strtotime($start_date)),
				'beg' => $data[0],
				'end' => $data[1]
				);
			

			$this->Auto_model_->insert_update_inventory($ms_db,$details);

		}


	}


	public function consolidate_gp(){

		//$dates = array('2018-02-01');
		//$dates = array('2017-09-01','2018-09-01','2017-01-01','2017-02-01','2017-03-01','2017-04-01','2017-05-01','2017-06-01','2017-07-01','2017-08-01');
		
	//	$dates = array('2019-01-01','2019-02-01','2019-03-01','2019-04-01','2019-05-01','2019-06-01','2020-01-01','2020-02-01','2020-03-01','2020-04-01','2020-05-01','2020-06-01');
		
		$first_day =  date('Y-m-01', strtotime('-1 MONTH'));
		$last_day =  date('Y-m-t', strtotime($first_day));
	//	$flastyear = date('Y-m-01', strtotime('-1 YEAR', strtotime($first_day)));
    //	$llastyear = date('Y-m-t', strtotime('-1 YEAR', strtotime($last_day)));
		//$dates = array($first_day,$last_day,$flastyear,$llastyear);
		//$dates = array($first_day,$flastyear);
		$dates = array($first_day);
		// print_r($dates); die();
		
		$ms_db = 'branch_server';
		$db = 'gp';
		$details = array();
		foreach ($dates as $key => $date) {
		 echo 'data gathering please do not close'.PHP_EOL;

			$datefrom = $date;
		    echo "DATE:".$datefrom.PHP_EOL;
			$dateto = date("Y-m-t",strtotime($datefrom));
			$data = $this->Auto_model_->get_finished_sales_for_formula_1($ms_db,$datefrom,$dateto);
			
			$details = array(
				'years' => date('Y',strtotime($datefrom)),
				'months' => date('m',strtotime($datefrom)),
				'sukipoints' => $data[0],
				'total_cost' => $data[1],
				'total_sales' => $data[2],
				'non_vat_sales' => $data[3],
				'vat_sales' => $data[4],
				'zero_vat_sales' => $data[5],
				'non_vat_cost' => $data[6],
				'vat_cost' => $data[7],
				'zero_vat_cost' => $data[8]);
			

			$this->Auto_model_->insert_update_sales($ms_db,$details);
			$this->Auto_model_->insert_movements($ms_db,$datefrom,$dateto);

		}
		

	}

	
}
