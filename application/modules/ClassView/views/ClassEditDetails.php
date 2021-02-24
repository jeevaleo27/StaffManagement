<html>
<body>
  <div class="row grow w-99.8">	
    <div id="form" class="main col-12 h-100 py-2">
    		  <!--Form stars-->
        <form class="Class_Insert"  id="Class_Insert" >

    		  <!--button to move Class Data tab;le page-->
    		  <button type='button' class='btn btn-primary  btn-sm edit'><a href="<?php echo base_url('ClassView/index')?>" style='color:white;'>Back</a>
          </button>

          <!--1-->
		      <div class="form-group">
        			<div class="form-group form-group-sm">
              	<label  class="col-sm-2 control-label" for="ClassName">ClassName:*</label> 
              	<input  class="form-control" type="text"   id="ClassName" name="ClassName" 
              	 value="<?php echo $ClassField->ClassName; ?>">
              	<span id="ClassName_error" class="ClassName_error text-danger"></span>
         	    </div>
          </div>

          <!--2-->
         	<div class="form-group">
      			<div class="form-group form-group-sm">
              	<label  class="control-label" for="Active">Active:*</label> 
              	<input   type="checkbox"   id="Active" name="Active" 
              	 value="1" <?php $check=explode(",",$ClassField->Active); echo in_array('1',$check)?'checked="checked"' : '' ;?>>
              	<span id="Active_error" class=" Active_error text-danger"></span>
           	</div>
          </div>

         	<div>
         		<input type="hidden" name="ClassUID" id="ClassUID" class="ClassUID" value="<?php echo $ClassField->ClassUID; ?>">
         	</div>

      			<div class="form-group">
              <button class="Edit_Class_Details" id="contact" value="submit" >Submit</button>

            </div>
        </form>
      <!--Form Ends-->
  	</div>
  </div>
</body>
<!--Script Starts-->
<script type="text/javascript">
  $(document).ready(function(){
           $('#Class_Insert').on('submit', function(event){
            event.preventDefault();
              $.ajax ({

                  url:"<?php echo base_url();?>ClassView/Upadte_post_validate",
                  method:"POST",
                  data:$(this).serialize(),
                  dataType:"json",
                  success:function(data)
                {
                  if(data.error)
                  {
                        if(data.ClassName_error != '')
                        {
                          $('#ClassName_error').html(data.ClassName_error);
                        }
                        else
                        {
                          $('#ClassName_error').html('');
                        } 
                  }
                  else
                  {
                     window.location.href='<?php echo base_url('ClassView/index')?>';
                  }
                  $('#contact').attr('disabled', false);
                }
              })
           });
    });
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.12.4.js')?>"></script>
<!--Script Ends-->
</html>
