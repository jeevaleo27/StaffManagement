<html>
	 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<body>
	<div class="row grow w-99.8">	
        <div id="form" class="main col-12 h-100 py-2">			
			<table id="example" class="table table-bordered table-sm display nowrap" >
				<thead>
					<tr>  
						<button type='button' class='btn btn-primary  btn-sm edit'><a href="<?php echo base_url('StaffTimeTable/InsertStaffTimeTableDetails')?>" style='color:white;'>Create_StaffTimeTable_Details</a>
						</button>
							<th>StaffTimeTableUID</th>
							<th>StaffUID </th>
							<th>ClassUID</th>
							<th>Time</th>
							<th>CreatedBy</th>
							<th>CreatedDateTime</th>	
							<th>Active</th>	
							<th>Delete</th>
							<th>Edit</th>
							<th>View</th>	
					</tr>
				</thead>
				<tbody id="table">

      					<!-- values that diaplayed in this area.....-->
                </tbody>
                <tfoot>
                    	   <th>StaffTimeTableUID</th>
							<th>StaffUID </th>
							<th>ClassUID</th>
							<th>Time</th>
							<th>CreatedBy</th>
							<th>CreatedDateTime</th>	
							<th>Active</th>	
							<th>Delete</th>
							<th>Edit</th>
							<th>View</th>
                </tfoot>
			</table>		
	    </div>
	</div>

	 <!-- The Modal -->
  	<div class="modal fade" id="ShowStaffTimeTableDetails">
   	  <div class="modal-dialog">
      	<div class="modal-content">
      
        	<!-- Modal Header -->
        	<div class="modal-header">
	          	<h4 class="modal-title">Modal Heading</h4>
	          	<button type="button" class="close" data-dismiss="modal">×</button>
        	</div>
        
        	<!-- Modal body -->
        	<div class="modal-body">
         		<div class="form-group form-group-sm">
	              	<label  class="col-sm-2 control-label" for="StaffUID">StaffUID*</label> <br>
	              	<input type="text" name="StaffUID"id="StaffUID" > 
         		</div>
         		<div class="form-group form-group-sm">
	              	<label  class="col-sm-2 control-label" for="ClassUID">ClassUID*</label> <br>
	              	<input type="text" name="ClassUID"id="ClassUID" > 
         		</div>
         		<div class="form-group form-group-sm">
	              	<label  class="col-sm-2 control-label" for="Time">Time*</label> <br>
	              	<input type="text" name="Time"id="Time" > 
         		</div>

         		<div class="form-group form-group-sm">
	              	<label  class="col-sm-2 control-label" for="Active">Active*</label> <br>
	              	<input type="text" name="Active"id="Active"  > 
         		</div>
        	</div>
        
        	<!-- Modal footer -->
        	<div class="modal-footer">
          	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        	</div>
        
        </div>
      </div>
    </div>


    <!-- Delete Modal -->
  	<div class="modal fade" id="ShowDeleteDetails">
   	  <div class="modal-dialog">
      	<div class="modal-content">
      
        	<!--Delete Modal Header -->
        	<div class="modal-header">
          	<h4 class="modal-title">Delete Modal</h4>
          	<button type="button" class="close" data-dismiss="modal">×</button>
        	</div>
        
        	<!-- Modal body -->
        	<div class="modal-body">
         		<p>Do you want to delete....?</p>
        	</div>
        
        	<!-- Modal footer -->
        	<div class="modal-footer">
        	<button type="button" class="btn btn-danger delete" data-id=" ">Delete</button>
          	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        	</div>
        
        </div>
      </div>
    </div>

     
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script>
	/*to view a full Table in Data table formate @author:Jeeva*/
    $(document).ready(function() 
    {
	            $.ajax
	            ({
		            url: "<?php echo base_url("StaffTimeTable/ViewmStaffTimeTable");?>",
		            type: "POST",
		            cache: false,
		            success: function(dataResult){
			        $('#table').html(dataResult); 
			        $('#example').DataTable
			        ({
                  		dom: 'Bfrtip',
                  		buttons:
                       	[
                         'copy', 'excel', 'pdf', 'print'
                      	 ]
                    });}
	            });
     			
     			/*Script to delete the field using "data-id" @author:Jeeva */


     			$(document).on("click", ".delete", function()
     			{ 
     				
		            var $ele = $(this).parent().parent();
		            $.ajax({
			                  url: "<?php echo base_url("StaffTimeTable/DeleteStaffTimeTable");?>",
			                  type: "POST",
			                  cache: false,
			                  data: {
				                  		type: 2,
				                  		StaffTimeTableUID: $(this).attr("data-id")
			                      	},
			                       success: function(dataResult){
				                   var dataResult = JSON.parse(dataResult);
				                   if(dataResult.statusCode==200){
					               $ele.fadeOut().remove();
					                window.location.href='<?php echo base_url('StaffTimeTable/index')?>';
				                   }
			                       }
		                    });
		        
	            });

     			 /* function to perform the modal function @author:Jeeva*/
	            $(function () {
                    $(document).on("click", "#StaffTimeTableDetails", function(event) { 
               			var StaffTimeTableUID = $(this).attr('data-StaffTimeTableUID');
               			var StaffUID = $(this).attr('data-StaffUID');
               			var ClassUID = $(this).attr('data-ClassUID');
               			var Time = $(this).attr('data-Time');
               			var Active = $(this).attr('data-Active');
                		console.log(Active);
                		var modal = $('#ShowStaffTimeTableDetails');
                		modal.find('#StaffUID').val(StaffUID);
                		modal.find('#ClassUID').val(ClassUID);
                		modal.find('#Time').val(Time);
                		modal.find('#Active').val(Active);
                
                    });
       			});


       			$(function () {
	                    $(document).on("click", "#DeleteDetails", function(event) { 
               			var dataid = $(this).attr('data-id');
                		console.log(dataid);
                		var modal = $('#ShowDeleteDetails');
                		modal.find('.delete').attr('data-id', dataid);
                    });
       			});
    });
</script>
</html>
