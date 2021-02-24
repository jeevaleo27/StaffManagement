<html>
<head>
</head>
<body>
    <div class="row grow w-99.8">	
        <div id="form" class="main col-12 h-100 py-2">
            <!--Form Starts-->
          <form class="Class_Insert"  id="Class_Insert" >
      		  <div class="form-group">
                <div class="form-group form-group-sm">
                    <label  class="col-sm-2 control-label" for="ClassName">ClassName*<br> (1ST YEAR, 2ND YEAR, 3RD YEAR)</label> 
                    <input  class="form-control" type="text"   id="ClassName" name="ClassName" >
                    <span id="ClassName_error" class=" ClassName_error text-danger"></span>
                </div>
      			    <div class="form-group">
                  <button class="Class_Details_Submit" id="contact" value="submit" >Submit</button>
                </div>       
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
                  url:"<?php echo base_url();?>ClassView/post_validate",
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
<!--Script Ends-->
</html>