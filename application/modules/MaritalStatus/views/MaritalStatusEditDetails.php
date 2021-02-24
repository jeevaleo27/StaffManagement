<html>
	<head>
	</head>
	<body>
<div class="row grow w-99.8">	
	<div id="form" class="main col-12 h-100 py-2">
		<!--Form stars-->
    	<form class="MaritalStatus_Insert"  id="MaritalStatus_Insert" >

    		<!--button to move MaritalStatus Data tab;le page-->
    		<button type='button' class='btn btn-primary  btn-sm edit'><a href="<?php echo base_url('MaritalStatus/index')?>" style='color:white;'>Back</a>
            </button>

			<div class="form-group">
    			<div class="form-group form-group-sm">
              	<label  class="col-sm-2 control-label" for="MaritalStatusName">MaritalStatusName:*</label> 
              	<input  class="form-control" type="text"   id="MaritalStatusName" name="MaritalStatusName" 
              	 value="<?php echo $MaritalStatusField->MaritalStatusName; ?>">
              	<span id="MaritalStatusName_error" class=" MaritalStatusName_error text-danger"></span>
         	</div>

         	<div class="form-group">
    			<div class="form-group form-group-sm">
              	<label  class="control-label" for="Active">Active:*</label> 
              	<input   type="checkbox"   id="Active" name="Active" 
              	 value="1" <?php $check=explode(",",$MaritalStatusField->Active); echo in_array('1',$check)?'checked="checked"' : '' ;?>>
              	<span id="Active_error" class=" Active_error text-danger"></span>
         	</div>

         	<div>
         		<input type="hidden" name="MaritalStatusUID" id="MaritalStatusUID" class="MaritalStatusUID" value="<?php echo $MaritalStatusField->MaritalStatusUID; ?>">
         	</div>

			<div class="form-group">
              <button class="Edit_MaritalStatus_Details" id="contact" value="submit" >Submit</button>
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
           $('.MaritalStatus_Insert').on('submit', function(event){
            event.preventDefault();
              $.ajax ({
                  url:"<?php echo base_url();?>MaritalStatus/Upadte_MaritalStatus_post_validate",
                  method:"POST",
                  data:$(this).serialize(),
                  dataType:"json",
                  success:function(data)
                {
                  if(data.error)
                  {
                        if(data.MaritalStatusName_error != '')
                        {
                          $('#MaritalStatusName_error').html(data.MaritalStatusName_error);
                        }
                        else
                        {
                          $('#MaritalStatusName_error').html('');
                        } 
                  }
                  else
                  {
                     window.location.href='<?php echo base_url('MaritalStatus/index')?>';
                  }
                  $('#contact').attr('disabled', false);
                }
              })
           });
    });

</script>
<!--Script Ends-->
</html>
