<html>
<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.dataTables.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.dataTables.min.css">

<body>
  <div class="row grow w-99.8">	
    <div id="form" class="main col-12 h-100 py-2">			
      <!-- <table id="example" class="table table-bordered table-sm display nowrap" > -->
     <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>  
            <button type='button' class='btn btn-primary  btn-sm edit'><a href="<?php echo base_url('Staff/InsertStaffDetails')?>" style='color:white;'>Create_Staff_Details</a>
            </button>
            <th>StaffUID</th>
            <th>StaffName </th>
            <th>StaffDOB </th>
            <th>StaffMobileNumber</th>
            <th>StaffEMailID</th>
            <th>StaffGender</th>
            <th>QualificationUID</th>
            <th>MaritalStatusUID</th>
            <th>DepartmentUID</th>
            <th>StaffAddress</th>
            <th>StaffCity</th>
            <th>StaffState </th>
            <th>StaffCountry</th>
            <th>StaffZipcode</th>
            <th>CreatedBy</th>
            <th>CreatedDateTime</th>	
            <th>Active</th>	
            <th>Delete</th>
            <th>Edit</th>
            <th>View</th>	
          </tr>
        </thead>
        <!-- <tbody id="table"> -->
          <tbody>

          <!-- values that diaplayed in this area.....-->
        </tbody>
        <tfoot>
          <th>StaffUID</th>
          <th>StaffName </th>
          <th>StaffDOB </th>
          <th>StaffMobileNumber</th>
          <th>StaffEMailID</th>
          <th>StaffGender</th>
          <th>QualificationUID</th>
          <th>MaritalStatusUID</th>
          <th>DepartmentUID</th>
          <th>StaffAddress</th>
          <th>StaffCity</th>
          <th>StaffState </th>
          <th>StaffCountry</th>
          <th>StaffZipcode</th>
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
  <div class="modal fade" id="ShowStaffDetails">
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
            <label  class="col-sm-2 control-label" for="StaffName">StaffName:*</label> 
            <input  class="form-control" type="text"   id="StaffName" name="StaffName" >
          </div>

          <div class="form-group">
            <label for="StaffDOB">StaffDOB:</label><input type="date" id="StaffDOB" name="StaffDOB" >
          </div>

          <div class="form-group">
            <label for="StaffMobileNumber">StaffMobileNumber:*</label><input class="form-control" type="text" id="StaffMobileNumber" name="StaffMobileNumber">
          </div>

          <div class="form-group">
            <label for="StaffEMailID">StaffEMailID:*</label> <input class="form-control" type="email" id="StaffEMailID" name="StaffEMailID">
          </div>

          <div class="form-group">
            <label for="StaffGender">StaffGender :Male:</label><input type="radio" id="male" name="StaffGender"  value="male" >
            <label for="StaffGender">Female:</label><input type="radio"  id="female" name="StaffGender" value="female" >
          </div>

          <div class="form-group">
            QualificationUID*<input name = "QualificationUID" class="form-control" id="QualificationUID">
          </div>

          <div class="form-group">
            MaritalStatusUID*<input name ="MaritalStatusUID" class="form-control" id="MaritalStatusUID">
          </div>

          <div class="form-group">
            DepartmentUID*<input name = "DepartmentUID" class="form-control" id="DepartmentUID">
          </div>

          <div class="form-group">
            s<label for="StaffAddress">StaffAddress</label><textarea id="StaffAddress" class="form-control" name="StaffAddress" > </textarea>
          </div>

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffCity">StaffCity:*</label> 
            <input  class="form-control" type="text"   id="StaffCity" name="StaffCity" >
          </div>

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffState">StaffState:*</label> 
            <input  class="form-control" type="text"   id="StaffState" name="StaffState" >
          </div>

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffCountry">StaffCountry:*</label> 
            <input  class="form-control" type="text"   id="StaffCountry" name="StaffCountry" >
          </div>

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffZipcode">StaffZipcode:*</label> 
            <input  class="form-control" type="text"   id="StaffZipcode" name="StaffZipcode" >
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
          <input type="text" name="ClassName" id="data-id" value="" >
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
<Script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></Script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script> -->
<script>




var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Staff/ViewmStaff')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
            "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                scrollY:"300px",
                scrollX:true,
                scrollCollapse:true,
                paging:false,
                buttons: [
                    'excel',
                    'pdf',
                    'print']
            }
        ],
        },
        ],
 
    });
 
  /*to view a full Table in Data table formate @author:Jeeva*/
  // $(document).ready(function() 
  // {
  //   $.ajax
  //   ({
  //     url: "<?php //echo base_url("Staff/ViewmStaff");?>",
  //     type: "POST",
  //     cache: false,
  //     success: function(dataResult){
  //       $('#table').html(dataResult); 
  //       $('#example').DataTable
  //       ({
  //         dom: 'Bfrtip',
  //         buttons:
  //         [
  //         'copy', 'excel', 'pdf', 'print'
  //         ],
  //         scrollY:        "300px",
  //         scrollX:        true,
  //         scrollCollapse: true,
  //         paging:         false,
  //         fixedColumns:   {
  //           leftColumns: 1,
  //           rightColumns: 3
  //         }
  //       });}
  //     });

  //   /*Script to delete the field using "data-id" @author:Jeeva */


  //   $(document).on("click", ".delete", function()
  //   { 
  //     var $ele = $(this).parent().parent();
  //     $.ajax({
  //       url: "<?php //echo base_url("Staff/DeleteStaff");?>",
  //       type: "POST",
  //       cache: false,
  //       data: {
  //         type: 2,
  //         StaffUID: $(this).attr("data-id")
  //       },
  //       success: function(dataResult){

  //         var dataResult = JSON.parse(dataResult);
  //         if(dataResult.statusCode==200){
  //           $ele.fadeOut().remove();
  //           window.location.href='<?php //echo base_url('Staff/index')?>';
  //         }
  //       }
  //     });

  //   });

  //   /* function to perform the modal function @author:Jeeva*/
    $(function () {
      $(document).on("click", "#StaffDetails", function(event) { 
        var StaffUID = $(this).attr('data-StaffUID');
        var StaffName = $(this).attr('data-StaffName');
        var StaffDOB = $(this).attr('data-StaffDOB');
        var StaffMobileNumber = $(this).attr('data-StaffMobileNumber');
        var StaffEMailID = $(this).attr('data-StaffEMailID');
        var StaffGender = $(this).attr('data-StaffGender');
        var QualificationUID = $(this).attr('data-QualificationUID');
        var MaritalStatusUID = $(this).attr('data-MaritalStatusUID');
        var DepartmentUID = $(this).attr('data-DepartmentUID');
        var StaffAddress = $(this).attr('data-StaffAddress');
        var StaffCity = $(this).attr('data-StaffCity');
        var StaffState = $(this).attr('data-StaffState');
        var StaffCountry = $(this).attr('data-StaffCountry');
        var StaffZipcode = $(this).attr('data-StaffZipcode');
        var Active = $(this).attr('data-Active');
        console.log(StaffName);
        var modal = $('#ShowStaffDetails');
        modal.find('#StaffName').val(StaffName);
        modal.find('#StaffDOB').val(StaffDOB);
        modal.find('#StaffMobileNumber').val(StaffMobileNumber);
        modal.find('#StaffEMailID').val(StaffEMailID);
        modal.find('#StaffGender').val(StaffGender);
        modal.find('#QualificationUID').val(QualificationUID);
        modal.find('#MaritalStatusUID').val(MaritalStatusUID);
        modal.find('#DepartmentUID').val(DepartmentUID);
        modal.find('#StaffAddress').val(StaffAddress);
        modal.find('#StaffCity').val(StaffCity);
        modal.find('#StaffState').val(StaffState);
        modal.find('#StaffCountry').val(StaffCountry);
        modal.find('#StaffZipcode').val(StaffZipcode);
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
