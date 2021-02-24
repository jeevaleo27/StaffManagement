<html>
<head>
  <title></title>
</head>
<body>
<div class="row grow w-99.8">	
  <div id="form" class="main col-12 h-100 py-2">
    <!--Form Starts-->
    <form class="StaffTimeTable_Insert"  id="StaffTimeTable_Insert" >
		  <div class="form-group">

          <div class="form-group">
                 StaffUID*<select name = "StaffUID" class="form-control" id="StaffUID">
                   <option value="">--select--</option>
                  <?php 
                  foreach ($StaffField as $key => $row){ ?>
                  <option value="<?php echo $row->StaffUID; ?>"><?php echo $row->StaffName; ?></option>
                  <?php }?>
                  </select> <span id="StaffUID_error" class="StaffUID_error text-danger"></span>
            </div>
            <div class="form-group">
                 ClassUID*<select name = "ClassUID" class="form-control" id="ClassUID">
                   <option value="">--select--</option>
                  <?php 
                  foreach ($ClassField as $key => $row){ ?>
                  <option value="<?php echo $row->ClassUID; ?>"><?php echo $row->ClassName; ?></option>
                  <?php }?>
                  </select> <span id="ClassUID_error" class="ClassUID_error text-danger"></span>
            </div>
          <div class="form-group form-group-sm">
              <label  class="col-sm-2 control-label" for="Time">Time*</label> 
              <input  class="form-control" type="text"   id="Time" name="Time" placeholder="hh:mm:ss" >
              <span id="Time_error" class=" Time_error text-danger"></span>
          </div>
			    <div class="form-group">
            <button class="StaffTimeTable_Time_Submit" id="contact" value="submit" >Submit</button>
          </div>       
		  </div>
    </form>
    <!--Form Ends-->
	</div>

</body>
<!--Script Starts-->
<script type="text/javascript">

  $(document).ready(function(){
           $('.StaffTimeTable_Insert').on('submit', function(event){
            event.preventDefault();
              $.ajax ({
                  url:"<?php echo base_url();?>StaffTimeTable/StaffTimeTable_post_validate",
                  method:"POST",
                  data:$(this).serialize(),
                  dataType:"json",
                  success:function(data)
                {
                  if(data.error)
                  {
                        if(data.StaffUID_error != '')
                        {
                          $('#StaffUID_error').html(data.StaffUID_error);
                        }
                        else
                        {
                          $('#StaffUID_error').html('');
                        } 
                         if(data.ClassUID_error != '')
                        {
                          $('#ClassUID_error').html(data.ClassUID_error);
                        }
                        else
                        {
                          $('#ClassUID_error').html('');
                        } 
                        if(data.Time_error != '')
                        {
                          $('#Time_error').html(data.Time_error);
                        }
                        else
                        {
                          $('#Time_error').html('');
                        } 
                       
                  }
                  else
                  {
                     window.location.href='<?php echo base_url('StaffTimeTable/index')?>';
                  }
                  $('#contact').attr('disabled', false);
                }
              })
           });
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<!--Script Ends-->
</html>



 