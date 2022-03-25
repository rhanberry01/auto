<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', -1);
ini_set('mssql.connect_timeout',0);
ini_set('mssql.timeout',0);
set_time_limit(0);  
ini_set('memory_limit', -1);

//client_buffer_max_kb_size = '50240'
//sqlsrv.ClientBufferMaxKBSize = 50240

class Category extends CI_Controller {
	
	public function __construct(){
		date_default_timezone_set('Asia/Manila');
		parent::__construct();
		$this->load->model("Category_model");
	}

	public function start_process(){
		echo 'auto start'.PHP_EOL;
		$data = $this->Category_model->sample();
		//echo $data.PHP_EOL;


		$rs = $this->Category_model->get_category_cc();
		foreach ($rs as $cat) {

			$results = $this->Category_model->insert_category($cat->CategoryName,$cat->UserID,$cat->DateCreated,$cat->Schedule,$cat->Day);

			if($results)
			{
				$catid = $results->maxid;
				echo $cat->CategoryName."-";
				$details = $this->Category_model->get_category_details($cat->CategoryID);
				echo sizeof($details).PHP_EOL;
				foreach($details as $c)
				{
					$branchpos = $this->Category_model->getbranchPOS($c->GlobalID,$c->Barcode);
					foreach($branchpos as $bp)
					{
						//echo $bp->ProductID.",";
						$this->Category_model->insert_detail($bp->ProductID,$bp->ProductCode,$bp->Barcode,$bp->Description,$bp->uom,$c->GlobalID,$c->UserID,$catid);
					}

				}

			}
			else
			{
				echo "Error Save Details";
			}
			// echo "Branch: " .$branch->branch.PHP_EOL;
			// echo "Number of affected rows: ".$results3;
		}
	}

}
