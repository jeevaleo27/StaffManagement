<html>
<head>
  <title></title>
</head>
<body>
  <div class="row grow w-99.8">	
    <div id="form" class="main col-12 h-100 py-2">
      <!--Form Starts-->
      <form class="Department_Insert" id="Department_Insert" >
        <div class="form-group">
          <div class="form-group form-group-sm">
            <label  class="col-sm-2 control-label" for="DepartmentName">DepartmentName*<br> (CSE, ECE, EEE, MECH, IT)</label> 
            <input  class="form-control" type="text"   id="DepartmentName" name="DepartmentName" >
            <span id="DepartmentName_error" class=" DepartmentName_error text-danger"></span>
          </div>
          <div class="form-group">
            <button class="Department_Details_Submit" id="contact" value="submit" >Submit</button>
          </div>       
        </div>
      </form>
      <!--Form Ends-->
    </div>

  </body>
  <!--Script Starts-->
  <script type="text/javascript">
    $(document).ready(function(){
      $('.Department_Insert').on('submit', function(event){
        event.preventDefault();
        $.ajax ({
          url:"<?php echo base_url();?>Department/Department_post_validate",
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
  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
  <!--Script Ends-->
  </html>



