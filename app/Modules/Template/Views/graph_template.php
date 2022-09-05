<?php $this->load->module('auth'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>CAAN - <?php echo $title ?></title>
    <?php echo meta('content-type', 'text/html; charset=utf-8', 'equiv'); ?>
    <?php echo meta('description', 'Civil Aviation Authority of Nepal'); ?>
    <?php echo link_tag('css/bootstrap.min.css'); ?>
    <?php echo link_tag('css/style.css'); ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.flot.time.min.js"></script>
</head>
<body>
	<div id="wrapper">
	    <div id="header">
	        
	        <?php if ($this->ion_auth->logged_in()): ?>
	        	<div class="header-menu">
	        		<ul>
	        			<li><?php echo anchor('employee/profile', 'Profile') ?></li>
	        			<li><?php echo anchor('auth/logout', 'Logout') ?></li>
	        		</ul>
	        	</div>
	        <?php endif ?>
	        <div class="header-txt">Civil Aviation Authority of Nepal</div>
	    </div>

	    <?php 
	    	if( ! isset($breadcrumb) ) $breadcrumb = array();
	    	$blength = count($breadcrumb);
	     ?>
	        
	    <?php if ($this->uri->segment(1) != 'dashboard' && $this->uri->segment(1) != 'auth'): ?>
	    <div>
	    	<ul class="breadcrumb">
	    		<li><?php echo anchor('dashboard', 'Dashboard') ?><?php if ($blength > 0): ?> <span class="divider">/</span><?php endif ?></li>
	    		<?php foreach ($breadcrumb as $key => $bc): ?>
	    			<?php if ($key < ($blength - 1)): ?>
	    				<li><?php echo anchor($bc['link'], $bc['text']) ?> <span class="divider">/</span></li>
	    			<?php else: ?>
	    			<li class="active"><?php echo $bc['text'] ?></li>
	    			<?php endif ?>
	    		<?php endforeach ?>
    		</ul>
	    </div>
	    <?php endif ?>
	    
	    <div id="main">
	    	<fieldset>
		    	<legend><span class="title"><?php echo $title ?></span></legend>
		    </fieldset>

		    <?php if ($this->session->flashdata('message') != ''): ?>
			<div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
			    <?php echo $this->session->flashdata('message'); ?>
			</div>
			<?php endif ?>

	    	<div id="content">
	    		<?php $this->load->view($module.'/'.$view_file); ?>
	    	</div>
		</div>
		<div id="footer">
	        <span>2013 © Copyright Civil Aviation Authority of Nepal. All rights reserved</span>
	    </div>
	</div>
</body>
</html>