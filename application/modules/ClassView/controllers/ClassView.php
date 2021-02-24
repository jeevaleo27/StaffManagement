<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassView extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->helper(array('form', 'url'));
	}

	/*@Decs:function to view ClassDetails @Author:Jeeva*/
	public function index()
	{
		$ClassDetail["content"]="ClassDetails";
		$this->load->view("page",$ClassDetail);
	}

	/*Function to validate the Form Inputs @Author:Jeeva*/
	public function post_validate()
	{
		$this->form_validation->set_rules('ClassName','ClassName','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Enter %s  Required*');
		/* if function to check the above condition is true or not*/
		if($this->form_validation->run())
			{	/* Run if its true.*/
				/* Query to save the form values in to the table*/
				$ClassName=$this->input->post("ClassName");
				$data= array(
					'ClassName'=>$ClassName
				);
				/*....query to insert into mClass table...*/
				$insert = $this->db->insert('mClass',$data);
				echo json_encode($insert);
			}
			else
				{/*storing the error message in the error variable to diaplay in the field...*/
					$array = array(
						'error'   => true,
						'ClassName_error' => form_error('ClassName')
					);
					echo json_encode($array);
				}
			}	

			/*@Decs:function to VIEW Insert ClassDetails PAGE @Author:Jeeva*/
			public function InsertClassDetails()
			{
				$ClassDetailInsert["content"]="InsertClassDetails";
				$this->load->view("page",$ClassDetailInsert);

			}

			/*@Decs:function to View mClass in data table @Author:Jeeva*/
			public function ViewmClass()
			{	
				$this->db->select('*');
				$this->db->from('mClass');
				$mClass=$this->db->get();
				$mClass= $mClass->result();		
				foreach($mClass as $row)
				{
					if($row->Active=="1"){
						$Active="yes";
					}
					else{
						$Active="no";
					}
					echo "<tr>";
					echo "<td>".$row->ClassUID."</td>";
					echo "<td>".$row->ClassName."</td>";
					echo "<td>".$row->CreatedBy."</td>";
					echo "<td>".$row->CreatedDateTime."</td>";         
					echo "<td>".$Active."</td>";
					echo "<td><button type='button' class='btn btn-danger btn-sm' id='DeleteDetails' data-id='".$row->ClassUID."'data-toggle='modal' data-target='#ShowDeleteDetails'>Delete</button></td>";
					echo "<td><button type='button' class='btn btn-primary btn-sm edit'><a href=\"ClassView/EditClassDetails?ClassUID=".$row->ClassUID."\" style='color:white;'>Edit</a></button></td>";
					/*coding to store a values as a attribute to show in the model*/
					echo "<td><button type='button' id='ClassDetails' class='btn btn-success btn-sm view'  data-toggle='modal' data-target='#ShowClassDetails'
					data-ClassUID=".$row->ClassUID."
					data-ClassName=".$row->ClassName."
					data-CreatedBy=".$row->CreatedBy."
					data-CreatedDateTime=".$row->CreatedDateTime."
					data-Active=".$Active."
					>VIEW</button></td>";
					echo "</tr>";
				}	
			}

			/*@Decs:function to Delete a field in mClass @Author:Jeeva*/
			public function DeleteClass()
			{
				if($this->input->post('type')==2)
				{
					$ClassUID=$this->input->post('ClassUID');	
					/*query to delete the row*/
					$this->db->where('ClassUID', $ClassUID);
					$mClass=$this->db->delete('mClass');
					$this->db->query($mClass);
					echo json_encode(array(
						"statusCode"=>200
					));
				} 
			}

			/*@Decs:function to Redirect the Class edit page @Author:Jeeva*/
			public function EditClassDetails()
			{   
				$ClassUID=$this->input->get('ClassUID');
				/*query to select the data in mClass table..*/
				$this->db->select('*');
				$this->db->where('ClassUID', $ClassUID);
				$this->db->from('mClass');
				$mClass=$this->db->get();
				$ClassData['ClassField']= $mClass->row();
				$this->load->view("include/Header");
				$this->load->view("include/sidebar");
				$this->load->view('ClassEditDetails',$ClassData);
			}

			/*Function to validate the  update Form Inputs @Author:Jeeva*/
			public function Upadte_post_validate()
			{
				$this->form_validation->set_rules('ClassName','ClassName','required');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				$this->form_validation->set_message('required', 'Enter %s  Required*');
				/* if function to check the above condition is true or not*/

				if($this->form_validation->run())
					/* Run if its true.*/
				{   /* Query to update the form values in to the table*/
					$ClassUID=$this->input->post("ClassUID");
					$ClassName=$this->input->post("ClassName");
					$Active=$this->input->post("Active");

					$mClass = array( 
						'ClassName' =>$ClassName, 
						'Active'=>$Active);
					$this->db->where('ClassUID',$ClassUID);
					$mClass=$this->db->update('mClass', $mClass);
					echo json_encode($mClass);
				}
				else
					{/*storing the error message in the error variable to diaplay in the field...*/
						$array = array(
							'error'   => true,
							'ClassName_error' => form_error('ClassName')
						);
						echo json_encode($array);
					}
				}
			}