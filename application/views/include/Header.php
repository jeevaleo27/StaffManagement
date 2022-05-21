<!DOCTYPE html>
<html >
<head>
	<title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style.css")?>">
 
</head>
<body >

<nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#">Active</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="#">Disabled</a>
    </li>
  </ul>
</nav>

  
</body>
</html>
<script type="text/javascript" src="<?php echo base_url();?>assets_new/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_new/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_new/plugins/datatable/js/dataTables.fixedColumns.js"></script>
<script type="text/javascript">
  $(window).resize(function() {
      $($.fn.dataTable.tables( true ) ).css('width', '100%');
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();

    });
      $('body').on('shown.bs.modal', function () {
      $($.fn.dataTable.tables( true ) ).css('width', '100%');
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();

    });
    $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables( true ) ).css('width', '100%');
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();

    });
</script>