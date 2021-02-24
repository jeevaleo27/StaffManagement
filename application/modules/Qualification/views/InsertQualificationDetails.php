<html>
<head>
  <title></title>
</head>
<body>
<div class="row grow w-99.8">	
  <div id="form" class="main col-12 h-100 py-2">
    <!--Form Starts-->
    <form class="Qualification_Insert"  id="Qualification_Insert" >
		  <div class="form-group">
          <div class="form-group form-group-sm">
              <label  class="col-sm-2 control-label" for="QualificationName">QualificationName*<br>(BE, ME, PHD)
              </label> 
              <input  class="form-control" type="text"   id="QualificationName" name="QualificationName" >
              <span id="QualificationName_error" class=" QualificationName_error text-danger"></span>
          </div>
			    <div class="form-group">
            <button class="Qualification_Details_Submit" id="contact" value="submit" >Submit</button>
          </div>       
		  </div>
    </form>
    <!--Form Ends-->
	</div>

</body>
<!--Script Starts-->
<script type="text/javascript">
  $(document).ready(function(){
           $('.Qualification_Insert').on('submit', function(event){
            event.preventDefault();
              $.ajax ({
                  url:"<?php echo base_url();?>Qualification/Qualification_post_validate",
                  method:"POST",
                  data:$(this).serialize(),
                  dataType:"json",
                  success:function(data)
                {
                  if(data.error)
                  {
                        if(data.QualificationName_error != '')
                        {
                          $('#QualificationName_error').html(data.QualificationName_error);
                        }
                        else
                        {
                          $('#QualificationName_error').html('');
                        } 
                  }
                  else
                  {
                     window.location.href='<?php echo base_url('Qualification/index')?>';
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



