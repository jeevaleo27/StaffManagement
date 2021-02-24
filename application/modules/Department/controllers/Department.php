<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->helper(array('form', 'url'));
	}

	/*@Decs:function to view DepartmentDetails @Author:Jeeva*/
	public function index()
	{
		$d["content"]="DepartmentDetails";
		$this->load->view("page.php",$d);

	}


	/*Function to validate the Department Form Inputs @Author:Jeeva*/
	public function Department_post_validate()
	{
		$this->form_validation->set_rules('DepartmentName','DepartmentName','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Enter %s  Required*');
		/* if function to check the above condition is true or not*/

		if($this->form_validation->run())
			/* Run if its true.*/
		{   /* Query to save the Department form values in to the table*/
			$DepartmentName=$this->input->post("DepartmentName");
			$data= array(
				'DepartmentName'=>$DepartmentName
			);
			/*....query to insert into mDepartment table...*/
			$insert = $this->db->insert('mDepartment',$data);
			echo json_encode($insert);
		}
		else
			{/*storing the error message in the error variable to diaplay in the field...*/
				$array = array(
					'error'   => true,
					'DepartmentName_error' => form_error('DepartmentName')
				);
				echo json_encode($array);
			}
		}	


		/*@Decs:function to VIEW Insert DepartmentDetails PAGE @Author:Jeeva*/
		public function InsertDepartmentDetails()
		{
			$ClassDetailInsert["content"]="InsertDepartmentDetails";
			$this->load->view("page",$ClassDetailInsert);

		}

		/*@Decs:function to View mDepartment in data table @Author:Jeeva*/
		public function ViewmDepartment()
		{	
			$this->db->select('*');
			$this->db->from('mDepartment');
			$mDepartment=$this->db->get();
			$mDepartment= $mDepartment->result();
			foreach($mDepartment as $row)
			{
				if($row->ActiveDept="1"){
					$Active="yes";
				}
				else{
					$Active="no";
				}
				echo "<tr>";
				echo "<td>".$row->DepartmentUID."</td>";
				echo "<td>".$row->DepartmentName."</td>";
				echo "<td>".$row->CreatedBy."</td>";
				echo "<td>".$row->CreatedDateTime."</td>";         
				echo "<td>".$Active."</td>";
				echo "<td><button type='button' class='btn btn-danger btn-sm'  id='DeleteDetails' data-id='".$row->DepartmentUID."'
				data-toggle='modal' data-target='#ShowDeleteDetails'>Delete</button></td>";
				echo "<td><button type='button' class='btn btn-primary btn-sm edit'><a href=\"Department/EditDepartmentDetails?DepartmentUID=".$row->DepartmentUID."\" style='color:white;'>Edit</a></button></td>";
				/*coding to store a values as a attribute to show in the model*/
				echo "<td><button type='button' id='DepartmentDetails' class='btn btn-success btn-sm view'  data-toggle='modal' data-target='#ShowDepartmentDetails'
				data-DepartmentUID=".$row->DepartmentUID."
				data-DepartmentName=".$row->DepartmentName."
				data-CreatedBy=".$row->CreatedBy."
				data-CreatedDateTime=".$row->CreatedDateTime."
				data-Active=".$Active."
				>VIEW</button></td>";
				echo "</tr>";
			}	
		}

		/*@Decs:function to Delete a field in mDepartment @Author:Jeeva*/
		public function DeleteDepartment()
		{
			if($this->input->post('type')==2)
			{
				$DepartmentUID=$this->input->post('DepartmentUID');	
				/*query to delete the row*/
				$this->db->where('DepartmentUID', $DepartmentUID);
				$mDepartment=$this->db->delete('mDepartment');
				$this->db->query($mDepartment);
				echo json_encode(array(
					"statusCode"=>200
				));
			} 
		}

		/*@Decs:function to Redirect the Department edit page @Author:Jeeva*/
		public function EditDepartmentDetails()
		{   
			$DepartmentUID=$this->input->get('DepartmentUID');
       /*query to select the data in mDepartment table..*/

       		$DepartmentData['DepartmentField']=$this->db->select('*')->where('DepartmentUID',$DepartmentUID)->from('mDepartment')->get()->row();
			$this->load->view("include/Header");
			$this->load->view("include/sidebar");
			$this->load->view('DepartmentEditDetails',$DepartmentData);
		}

		/*Function to validate the update Form Inputs @Author:Jeeva*/
		public function Upadte_Department_post_validate()
		{
			$this->form_validation->set_rules('DepartmentName','DepartmentName','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_message('required', 'Enter %s  Required*');
			/* if function to check the above condition is true or not*/

			if($this->form_validation->run())
				/* Run if its true.*/
			{   
				/* Query to save the Department form values in to the table*/
				$DepartmentUID=$this->input->post("DepartmentUID");
				$DepartmentName=$this->input->post("DepartmentName");
				$Active=$this->input->post("Active");
				$mDepartment = array( 
				'DepartmentName' =>$DepartmentName, 
				'Active'=>$Active);
				$mDepartment=$this->db->where('DepartmentUID',$DepartmentUID)->update('mDepartment', $mDepartment);
				echo json_encode($mDepartment);
			}
			else
  {/*storing the error message in the error variable to diaplay in the field...*/
	$array = array(
		'error'   => true,
		'DepartmentName_error' => form_error('DepartmentName')
	);
	echo json_encode($array);
 }
}
}
