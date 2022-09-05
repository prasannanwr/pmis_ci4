<?php $this->load->module('auth'); ?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>
				TBIS -
				<?php echo $title ?>
			</title>
			<?php echo meta( 'content-type', 'text/html; charset=utf-8', 'equiv'); ?>
				<?php echo meta( 'description', 'Civil Aviation Authority of Nepal'); ?>
					<?php echo link_tag( 'css/bootstrap.min.css'); ?>
						<?php echo link_tag( 'css/sb-admin.css'); ?>
							<!-- Morris Charts CSS -->
							<link href="<?php echo base_url(); ?>css/plugins/morris.css" rel="stylesheet">
							<!-- Custom Fonts -->
							<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
							<link href="<?php echo base_url(); ?>css/typography.css" rel="stylesheet">
                             <link  href="<?php echo base_url(); ?>js/datatable/data_table.css" rel="stylesheet" />
							<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">

		</head>
		<body id="print">
			<div id="wrapper">
				<!-- Navigation -->
				
				<div id="page-wrapper" style="background: none;min-width:960px; margin: 5px auto;">
					<?php if ($this->
						session->flashdata('message') != ''): ?>
						<div class="container-fluid">
							<div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> alert-dismissable">
								<?php echo $this->
									session->flashdata('message'); ?>
							</div>
						</div>
						<?php endif ?>
							<!-- <?php echo sprintf('%s/%s', $module, $view_file);?> -->
							<?php $this->
								load->view($module.'/'.$view_file); ?>
				</div>
				<!-- /#page-wrapper -->
			</div>
			<!-- /#wrapper -->
			<div style="display:none">
				<div id="line-example">
				</div>
			</div>
		</body>
		<style>
			html {
			height:100%;
			width:100%;
			margin:0;
			padding:0;
			}
            .sidebar-nav {
    padding: 9px 0;
}

.dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    visibility: hidden;
    margin-top: -1px;
}
.dropdown-menu li{
    position: relative;
}

.dropdown-menu2 {
    left:100%;
    position: absolute;
    visibility: hidden;
    margin-top: -1px;
    top: 0px;
    background: #fff;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
 
     
}
.dropdown-menu1 {
    left:100%;
    position: absolute;
    top:0px;
    visibility: hidden;
    background: #f1f1f1;
    margin-top: 0;
 
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    min-width: 300px;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}
.dropdown-menu1 li, .dropdown-menu2 li{
    list-style: none;
    color:#000;
    position: relative;
    
   
}
.dropdown-menu1 li a:hover, .dropdown-menu2 li a:hover{
   color:#fff;
   
}
.dropdown-menu1 li a, .dropdown-menu2 li a{
    
    color:#000;
     text-decoration: none;
}
.dropdown-menu1>.child-menu:hover a{
      
     text-decoration: none;
     }
.dropdown-menu li:hover .dropdown-menu1{
    visibility: visible;
    
}
.dropdown-menu1 li:hover .dropdown-menu2 {
   visibility: visible;
   
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu {
    margin-top: 0;
}



		</style>
   <script src="<?php echo base_url();?>/js/jqueryCalc.js"></script>
	</html>
    	<script>
		$(document).ready(function(){
    		 window.print();
            // window.close();
		});
	</script>
   