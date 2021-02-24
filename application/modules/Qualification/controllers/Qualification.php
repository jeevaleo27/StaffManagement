<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualification extends MY_Controller {

	function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
         $this->load->library('email');
       
    }

    /*@Decs:function to view QualificationDetails @Author:Jeeva*/
	public function index()
	{
		 $d["content"]="QualificationDetails";
		$this->load->view("page.php",$d);
		
	}
	
	/*Function to validate the Qualification Form Inputs @Author:Jeeva*/
	public function Qualification_post_validate()
    {
    	$this->form_validation->set_rules('QualificationName','QualificationName','required');
    	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_message('required', 'Enter %s  Required*');
        /* if function to check the above condition is true or not*/

         if($this->form_validation->run())
         	/* Run if its true.*/
  			{   /* Query to save the Qualification form values in to the table*/
  				$QualificationName=$this->input->post("QualificationName");
				$data= array(
					'QualificationName'=>$QualificationName
				);
				/*....query to insert into mQualification table...*/
				 $insert = $this->db->insert('mQualification',$data);
				 echo json_encode($insert);
  			}
  		else
  			{//storing the error message in the error variable to diaplay in the field...
   			$array = array(
    			'error'   => true,
    			'QualificationName_error' => form_error('QualificationName')
    		);
    		echo json_encode($array);
			}
    }	


	/*@Decs:function to VIEW Insert QualificationDetails PAGE @Author:Jeeva*/
	public function InsertQualificationDetails()
	{
		$ClassDetailInsert["content"]="InsertQualificationDetails";
		$this->load->view("page",$ClassDetailInsert);

	}

	/*@Decs:function to View mQualification in data table @Author:Jeeva*/
	public function ViewmQualification()
	{			
		$mQualification= $this->db->select('*')->from('mQualification')->get()->result();
		foreach($mQualification as $row)
		{
			if($row->ActiveQua=="1"){
				$Active="yes";
			}
				else{
					$Active="no";
				}
			echo "<tr>";
			echo "<td>".$row->QualificationUID."</td>";
			echo "<td>".$row->QualificationName."</td>";
			echo "<td>".$row->CreatedBy."</td>";
			echo "<td>".$row->CreatedDateTime."</td>";         
			echo "<td>".$Active."</td>";
			echo "<td><button type='button' class='btn btn-danger btn-sm' id='DeleteDetails' data-id='".$row->QualificationUID."'data-toggle='modal' data-target='#ShowDeleteDetails'>Delete</button></td>";
			echo "<td><button type='button' class='btn btn-primary btn-sm edit'><a href=\"Qualification/EditQualificationDetails?QualificationUID=".$row->QualificationUID."\" style='color:white;'>Edit</a></button></td>";
			/*coding to store a values as a attribute to show in the model*/
			echo "<td><button type='button' id='QualificationDetails' class='btn btn-success btn-sm view'  data-toggle='modal' data-target='#ShowQualificationDetails'
			data-QualificationUID=".$row->QualificationUID."
			data-QualificationName=".$row->QualificationName."
			data-CreatedBy=".$row->CreatedBy."
			data-CreatedDateTime=".$row->CreatedDateTime."
			data-Active=".$Active."
			>VIEW</button></td>";
			echo "</tr>";
		}	
	}

	/*@Decs:function to Delete a field in mQualification @Author:Jeeva*/
	public function DeleteQualification()
	{
		if($this->input->post('type')==2)
		{
			$QualificationUID=$this->input->post('QualificationUID');	
			/*query to delete the row*/
			$mQualification=$this->db->where('QualificationUID', $QualificationUID)->delete('mQualification');
			echo json_encode(array(
				"statusCode"=>200
			));
		} 
	}

	/*@Decs:function to Redirect the Qualification edit page @Author:Jeeva*/
    public function EditQualificationDetails()
 	{   
       $QualificationUID=$this->input->get('QualificationUID');
      //query to select the data in mQualification table..
        $QualificationData['QualificationField']=$this->db->select('*')->where('QualificationUID',$QualificationUID)->from('mQualification')->get()->row();
	    $this->load->view("include/Header");
        $this->load->view("include/sidebar");
	    $this->load->view('QualificationEditDetails',$QualificationData);
	}


	/*@Decs:function to Update Details in mQualification @Author:Jeeva*/
	public function Upadte_Qualification_post_validate()
    {
    	$this->form_validation->set_rules('QualificationName','QualificationName','required');
    	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_message('required', 'Enter %s  Required*');
        /* if function to check the above condition is true or not*/

         if($this->form_validation->run())
         	/* Run if its true.*/
  			{   
  				/* Query to save the Qualification form values in to the table*/
			        $QualificationUID=$this->input->post("QualificationUID");
					$QualificationName=$this->input->post("QualificationName");
				    $Active=$this->input->post("Active");
					$mQualification=array
				( 'QualificationName'=> $QualificationName,
					'Active'=>$Active);
				$mQualification=$this->db->where('QualificationUID',$QualificationUID)->update('mQualification', $mQualification);
				echo json_encode($mQualification);
			}
			 else
			 {//storing the error message in the error variable to diaplay in the field...
	   			$array = array(
	    			'error'   => true,
	    			'QualificationName_error' => form_error('QualificationName')
	    		);
	    		echo json_encode($array);
			}
    }
}
 