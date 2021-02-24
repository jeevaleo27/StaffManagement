<html>
<head>
  <title></title>
</head>
<body>
<div class="row grow w-99.8">	
  <div id="form" class="main col-12 h-100 py-2">
    <!--Form Starts-->
    <form class="MaritalStatus_Insert"  id="MaritalStatus_Insert" >
		  <div class="form-group">
          <div class="form-group form-group-sm">
              <label  class="col-sm-2 control-label" for="MaritalStatusName">
                MaritalStatusName*<br> (Single, Married, Divorce)</label> 
              <input  class="form-control" type="text"   id="MaritalStatusName" name="MaritalStatusName" >
              <span id="MaritalStatusName_error" class=" MaritalStatusName_error text-danger"></span>
          </div>
			    <div class="form-group">
            <button class="MaritalStatus_Details_Submit" id="contact" value="submit" >Submit</button>
          </div>       
		  </div>
    </form>
    <!--Form Ends-->
	</div>

</body>
<!--Script Starts-->
<script type="text/javascript">
  $(document).ready(function(){
           $('.MaritalStatus_Insert').on('submit', function(event){
            event.preventDefault();
              $.ajax ({
                  url:"<?php echo base_url();?>MaritalStatus/MaritalStatus_post_validate",
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
<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<!--Script Ends-->
</html>



 