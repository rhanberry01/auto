<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Category_model extends CI_Model {

     
     public function sample(){
        //load_db
        $this->ddb = $this->load->database('branch_server', true);
        return 'auto model ok!';
     }

     function get_category_cc(){		
		
		$this->ddb = $this->load->database('TNOV', true);
		//$connected = $this->ddb->initialize();
		
			//if($connected){		
				//$this->ddb->trans_start();		
				$sql = "SELECT * FROM TempCC_Category";
				$query = $this->ddb->query($sql);				
				$result = $query->result();
			//	$this->ddb->trans_complete();
				return $result;
			//}	
	}

	 function get_category_details($id=NULL){		
		
		$this->ddb = $this->load->database('TNOV', true);
		//$connected = $this->ddb->initialize();
		
			//if($connected){		
				//$this->ddb->trans_start();		
				$sql = "SELECT * FROM TempCC_Category_Details Where CategoryID = '$id'";
				$query = $this->ddb->query($sql);				
				$result = $query->result();
			//	$this->ddb->trans_complete();
				return $result;
			//}	
	}

	function getbranchPOS($gid=NULL,$bc = NULL)
	{
		$this->ddb = $this->load->database('branch_server', true);

		$sql =	"SELECT b.* FROM Products a 
			LEFT JOIN POS_Products b on a.ProductID = b.ProductID 
			where a.GlobalID = '$gid' and b.Barcode = '$bc'";
			$query = $this->ddb->query($sql);
			$result = $query->result();
			return $result;
	}

	function insert_category($name=NULL,$uid=NULL,$datecreated=NULL,$sched=NULL,$day=NULL)
	{
		$this->ddb = $this->load->database('branch_server', true);

		$connected = $this->ddb->initialize();
			if($connected){
				$this->ddb->trans_begin();
				$sql_row="SELECT CategoryName from TempCC_Category where CategoryName ='".$name."'";
				$query = $this->ddb->query($sql_row);
				$res_row = $query->row();

				//$this->ddb->trans_begin();

				if ($res_row != null){						
					$sql="Update TempCC_Category SET CategoryName = '$name',
					UserID = '$uid', DateCreated = '$datecreated', Schedule = '$sched', Day = '$day' Where CategoryName = '".$name."'";
					$this->ddb->query($sql);
					//return 'updated';

				}else{

					$sql = "Insert into TempCC_Category(CategoryName,UserID,DateCreated,Schedule,Day,Branch) Values ('$name','$uid','$datecreated','$sched','$day','TIMU')";
					$this->ddb->query($sql);
					//return 'inserted';
				}


				$sql_row='SELECT MAX(CategoryID) AS maxid FROM TempCC_Category';
				$query = $this->ddb->query($sql_row);
				$res_row = $query->row();

				if ($this->ddb->trans_status() === FALSE) {
	            //if something went wrong, rollback everything
		            $this->ddb->trans_rollback();
		       		return 'error';
		        } else {
		            //if everything went right, delete the data from the database
		            $this->ddb->trans_commit();
		            return $res_row;
		        }
			}
	}

	function insert_detail($pid=NULL,$pcode=NULL,$bcode=NULL,$desc=NULL,$uom=NULL,$global=NULL,$uid=NULL,$cid=NULL){

		$this->ddb = $this->load->database('branch_server', true);

		$connected = $this->ddb->initialize();

		if($connected){
			$this->ddb->trans_begin();
			$sql_row="SELECT Barcode from TempCC_Category_Details where Barcode ='".$bcode."'";
				$query = $this->ddb->query($sql_row);
				$res_row = $query->row();
				if ($res_row != null){	

				}
				else
				{
				$sql = "Insert into TempCC_Category_Details(ProductID,ProductCode,Barcode,Description,uom,Branch,GlobalID,UserID,CategoryID) Values ('$pid','$pcode','$bcode','$desc','$uom','TIMU','$global','$uid','$cid')";
					$this->ddb->query($sql);
				}

				if ($this->ddb->trans_status() === FALSE) 
				{
				    $this->ddb->trans_rollback();		       
				}
				else
				{
				   	$this->ddb->trans_commit();
				}	
			}
		
	}

}
