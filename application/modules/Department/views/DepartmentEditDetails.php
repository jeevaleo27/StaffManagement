<html>
<head>
</head>
<body>
  <div class="row grow w-99.8">	
    <div id="form" class="main col-12 h-100 py-2">
      <!--Form stars-->
      <form class="Department_Insert"  id="Department_Insert" >

        <!--button to move Department Data tab;le page-->
        <button type='button' class='btn btn-primary  btn-sm edit'><a href="<?php echo base_url('Department/index')?>" style='color:white;'>Back</a>
        </button>

        <div class="form-group">
          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="DepartmentName">DepartmentName:*</label> 
            <input  class="form-control" type="text"   id="DepartmentName" name="DepartmentName" 
            value="<?php echo $DepartmentField->DepartmentName; ?>">
            <span id="DepartmentName_error" class=" DepartmentName_error text-danger"></span>
          </div>

          <div class="form-group">
            <div class="form-group form-group-sm">
              <label  class="control-label" for="Active">Active:*</label> 
              <input   type="checkbox"   id="Active" name="Active" 
              value="1" <?php $check=explode(",",$DepartmentField->Active); echo in_array('1',$check)?'checked="checked"' : '' ;?>>
              <span id="Active_error" class=" Active_error text-danger"></span>
            </div>

            <div>
              <input type="hidden" name="DepartmentUID" id="DepartmentUID" class="DepartmentUID" value="<?php echo $DepartmentField->DepartmentUID; ?>">
            </div>

            <div class="form-group">
              <button class="Edit_Department_Details" id="contact" value="submit" >Submit</button>
            </div>

          </div>
        </form>
        <!--Form Ends-->
      </div>
    </div>
  </body>
  <!--Script Starts-->
  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.12.4.js')?>"></script>

  <script type="text/javascript">

    $(document).ready(function(){
      $('.Department_Insert').on('submit', function(event){
        event.preventDefault();
        $.ajax ({
          url:"<?php echo base_url();?>Department/Upadte_Department_post_validate",
          method:"POST",
          data:$(this).serialize(),
          dataType:"json",
          success:function(data)
          {
            if(data.error)
            {
              if(data.DepartmentName_error != '')
              {
                $('#DepartmentName_error').html(data.DepartmentName_error);
              }
              else
              {
                $('#DepartmentName_error').html('');
              } 
            }
            else
            {
              window.location.href='<?php echo base_url('Department/index')?>';
            }
            $('#contact').attr('disabled', false);
          }
        })
      });
    });  







  </script>
  <!--Script Ends-->
  </html>

