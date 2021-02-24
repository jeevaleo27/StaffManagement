<html>
<head>
  <title></title>
</head>
<body>
  <div class="row grow w-99.8">	
    <div id="form" class="main col-12 h-100 py-2">
      <!--Form Starts-->
      <form class="Staff_Insert"  id="Staff_Insert" >
        <div class="form-group">

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffName">StaffName:*</label> 
            <input  class="form-control" type="text"   id="StaffName" name="StaffName" >
            <span id="StaffName_error" class="StaffName_error text-danger"></span>
          </div>

          <div class="form-group">
            <label for="StaffDOB">StaffDOB:</label><input type="date" id="StaffDOB" name="StaffDOB" >
            <span id="StaffDOB_error" class="StaffDOB_error text-danger"></span>
          </div>

          <div class="form-group">
            <label for="StaffMobileNumber">StaffMobileNumber:*</label><input class="form-control" type="text" id="StaffMobileNumber" name="StaffMobileNumber">
            <span id="StaffMobileNumber_error" class="StaffMobileNumber_error text-danger"></span>
          </div>

          <div class="form-group">
            <label for="StaffEMailID">StaffEMailID:*</label> <input class="form-control" type="email" id="StaffEMailID" name="StaffEMailID">
            <span id="StaffEMailID_error" class="StaffEMailID_error text-danger"></span>
          </div>

          <div class="form-group">
            <label for="StaffGender">StaffGender :Male:</label><input type="radio" id="male" name="StaffGender"  value="male" >
            <label for="StaffGender">Female:</label><input type="radio"  id="female" name="StaffGender" value="female" >
            <span id="StaffGender_error" class="StaffGender_error text-danger"></span>
          </div>

          <div class="form-group">
            QualificationUID*<select name = "QualificationUID" class="form-control" id="QualificationUID">
              <option value="">--select--</option>
              <?php 
              foreach ($QualificationField as $key => $row){ ?>
                <option value="<?php echo $row->QualificationUID; ?>"><?php echo $row->QualificationName; ?></option>
              <?php }?>
            </select> <span id="QualificationUID_error" class="QualificationUID_error text-danger"></span>
          </div>

          <div class="form-group">
            MaritalStatusUID*<select name ="MaritalStatusUID" class="form-control" id="MaritalStatusUID">
              <option value="">--select--</option>
              <?php 
              foreach ($MaritalStatusField as $key => $row){ ?>
                <option value="<?php echo $row->MaritalStatusUID; ?>"><?php echo $row->MaritalStatusName; ?></option>
              <?php }?>
            </select> <span id="MaritalStatusUID_error" class="MaritalStatusUID_error text-danger"></span>
          </div>

          <div class="form-group">
            DepartmentUID*<select name = "DepartmentUID" class="form-control" id="DepartmentUID">
              <option value="">--select--</option>
              <?php 
              foreach ($DepartmentField as $key => $row){ ?>
                <option value="<?php echo $row->DepartmentUID; ?>"><?php echo $row->DepartmentName; ?></option>
              <?php }?>
            </select> <span id="DepartmentUID_error" class="DepartmentUID_error text-danger"></span>
          </div>

          <div class="form-group">
            <label for="StaffAddress">StaffAddress</label><textarea id="StaffAddress" class="form-control" name="StaffAddress" > </textarea>
            <span id="StaffAddress_error" class="StaffAddress_error text-danger"></span>
          </div>

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffCity">StaffCity:*</label> 
            <input  class="form-control" type="text"   id="StaffCity" name="StaffCity" >
            <span id="StaffCity_error" class="StaffCity_error text-danger"></span>
          </div>

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffState">StaffState:*</label> 
            <input  class="form-control" type="text"   id="StaffState" name="StaffState" >
            <span id="StaffState_error" class="StaffState_error text-danger"></span>
          </div>

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffCountry">StaffCountry:*</label> 
            <input  class="form-control" type="text"   id="StaffCountry" name="StaffCountry" >
            <span id="StaffCountry_error" class="StaffCountry_error text-danger"></span>
          </div>

          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="StaffZipcode">StaffZipcode:*</label> 
            <input  class="form-control" type="text"   id="StaffZipcode" name="StaffZipcode" >
            <span id="StaffZipcode_error" class="StaffZipcode_error text-danger"></span>
          </div>


          <!-- student courese details-->
          <table class="table" id="myTable">
            <thead>
              <tr>

                <th>Course</th>
                <th>Duration_Of_Course</th>
                <th><input type="button" name="" value="+" 
                  onclick="addRor()"></th>
                </tr>
              </thead>
              <tbody>
                <tr>

                  <td>
                    ClassUID*<select name = "ClassUID[]" class="form-control" id="ClassUID">
                      <option value="">--select--</option>
                      <?php 
                      foreach ($ClassField as $key => $row){ ?>
                        <option value="<?php echo $row->ClassUID; ?>"><?php echo $row->ClassName; ?></option>
                      <?php }?>
                    </select> <span id="ClassUID_error" class="ClassUID_error text-danger"></span>
                  </td>
                  <td>
                    <label  class="col-sm-2 control-label" for="Time">Time*</label> 
                    <input  class="form-control" type="Time"   id="Time" name="Time[]" placeholder="hh:mm:ss" >
                    <span id="Time_error" class=" Time_error text-danger"></span>
                  </td>
                  <td><input type="button" id="addButton" class="btn btn-primary btn-xs" value="Add"/>
                    <input type="button" id="deleteButton" class="btn btn-primary btn-xs" value="Delete"/></td>
                  </tr>

                </tbody>
              </table>


              <div class="form-group">
                <button class="Staff_Submit" id="contact" value="submit" >Submit</button>
              </div>       
            </div>
          </form>
          <!--Form Ends-->
        </div>

      </body>
      <!--Script Starts-->
      <script type="text/javascript">
        $(document).ready(function(){
          $('.Staff_Insert').on('submit', function(event){
            event.preventDefault();
            $.ajax ({
              url:"<?php echo base_url();?>Staff/Staff_post_validate",
              method:"POST",
              data:$(this).serialize(),
              dataType:"json",
              success:function(data)
              {
                if(data.error==1)
                {
                  if(data.StaffName_error != '')
                  {
                    $('#StaffName_error').html(data.StaffName_error);
                  }
                  else
                  {
                    $('#StaffName_error').html('');
                  } 
                  if(data.StaffDOB_error != '')
                  {
                    $('#StaffDOB_error').html(data.StaffDOB_error);
                  }
                  else
                  {
                    $('#StaffDOB_error').html('');
                  } 
                  if(data.StaffMobileNumber_error != '')
                  {
                    $('#StaffMobileNumber_error').html(data.StaffMobileNumber_error);
                  }
                  else
                  {
                    $('#StaffMobileNumber_error').html('');
                  } 
                  if(data.StaffEMailID_error != '')
                  {
                    $('#StaffEMailID_error').html(data.StaffEMailID_error);
                  }
                  else
                  {
                    $('#StaffEMailID_error').html('');
                  } 
                  if(data.StaffGender_error != '')
                  {
                    $('#StaffGender_error').html(data.StaffGender_error);
                  }
                  else
                  {
                    $('#StaffGender_error').html('');
                  } 
                  if(data.QualificationUID_error != '')
                  {
                    $('#QualificationUID_error').html(data.QualificationUID_error);
                  }
                  else
                  {
                    $('#QualificationUID_error').html('');
                  } 
                  if(data.MaritalStatusUID_error != '')
                  {
                    $('#MaritalStatusUID_error').html(data.MaritalStatusUID_error);
                  }
                  else
                  {
                    $('#MaritalStatusUID_error').html('');
                  } 
                  if(data.DepartmentUID_error != '')
                  {
                    $('#DepartmentUID_error').html(data.DepartmentUID_error);
                  }
                  else
                  {
                    $('#DepartmentUID_error').html('');
                  } 
                  if(data.StaffAddress_error != '')
                  {
                    $('#StaffAddress_error').html(data.StaffAddress_error);
                  }
                  else
                  {
                    $('#StaffAddress_error').html('');
                  } 
                  if(data.StaffCity_error != '')
                  {
                    $('#StaffCity_error').html(data.StaffCity_error);
                  }
                  else
                  {
                    $('#StaffCity_error').html('');
                  } 
                  if(data.StaffState_error != '')
                  {
                    $('#StaffState_error').html(data.StaffState_error);
                  }
                  else
                  {
                    $('#StaffState_error').html('');
                  } 
                  if(data.StaffCountry_error != '')
                  {
                    $('#StaffCountry_error').html(data.StaffCountry_error);
                  }
                  else
                  {
                    $('#StaffCountry_error').html('');
                  } 
                  if(data.StaffZipcode_error != '')
                  {
                    $('#StaffZipcode_error').html(data.StaffZipcode_error);
                  }
                  else
                  {
                    $('#StaffZipcode_error').html('');
                  }
                  if(data && data.coursess)
                  {
                    var coursess = data.coursess;
                    coursess.forEach(function(value, key){
                      $('table tbody tr:nth-child(' + (key + 1 ) + ')').find('.ClassUID_error').html(value.ClassUID_error);
                    })
                  }
                  if (data && data.duration) 
                  {
                    var duration = data.duration;
                    duration.forEach(function(value, key){
                      $('table tbody tr:nth-child(' + (key + 1 ) + ')').find('.Time_error').html(value.Time_error);
                    })
                  }
           }
                else
                {
                  window.location.href='<?php echo base_url('Staff/index')?>';
                }
                $('#contact').attr('disabled', false);
              }
            })
});
});

$(function(){
  $("#addButton").click(function(){
    $(this).closest("tr").clone(true).appendTo("#myTable");
  });

  $("#deleteButton").click(function(){
//var x = document.getElementById("myTable").rows.length;
var x = $('#myTable tr').length;
if(x == 2){

} else {
  $(this).closest("tr").remove();
}

});
});
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<!--Script Ends-->
</html>



