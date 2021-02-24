<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StaffTimeTable extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');

	}

	/*@Decs:function to view ClassDetails @Author:Jeeva*/
	public function index()
	{
		$d["content"]="StaffTimeTableDetails";
		$this->load->view("page.php",$d);

	}

	/*Function to validate the Department Form Inputs @Author:Jeeva*/
	public function StaffTimeTable_post_validate()
	{
		$this->form_validation->set_rules('StaffUID','StaffUID','required');
		$this->form_validation->set_rules('ClassUID','ClassUID','required');
		$this->form_validation->set_rules('Time','Time','required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Enter %s  Required*');
		/* if function to check the above condition is true or not*/

		if($this->form_validation->run())
			/* Run if its true.*/
		{   /* Query to save the Department form values in to the table*/
			$ClassUID=$this->input->post("ClassUID");
			$StaffUID=$this->input->post("StaffUID");
			$Time=$this->input->post("Time");
			$data= array(
				'ClassUID'=>$ClassUID,
				'StaffUID'=>$StaffUID,
				'Time'=>$Time
			);
			/*....query to insert into mClass table...*/
			$insert = $this->db->insert('mStaffTimeTable',$data);
			echo json_encode($insert);
		}
		else
			{/*storing the error message in the error variable to diaplay in the field...*/
				$array = array(
					'error'   => true,
					'StaffUID_error' => form_error('StaffUID'),
					'ClassUID_error' => form_error('ClassUID'),
					'Time_error' => form_error('Time')
				);
				echo json_encode($array);
			}
		}	

		/*@Decs:function to VIEW Insert ClassDetails PAGE @Author:Jeeva*/
		public function InsertStaffTimeTableDetails()
		{
			$FieldData['StaffField']=$this->db->select('StaffUID,StaffName')->from('mStaff')->get()->result();
			$FieldData['ClassField']=$this->db->select('ClassUID,ClassName')->from('mClass')->get()->result();
			$this->load->view("include/Header");
			$this->load->view("include/sidebar");
			$this->load->view('InsertStaffTimeTableDetails',$FieldData);
		}

		/*@Decs:function to View mClass in data table @Author:Jeeva*/
		public function ViewmStaffTimeTable()
		{			
			$this->db->select('*');
			$this->db->from('mStaffTimeTable');
			$this->db->join('mClass','mClass.ClassUID = mStaffTimeTable.ClassUID','left');
			$this->db->join('mStaff','mStaff.StaffUID = mStaffTimeTable.StaffUID','left');
			$mStaffTimeTable=$this->db->get();
			$data= $mStaffTimeTable->result();
			foreach($data as $row)
			{

				if($row->Active=="1"){
					$Active="yes";
				}
				else{
					$Active="no";
				}
				echo "<tr>";
				echo "<td>".$row->StaffTimeTableUID."</td>";
				echo "<td>".$row->ClassName ."</td>";
				echo "<td>".$row->StaffName."</td>";
				echo "<td>".$row->Time."</td>";
				echo "<td>".$row->CreatedBy."</td>";
				echo "<td>".$row->CreatedDateTime."</td>";    
				echo "<td>".$Active."</td>";
				echo "<td><button type='button' class='btn btn-danger btn-sm' id='DeleteDetails' data-id='".$row->StaffTimeTableUID."' data-toggle='modal' data-target='#ShowDeleteDetails'>Delete</button></td>";
				echo "<td><button type='button' class='btn btn-primary btn-sm edit'><a href=\"StaffTimeTable/EditStaffTimeTableDetails?StaffTimeTableUID=".$row->StaffTimeTableUID."\" style='color:white;'>Edit</a></button></td>";
				/*coding to store a values as a attribute to show in the model*/
				echo "<td><button type='button' id='StaffTimeTableDetails' class='btn btn-success btn-sm view'  data-toggle='modal' data-target='#ShowStaffTimeTableDetails'
				data-ClassUID=".$row->ClassUID."
				data-Time=".$row->Time."
				data-StaffUID=".$row->StaffUID."
				data-CreatedDateTime=".$row->CreatedDateTime."
				data-Active=".$Active."
				>VIEW</button></td>";
				echo "</tr>";
			}	
		}

		/*@Decs:function to Delete a field in mClass @Author:Jeeva*/
		public function DeleteStaffTimeTable()
		{
			if($this->input->post('type')==2)
			{
				$StaffTimeTableUID=$this->input->post('StaffTimeTableUID');	
				/*query to delete the row*/
				$mStaffTimeTable=$this->db->where('StaffTimeTableUID', $StaffTimeTableUID)->delete('mStaffTimeTable');
				echo json_encode(array(
					"statusCode"=>200
				));
			} 
		}

		/*@Decs:function to Redirect the Class edit page @Author:Jeeva*/
		public function EditStaffTimeTableDetails()
		{   
			$StaffTimeTableUID=$this->input->get('StaffTimeTableUID');

			/* Query to get values from mStaff table */
			$FieldData['StaffField']=$this->db->select('StaffUID,StaffName')->from('mStaff')->get()->result();

			/* Query to get values from mClass table */
			$FieldData['ClassField']=$this->db->select('ClassUID,ClassName')->from('mClass')->get()->result();

			/* Query to get values from mStaffTimeTable table */
			$FieldData['StaffTimeTableField']=$this->db->select('*')->from('mStaffTimeTable')->where('StaffTimeTableUID', $StaffTimeTableUID)->get()->row();
			$this->load->view("include/Header");
			$this->load->view("include/sidebar");
			$this->load->view('StaffTimeTableEditDetails',$FieldData);
		}

		/*Function to validate the update StaffTimeTable Form Inputs @Author:Jeeva*/
		public function Update_StaffTimeTable_post_validate()
		{

			$this->form_validation->set_rules('StaffUID','StaffUID','required');
			$this->form_validation->set_rules('ClassUID','ClassUID','required');
			$this->form_validation->set_rules('Time','Time','required');

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_message('required', 'Enter %s  Required*');
			/* if function to check the above condition is true or not*/

			if($this->form_validation->run())
				/* Run if its true.*/
			{   $StaffTimeTableUID=$this->input->post("StaffTimeTableUID");
			$ClassUID=$this->input->post("ClassUID");
			$StaffUID=$this->input->post("StaffUID");
			$Time=$this->input->post("Time");
			$Active=$this->input->post("Active");

			$mStaffTimeTable=array
			( 'StaffUID'=>$StaffUID,
				'ClassUID'=>$ClassUID,
				'Time'=>$Time,
				'Active'=>$Active);
			$mStaffTimeTable=$this->db->where('StaffTimeTableUID',$StaffTimeTableUID)->update('mStaffTimeTable', $mStaffTimeTable);

			echo json_encode($mStaffTimeTable);
		}
		else
			{/*storing the error message in the error variable to diaplay in the field...*/
				$array = array(
					'error'   => true,
					'StaffUID_error' => form_error('StaffUID'),
					'ClassUID_error' => form_error('ClassUID'),
					'Time_error' => form_error('Time')
				);
				echo json_encode($array);
			}
		}
	}
