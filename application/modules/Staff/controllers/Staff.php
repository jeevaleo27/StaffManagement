<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->helper(array('form','url'));
		$this->load->model('customers_model');

	}

	/*@Decs:function to view StaffDetails @Author:Jeeva*/
	public function index()
	{
		$d["content"]="StaffDetails";
		$this->load->view("page.php",$d);

	}

	/*Function to validate the Staff Form Inputs @Author:Jeeva*/
	public function Staff_post_validate()
	{
		/*second table input geting fields*/
		$ClassUID=$this->input->post("ClassUID");
		$Time=$this->input->post("Time");
		$this->form_validation->set_rules('StaffName','StaffName','required');
		$this->form_validation->set_rules('StaffDOB','StaffDOB','required');
		$this->form_validation->set_rules('StaffMobileNumber','StaffMobileNumber',
			'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('StaffEMailID','StaffEMailID','required|valid_email');
		$this->form_validation->set_rules('StaffGender','StaffGender','required');
		$this->form_validation->set_rules('QualificationUID','QualificationUID','required');
		$this->form_validation->set_rules('MaritalStatusUID','MaritalStatusUID','required');
		$this->form_validation->set_rules('DepartmentUID','DepartmentUID','required');
		$this->form_validation->set_rules('StaffAddress','StaffAddress','required');
		$this->form_validation->set_rules('StaffCity','StaffCity','required');
		$this->form_validation->set_rules('StaffState','StaffState','required');
		$this->form_validation->set_rules('StaffCountry','StaffCountry','required');
		$this->form_validation->set_rules('StaffZipcode','StaffZipcode','required');
		foreach ($ClassUID as $key => $value) {
			$this->form_validation->set_rules('ClassUID['.$key.']','ClassUID','required');
			$this->form_validation->set_rules('Time['.$key.']','Time','required');
		}
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Enter %s  Required*');
		/* if function to check the above condition is true or not*/

		if($this->form_validation->run()==true)
			/* Run if its true.*/
		{   /* Query to save the Staff form values in to the table*/
			$StaffName=$this->input->post("StaffName");
			$StaffDOB=$this->input->post("StaffDOB");
			$StaffMobileNumber=$this->input->post("StaffMobileNumber");
			$StaffEMailID=$this->input->post("StaffEMailID");
			$StaffGender=$this->input->post("StaffGender");
			$QualificationUID=$this->input->post("QualificationUID");
			$MaritalStatusUID=$this->input->post("MaritalStatusUID");
			$DepartmentUID=$this->input->post("DepartmentUID");
			$StaffAddress=$this->input->post("StaffAddress");
			$StaffCity=$this->input->post("StaffCity");
			$StaffState=$this->input->post("StaffState");
			$StaffCountry=$this->input->post("StaffCountry");
			$StaffZipcode=$this->input->post("StaffZipcode");
			/*store the form values into array formation.....*/
			$data= array(
				'StaffName'=>$StaffName,
				'StaffDOB'=>$StaffDOB,
				'StaffMobileNumber'=> $StaffMobileNumber,
				'StaffEMailID'=> $StaffEMailID,
				'StaffGender'=>$StaffGender ,
				'QualificationUID'=>$QualificationUID ,
				'MaritalStatusUID'=>$MaritalStatusUID ,
				'DepartmentUID'=>$DepartmentUID ,
				'StaffAddress'=>$StaffAddress,
				'StaffCity'=>$StaffCity ,
				'StaffState'=>$StaffState ,
				'StaffCountry'=>$StaffCountry ,
				'StaffZipcode'=>$StaffZipcode 
			);
			$insert = $this->db->insert('mStaff',$data);
			$last_id=$this->db->insert_id();
			foreach ($ClassUID as $key => $value) {
				/*using a multipledata array consept to store the course details....*/
				$MultipleData=[];
				$MultipleData['StaffUID']=$last_id;
				$MultipleData['ClassUID']=$ClassUID[$key];
				$MultipleData['Time']=$Time[$key];
				/*query to insert reg_cours_details table values....*/
				$mStaffTimeTable = $this->db->insert('mStaffTimeTable',$MultipleData);
			}
			/*config query to send a mail */
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'jeeva.silverdoller@gmail.com'; /*email id*/
			$config['smtp_pass'] = 'Jeeva@123'; /*email password*/
			$config['mailtype'] = 'html';
			$config['wordwrap'] = TRUE;
			$config['charset'] = 'iso-8859-1';
			$config['newline'] = "\r\n"; /*use double quotes here*/
			$this->email->initialize($config);
			$to_email =$this->input->post("StaffEMailID");
			/*send mail*/
			$this->email->from('jeeva.silverdoller@gmail.com',"jeeva");
			$this->email->to($to_email);
			$this->email->subject($StaffName);
			$this->email->message($QualificationUID);
			$this->email->send();
			$array = array(
				'error'   => 0
			);
			echo json_encode($array);
		}
		else
			{/*storing the error message in the error variable to diaplay in the field...*/
				$array = array(
					'error'   => 1,
					'StaffName_error' => form_error('StaffName'),
					'StaffDOB_error' => form_error('StaffDOB'),
					'StaffMobileNumber_error' => form_error('StaffMobileNumber'),
					'StaffEMailID_error' => form_error('StaffEMailID'),
					'StaffGender_error' => form_error('StaffGender'),
					'QualificationUID_error' => form_error('QualificationUID'),
					'MaritalStatusUID_error' => form_error('MaritalStatusUID'),
					'DepartmentUID_error' => form_error('DepartmentUID'),
					'StaffAddress_error' => form_error('StaffAddress'),
					'StaffCity_error' => form_error('StaffCity'),
					'StaffState_error' => form_error('StaffState'),
					'StaffCountry_error' => form_error('StaffCountry'),
					'StaffZipcode_error' => form_error('StaffZipcode')
				);
				$coursess=[];
				foreach ($ClassUID as $key => $value) {
					$coursess[(string)$key]=[ 'ClassUID_error' => form_error('ClassUID['.$key.']')];
					$duration[(string)$key]=[ 'Time_error' => form_error('Time['.$key.']')];
				}
				$array['coursess']=$coursess;
				$array['duration']=$duration;
				echo json_encode($array);
			}
		}	

		/*@Decs:function to VIEW Insert StaffDetails PAGE @Author:Jeeva*/
		public function InsertStaffDetails()
		{
			/* Query to get values from mQualification table */
			$FieldData['QualificationField']=$this->db->SELECT('QualificationUID,QualificationName')->from('mQualification')->get()->result();

			/* Query to get values from mMaritalStatus table */
			$FieldData['MaritalStatusField']=$this->db->SELECT('MaritalStatusUID,MaritalStatusName')->from('mMaritalStatus')->get()->result();

			/* Query to get values from mDepartment table */
			$FieldData['DepartmentField']=$this->db->SELECT('DepartmentUID,DepartmentName')->from('mDepartment')->get()->result();

			/* Query to get values from mClass table */
			$FieldData['ClassField']=$this->db->SELECT('ClassUID,ClassName')->from('mClass')->get()->result();
			$this->load->view("include/Header");
			$this->load->view("include/sidebar");
			$this->load->view('InsertStaffDetails',$FieldData);
		}

		/*to view a full values in the table reg_details in select_view page....*/
		public function ViewmStaff()
		{		


			$list = $this->customers_model->get_datatables();
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $mStaff) {

				$row = array();
				$row[] = $mStaff->StaffUID;
				$row[] = $mStaff->StaffName;
				$row[] = $mStaff->StaffDOB;
				$row[] = $mStaff->StaffMobileNumber;
				$row[] = $mStaff->StaffEMailID;
				$row[] = $mStaff->StaffGender;
				$row[] = $mStaff->QualificationName;
				$row[] = $mStaff->MaritalStatusName;
				$row[] = $mStaff->DepartmentName;
				$row[] = $mStaff->StaffAddress;
				$row[] = $mStaff->StaffCity;
				$row[] = $mStaff->StaffState;
				$row[] = $mStaff->StaffCountry;
				$row[] = $mStaff->StaffZipcode;
				$row[] = $mStaff->CreatedBy;
				$row[] = $mStaff->CreatedDateTime;
				$row[] = $mStaff->Active;
				$row[] = "<button type='button' class='btn btn-danger btn-sm' id='DeleteDetails'data-id='".$mStaff->StaffUID."'data-toggle='modal' data-target='#ShowDeleteDetails'>Delete</button></td>";

				
				$row[] = "<button type='button' class='btn btn-primary btn-sm edit'><a href=\"Staff/EditStaffDetails?StaffUID=".$mStaff->StaffUID."\" style='color:white;'>Edit</a></button></td>";
				$row[] = "<button type='button' id='StaffDetails' class='btn btn-success btn-sm view' data-toggle='modal' data-target='#ShowStaffDetails'
	data-StaffUID=".$mStaff->StaffUID."
	data-StaffName=".$mStaff->StaffName."
 	data-StaffDOB=".$mStaff->StaffDOB."
 	data-StaffMobileNumber=".$mStaff->StaffMobileNumber."
 	data-StaffEMailID=".$mStaff->StaffEMailID."
 	data-StaffGender=".$mStaff->StaffGender."
 	data-QualificationUID=".$mStaff->QualificationUID."
 	data-MaritalStatusUID=".$mStaff->MaritalStatusUID."
 	data-DepartmentUID=".$mStaff->DepartmentUID."
 	data-StaffAddress=".$mStaff->StaffAddress."
 	data-StaffCity=".$mStaff->StaffCity."
 	data-StaffState=".$mStaff->StaffState."
 	data-StaffCountry=".$mStaff->StaffCountry."
 	data-StaffZipcode=".$mStaff->StaffZipcode."
 	data-CreatedBy=".$mStaff->CreatedBy."
 	data-CreatedDateTime=".$mStaff->CreatedDateTime."
 	data-Active=".$mStaff->Active.">VIEW</button></td>";

				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->customers_model->count_all(),
				"recordsFiltered" => $this->customers_model->count_filtered(),
				"data" => $data,
			);
//output to json format
			echo json_encode($output);	
// $this->db->select('*')->from('mStaff')->join('mQualification','mQualification.QualificationUID = mStaff.QualificationUID','left');
// $this->db->join('mMaritalStatus','mMaritalStatus.MaritalStatusUID = mStaff.MaritalStatusUID','left');
// $this->db->join('mDepartment','mDepartment.DepartmentUID = mStaff.DepartmentUID','left');
// $mStaffTimeTable=$this->db->get();
// $data= $mStaffTimeTable->result();
// foreach($data as $row)
// {
// 	if($row->Active=="1"){
// 		$Active="yes";
// 	}
// 	else{
// 		$Active="no";
// 	}
// 	echo "<tr>";
// 	echo "<td>".$row->StaffUID."</td>";
// 	echo "<td>".$row->StaffName."</td>";
// 	echo "<td>".$row->StaffDOB."</td>";
// 	echo "<td>".$row->StaffMobileNumber."</td>";         
// 	echo "<td>".$row->StaffEMailID."</td>";
// 	echo "<td>".$row->StaffGender."</td>";
// 	echo "<td>".$row->QualificationName."</td>";
// 	echo "<td>".$row->MaritalStatusName."</td>";
// 	echo "<td>".$row->DepartmentName."</td>";
// 	echo "<td>".$row->StaffAddress."</td>";
// 	echo "<td>".$row->StaffCity."</td>";
// 	echo "<td>".$row->StaffState."</td>";
// 	echo "<td>".$row->StaffCountry."</td>";
// 	echo "<td>".$row->StaffZipcode."</td>";
// 	echo "<td>".$row->CreatedBy."</td>";
// 	echo "<td>".$row->CreatedDateTime."</td>";
// 	echo "<td>".$Active."</td>";
// 	echo "<td><button type='button' class='btn btn-danger btn-sm' id='DeleteDetails'data-id='".$row->StaffUID."'data-toggle='modal' data-target='#ShowDeleteDetails'>Delete</button></td>";
// 	echo "<td><button type='button' class='btn btn-primary btn-sm edit'><a href=\"Staff/EditStaffDetails?StaffUID=".$row->StaffUID."\" style='color:white;'>Edit</a></button></td>";
// 	/*coding to store a values as a attribute to show in the model*/
// 	echo "<td><button type='button' id='StaffDetails' class='btn btn-success btn-sm view' data-toggle='modal' data-target='#ShowStaffDetails'
// 	data-StaffUID=".$row->StaffUID."
// 	data-StaffName=".$row->StaffName."
// 	data-StaffDOB=".$row->StaffDOB."
// 	data-StaffMobileNumber=".$row->StaffMobileNumber."
// 	data-StaffEMailID=".$row->StaffEMailID."
// 	data-StaffGender=".$row->StaffGender."
// 	data-QualificationUID=".$row->QualificationName."
// 	data-MaritalStatusUID=".$row->MaritalStatusName."
// 	data-DepartmentUID=".$row->DepartmentName."
// 	data-StaffAddress=".$row->StaffAddress."
// 	data-StaffCity=".$row->StaffCity."
// 	data-StaffState=".$row->StaffState."
// 	data-StaffCountry=".$row->StaffCountry."
// 	data-StaffZipcode=".$row->StaffZipcode."
// 	data-CreatedBy=".$row->CreatedBy."
// 	data-CreatedDateTime=".$row->CreatedDateTime."
// 	data-Active=".$Active."
// 	>VIEW</button></td>";
// 	echo "</tr>";
// }	
		}

		/*@Decs:function to Delete a field in mStaff @Author:Jeeva*/
		public function DeleteStaff()
		{
			if($this->input->post('type')==2)
			{
				$StaffUID=$this->input->post('StaffUID');	
				/*query to delete mStaffTimeTable,mStaff row*/
				$mStaffTimeTable=$this->db->where('StaffUID',$StaffUID)->delete('mStaffTimeTable');
				$mStaffTimeTable=$this->db->where('StaffUID',$StaffUID)->delete('mStaff');
				echo json_encode(array(
					"statusCode"=>200
				));
			} 
		}

		/*@Decs:function to Redirect the Staff edit page @Author:Jeeva*/
		public function EditStaffDetails()
		{   
			$StaffUID=$this->input->get('StaffUID');

			/* Query to get values from mQualification table */
			$FieldData['QualificationField']=$this->db->SELECT('QualificationUID,QualificationName')->from('mQualification')->get()->result();

			/* Query to get values from mMaritalStatus table */
			$FieldData['MaritalStatusField']=$this->db->SELECT('MaritalStatusUID,MaritalStatusName')->from('mMaritalStatus')->get()->result();

			/* Query to get values from mDepartment table */
			$FieldData['DepartmentField']=$this->db->SELECT('DepartmentUID,DepartmentName')->from('mDepartment')->get()->result();

			/* Query to get values from mStaffTimeTable table */
			$FieldData['StaffTimeTableField']=$this->db->SELECT('*')->from('mStaffTimeTable')->where('StaffUID',$StaffUID)->get()->result();

			/* Query to get values from mStaff table */
			$FieldData['StaffField']=$this->db->SELECT('*')->from('mStaff')->where('StaffUID',$StaffUID)->get()->row();

			/* Query to get values from mClass table */
			$FieldData['ClassField']=$this->db->SELECT('ClassUID,ClassName')->from('mClass')->get()->result();

			$this->load->view("include/Header");
			$this->load->view("include/sidebar");
			$this->load->view('StaffEditDetails',$FieldData);
		}

		/*Function to validate the update Staff Form Inputs @Author:Jeeva*/
		public function Upadte_Staff_post_validate()
		{

			$ClassUID=$this->input->post("ClassUID");
			$Time=$this->input->post("Time");
			$this->form_validation->set_rules('StaffName','StaffName','required');
			$this->form_validation->set_rules('StaffDOB','StaffDOB','required');
			$this->form_validation->set_rules('StaffMobileNumber','StaffMobileNumber',
				'required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('StaffEMailID','StaffEMailID','required|valid_email');
			$this->form_validation->set_rules('StaffGender','StaffGender','required');
			$this->form_validation->set_rules('QualificationUID','QualificationUID','required');
			$this->form_validation->set_rules('MaritalStatusUID','MaritalStatusUID','required');
			$this->form_validation->set_rules('DepartmentUID','DepartmentUID','required');
			$this->form_validation->set_rules('StaffAddress','StaffAddress','required');
			$this->form_validation->set_rules('StaffCity','StaffCity','required');
			$this->form_validation->set_rules('StaffState','StaffState','required');
			$this->form_validation->set_rules('StaffCountry','StaffCountry','required');
			$this->form_validation->set_rules('StaffZipcode','StaffZipcode','required');

			foreach ($ClassUID as $key => $value) {
				$this->form_validation->set_rules('ClassUID['.$key.']','ClassUID','required');
				$this->form_validation->set_rules('Time['.$key.']','Time','required');
			}
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_message('required', 'Enter %s  Required*');
			/* if function to check the above condition is true or not*/

			if($this->form_validation->run())
				/* Run if its true.*/
			{   
				$StaffUID=$this->input->post("StaffUID");
				$mStaffTimeTable=$this->db->where('StaffUID',$StaffUID)->delete('mStaffTimeTable');

				/* Query to save the Staff form values in to the table*/
				$StaffUID=$this->input->post("StaffUID");
				$StaffName=$this->input->post("StaffName");
				$StaffDOB=$this->input->post("StaffDOB");
				$StaffMobileNumber=$this->input->post("StaffMobileNumber");
				$StaffEMailID=$this->input->post("StaffEMailID");
				$StaffGender=$this->input->post("StaffGender");
				$QualificationUID=$this->input->post("QualificationUID");
				$MaritalStatusUID=$this->input->post("MaritalStatusUID");
				$DepartmentUID=$this->input->post("DepartmentUID");
				$StaffAddress=$this->input->post("StaffAddress");
				$StaffCity=$this->input->post("StaffCity");
				$StaffState=$this->input->post("StaffState");
				$StaffCountry=$this->input->post("StaffCountry");
				$StaffZipcode=$this->input->post("StaffZipcode");
				$Active=$this->input->post("Active");

				$mStaff=array
				( 'StaffName'=>$StaffName,
					'StaffDOB'=>$StaffDOB,
					'StaffMobileNumber'=>$StaffMobileNumber,
					'StaffEMailID'=>$StaffEMailID,
					'StaffGender'=>$StaffGender ,
					'QualificationUID'=>$QualificationUID ,
					'MaritalStatusUID'=>$MaritalStatusUID ,
					'DepartmentUID'=>$DepartmentUID ,
					'StaffAddress'=>$StaffAddress,
					'StaffCity'=>$StaffCity,
					'StaffState'=>$StaffState,
					'StaffCountry'=>$StaffCountry,
					'StaffZipcode'=>$StaffZipcode, 
					'Active'=>$Active);

				$mStaff=$this->db->where('StaffUID',$StaffUID)->update('mStaff', $mStaff);

				foreach ($ClassUID as $key => $value) {
					/*using a multipledata array consept to store the course details....*/
					$MultipleData=[];
					$MultipleData['StaffUID']=$StaffUID;
					$MultipleData['ClassUID']=$ClassUID[$key];
					$MultipleData['Time']=$Time[$key];
					/*query to insert reg_cours_details table values....*/
					$mStaffTimeTable = $this->db->insert('mStaffTimeTable',$MultipleData);
				}
				/*config query to send a mail*/
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'ssl://smtp.gmail.com';
				$config['smtp_port'] = '465';
				$config['smtp_user'] = 'jeeva.silverdoller@gmail.com'; /* email id*/
				$config['smtp_pass'] = 'Jeeva@123'; /* email password*/
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$config['charset'] = 'iso-8859-1';
				$config['newline'] = "\r\n"; /*use double quotes here*/
				$this->email->initialize($config);

				$to_email =$this->input->post("StaffEMailID");

				/*send mail*/
				$this->email->from('jeeva.silverdoller@gmail.com',"jeeva");
				$this->email->to($to_email);
				$this->email->subject($StaffName);
				$this->email->message($QualificationUID);
				$this->email->send();
				$array = array(
					'error'   => 0
				);
				echo json_encode($array);
			}
			else
				{/*storing the error message in the error variable to diaplay in the field...*/
					$array = array(
						'error'   => 1,
						'StaffName_error' => form_error('StaffName'),
						'StaffDOB_error' => form_error('StaffDOB'),
						'StaffMobileNumber_error' => form_error('StaffMobileNumber'),
						'StaffEMailID_error' => form_error('StaffEMailID'),
						'StaffGender_error' => form_error('StaffGender'),
						'QualificationUID_error' => form_error('QualificationUID'),
						'MaritalStatusUID_error' => form_error('MaritalStatusUID'),
						'DepartmentUID_error' => form_error('DepartmentUID'),
						'StaffAddress_error' => form_error('StaffAddress'),
						'StaffCity_error' => form_error('StaffCity'),
						'StaffState_error' => form_error('StaffState'),
						'StaffCountry_error' => form_error('StaffCountry'),
						'StaffZipcode_error' => form_error('StaffZipcode')
					);
					$coursess=[];
					foreach ($ClassUID as $key => $value) {
						$coursess[(string)$key]=[ 'ClassUID_error' => form_error('ClassUID['.$key.']')];
						$duration[(string)$key]=[ 'Time_error' => form_error('Time['.$key.']')];
					}
					$array['coursess']=$coursess;
					$array['duration']=$duration;
					echo json_encode($array);
				}
			}
		}


