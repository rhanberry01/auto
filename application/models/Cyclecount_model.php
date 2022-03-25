<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cyclecount_model extends CI_Model {

     
     public function sample(){
        //load_db
        $this->ddb = $this->load->database('branch_server', true);
        return 'auto model ok!';
     }

     function get_schedule($branch = NULL){

		$this->ddb = $this->load->database('branch_server', true);
		//$connected = $this->ddb->initialize();
		
		date_default_timezone_set('Asia/Manila');
		$datetime = date('Y-m-d');
		$day = date('l', strtotime($datetime));
		
		//sunday ang start ng week
		$dateArray = explode("-", $datetime);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		$week = floor((date_format($date, 'j') - 1) / 7) + 1;  


			//if($connected){		
				//$this->ddb->trans_start();
				$sql = "SELECT * FROM TempCC_Category where Branch = '$branch' And (Day LIKE '%$day%' AND (Schedule LIKE '%$week%' OR Schedule = 'Weekly'))";
				$query = $this->ddb->query($sql);				
				$result = $query->result();
				$num = $query->num_rows();
				//$this->ddb->trans_complete();
				return $result;
			//}	
	}

	

     function get_branch_cc(){		
		
		$this->ddb = $this->load->database('branch_server', true);
		//$connected = $this->ddb->initialize();
		
			//if($connected){		
				//$this->ddb->trans_start();		
				$sql = "SELECT DISTINCT(Branch) as branch FROM TempCC_Category";
				$query = $this->ddb->query($sql);				
				$result = $query->result();
			//	$this->ddb->trans_complete();
				return $result;
			//}	
	}

     function get_maxautoid_cc($branch = NULL){		
		
		//$this->bdb = $this->load->database($user_branch,TRUE);
		$this->ddb = $this->load->database('branch_server', true);
		//$connected = $this->ddb->initialize();
		
			//if($connected){		
				//$this->ddb->trans_start();		
				$sql = "SELECT MAX(AutoID) as autoid from TempCC_Auto_Info where Branch = '$branch'";
				$query = $this->ddb->query($sql);	
				$result = $query->row();
				//$this->ddb->trans_complete();
				return $result->autoid;		
			//}	
	}

	function add_info_cc($autoid = NULL,$branch = NULL,$cid = NULL){
		
		$this->ddb = $this->load->database('branch_server', true);
		//$connected = $this->ddb->initialize();
		date_default_timezone_set('Asia/Manila');
		$now = date('m-d-Y H:i:s');
		
		//if($connected){	
			$sql = "Insert into TempCC_Auto_Info (AutoID,Branch,DateTrans,CategoryID) values ('$autoid','$branch','$now','$cid')";
			//$this->ddb->trans_begin();
			$result = $this->ddb->query($sql);
			
			if($result){
				//$this->ddb->trans_commit();
				return 'success';
			}
			else{
				//$this->ddb->trans_rollback();
				return 'error';
			}	
		//}
	}

	function get_info_cc(){		
		
		$this->ddb = $this->load->database('branch_server', true);
		//$connected = $this->ddb->initialize();
		
			//if($connected){		
				//$this->ddb->trans_start();		
				$sql = "SELECT MAX(InfoId) as infoid from TempCC_Auto_Info";
				$query = $this->ddb->query($sql);				
				$result = $query->row();
				//$this->ddb->trans_complete();
				return $result->infoid;
			//}	
	}


	function add_details_cc($infoid = NULL,$branch = NULL,$cid = NULL){
		
		$this->ddb = $this->load->database('branch_server', true);
		//$connected = $this->ddb->initialize();
		
		//if($connected){	
			$sql = "Insert into TempCC_Auto_Details(InfoID,ProductID,GlobalID,Barcode,Branch)
					Select $infoid,ProductID,GlobalID,Barcode,Branch from TempCC_Category_Details where Branch = '$branch' and CategoryID = '$cid'";
			
			//$this->ddb->trans_begin();
			$results = $this->ddb->query($sql);
			$result = $this->ddb->affected_rows();
			if($results){
				//$this->ddb->trans_commit();
				//$result['msg'] = 'success';
			}
			else{
				//$this->ddb->trans_rollback();
				//$result['msg'] = 'error';
			}	
		//}
		return $result;
	}
	




}
