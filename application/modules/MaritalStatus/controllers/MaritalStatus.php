<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaritalStatus extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');

	}

	/*@Decs:function to view MaritalStatusDetails @Author:Jeeva*/
	public function index()
	{
		$d["content"]="MaritalStatusDetails";
		$this->load->view("page.php",$d);
	}

	/*Function to validate the MaritalStatus Form Inputs @Author:Jeeva*/
	public function MaritalStatus_post_validate()
	{
		$this->form_validation->set_rules('MaritalStatusName','MaritalStatusName','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Enter %s  Required*');
		/* if function to check the above condition is true or not*/
		if($this->form_validation->run())
			/* Run if its true.*/
		{   /* Query to save the MaritalStatus form values in to the table*/
			$MaritalStatusName=$this->input->post("MaritalStatusName");
			$data= array(
				'MaritalStatusName'=>$MaritalStatusName
			);
			/*....query to insert into mMaritalStatus table...*/
			$insert = $this->db->insert('mMaritalStatus',$data);
			echo json_encode($insert);
		}
		else
			{/*storing the error message in the error variable to diaplay in the field...*/
				$array = array(
					'error'   => true,
					'MaritalStatusName_error' => form_error('MaritalStatusName')
				);
				echo json_encode($array);
			}
		}	

		/*@Decs:function to VIEW Insert MaritalStatusDetails PAGE @Author:Jeeva*/
		public function InsertMaritalStatusDetails()
		{
			$ClassDetailInsert["content"]="InsertMaritalStatusDetails";
			$this->load->view("page",$ClassDetailInsert);

		}

		/*@Decs:function to Insert MaritalStatusDetails VALUES @Author:Jeeva*/
		public function InsertMaritalStatusValues()
		{
			$MaritalStatusName=$this->input->post("MaritalStatusName");
			$data= array(
				'MaritalStatusName'=>$MaritalStatusName
			);
			/*....query to insert into mMaritalStatus table...*/
			$insert = $this->db->insert('mMaritalStatus',$data);
			echo json_encode($insert);
		}

		/*@Decs:function to View mMaritalStatus in data table @Author:Jeeva*/
		public function ViewmMaritalStatus()
		{			
			$mMaritalStatus= $this->db->select('*')->from('mMaritalStatus')->get()->result();
			foreach($mMaritalStatus as $row)
			{
				if($row->ActiveMrt=="1"){
					$Active="yes";
				}
				else{
					$Active="no";
				}
				echo "<tr>";
				echo "<td>".$row->MaritalStatusUID."</td>";
				echo "<td>".$row->MaritalStatusName."</td>";
				echo "<td>".$row->CreatedBy."</td>";
				echo "<td>".$row->CreatedDateTime."</td>";         
				echo "<td>".$Active."</td>";
				echo "<td><button type='button' class='btn btn-danger btn-sm'id='DeleteDetails' data-id='".$row->MaritalStatusUID."'data-toggle='modal' data-target='#ShowDeleteDetails'>Delete</button></td>";
				echo "<td><button type='button' class='btn btn-primary btn-sm edit'><a href=\"MaritalStatus/EditMaritalStatusDetails?MaritalStatusUID=".$row->MaritalStatusUID."\" style='color:white;'>Edit</a></button></td>";
				/*coding to store a values as a attribute to show in the model*/
				echo "<td><button type='button' id='MaritalStatusDetails' class='btn btn-success btn-sm view'  data-toggle='modal' data-target='#ShowMaritalStatusDetails'
				data-MaritalStatusUID=".$row->MaritalStatusUID."
				data-MaritalStatusName=".$row->MaritalStatusName."
				data-CreatedBy=".$row->CreatedBy."
				data-CreatedDateTime=".$row->CreatedDateTime."
				data-Active=".$Active."
				>VIEW</button></td>";
				echo "</tr>";
			}	
		}

		/*@Decs:function to Delete a field in mMaritalStatus @Author:Jeeva*/
		public function DeleteMaritalStatus()
		{
			if($this->input->post('type')==2)
			{
				$MaritalStatusUID=$this->input->post('MaritalStatusUID');	
				/*query to delete the row*/
				$mMaritalStatus=$this->db->where('MaritalStatusUID', $MaritalStatusUID)->delete('mMaritalStatus');
				echo json_encode(array(
					"statusCode"=>200
				));
			} 
		}

		/*@Decs:function to Redirect the MaritalStatus edit page @Author:Jeeva*/
		public function EditMaritalStatusDetails()
		{   
			$MaritalStatusUID=$this->input->get('MaritalStatusUID');
			/*query to select the data in mMaritalStatus table..*/
			$MaritalStatusData['MaritalStatusField']=$this->db->select('*')->where('MaritalStatusUID',$MaritalStatusUID)->from('mMaritalStatus')->get()->row();
			$this->load->view("include/Header");
			$this->load->view("include/sidebar");
			$this->load->view('MaritalStatusEditDetails',$MaritalStatusData);
		}


		/*@Decs:function to Update Details in mMaritalStatus @Author:Jeeva*/
		/*@Decs:function to Update Details in mMaritalStatus @Author:Jeeva*/
		public function Upadte_MaritalStatus_post_validate()
		{
			$this->form_validation->set_rules('MaritalStatusName','MaritalStatusName','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_message('required', 'Enter %s  Required*');
			/* if function to check the above condition is true or not*/

			if($this->form_validation->run())
				/* Run if its true.*/
			{   
				/* Query to save the MaritalStatus form values in to the table*/
				$MaritalStatusUID=$this->input->post("MaritalStatusUID");
				$MaritalStatusName=$this->input->post("MaritalStatusName");
				$Active=$this->input->post("Active");
				$mMaritalStatus=array
				( 'MaritalStatusName'=> $MaritalStatusName,
					'Active'=>$Active);
				$mMaritalStatus=$this->db->where('MaritalStatusUID',$MaritalStatusUID)->update('mMaritalStatus', $mMaritalStatus);
				echo json_encode($mMaritalStatus);
			}
			else
				{/*storing the error message in the error variable to diaplay in the field...*/
					$array = array(
						'error'   => true,
						'MaritalStatusName_error' => form_error('MaritalStatusName')
					);
					echo json_encode($array);
				}
			}
		}
