<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', -1);
ini_set('mssql.connect_timeout',0);
ini_set('mssql.timeout',0);
set_time_limit(0);  
ini_set('memory_limit', -1);

//client_buffer_max_kb_size = '50240'
//sqlsrv.ClientBufferMaxKBSize = 50240

class CycleCount extends CI_Controller {
	
	public function __construct(){
		date_default_timezone_set('Asia/Manila');
		parent::__construct();
		$this->load->model("Cyclecount_model");
	}

	public function start_process(){
		echo 'auto start'.PHP_EOL;
		$data = $this->Cyclecount_model->sample();
		//echo $data.PHP_EOL;


		$rs = $this->Cyclecount_model->get_branch_cc();
		foreach ($rs as $branch) {




			echo "Branch: " .$branch->branch.PHP_EOL;
			$results = $this->Cyclecount_model->get_maxautoid_cc($branch->branch);
			$maxid=$results;
			if($maxid == NULL)
			{
				$maxid = 1;
			}
			else
			{
				$maxid++;
			}

			$sched = $this->Cyclecount_model->get_schedule($branch->branch);
			//echo $sched;
			foreach($sched as $sch)
			{
				$this->Cyclecount_model->add_info_cc($maxid,$branch->branch,$sch->CategoryID);
				$results2 = $this->Cyclecount_model->get_info_cc();
				$infoid = $results2;
				$results3 = $this->Cyclecount_model->add_details_cc($infoid,$branch->branch,$sch->CategoryID);
				
				echo "Category" .$sch->CategoryName.PHP_EOL;
				echo "Number of affected rows: ".$results3.PHP_EOL;
			}
			
			// echo "Branch: " .$branch->branch.PHP_EOL;
			// echo "Number of affected rows: ".$results3;
		}
	}

}
