

<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div class="navbar">
	<div class="navbar-inner">
		<span class="brand"><?php // echo $users->first_name.' '.$users->last_name; ?></span>
		<?php //if ($type != 'profile'): ?>
		<div class="pull-right">
		<?php
			// if (check_access_general(array('emp_edit')))
			// {
			// 	echo anchor('users/create/'.$users->id, '<button type="button" class="btn btn-small"><i class="icon-edit"></i> Edit Employee</button>');
			// 	echo nbs();
			// }

		?>
		</div>
		<?php //endif ?>
	</div>
</div>

 <div class="container-fluid">
		<div class="panel panel-default">

			<div class="panel-heading" style="margin-bottom: 10px;">
				<h1>Profile of <?php echo $users['username'];?></h1>	
				</div>
    
    <div class="form-group clearfix">
                       
						<label for="First_Name:" class="col-sm-4 control-label"></label>
                        <label for="First_Name:" class="col-sm-2 control-label">
						 Name:
						</label>
						<div class="col-sm-6">
                    <?php echo $users['name'] ?>
    						</div>
					</div>
                    <!-- <div class="form-group clearfix">
                    	<label for="First_Name:" class="col-sm-4 control-label"></label>
						<label for="Last_Name" class="col-sm-2 control-label">
						 Last Name::
						</label>
						<div class="col-sm-6">
                    <?php //echo $users->last_name ?>
    						</div>
					</div> -->
                    <div class="form-group clearfix">
                    	<label for="First_Name:" class="col-sm-4 control-label"></label>
						<label for="Email" class="col-sm-2 control-label">
						 Email:
						</label>
						<div class="col-sm-6">
                    <?php echo $users['email'];?>
    						</div>
					</div>
                    <div class="form-group clearfix">
                    	<label for="First_Name:" class="col-sm-4 control-label"></label>
						<label for="Username" class="col-sm-2 control-label">
						 Username:
						</label>
						<div class="col-sm-6">
                    <?php echo $users['username'];?>
    						</div>
					</div>
					<?php /*if(session()->get('type') != ENUM_ADMINISTRATOR): ?>
					<div class="form-group clearfix">
						<label class="col-sm-4 control-label"></label>
						<label class="col-sm-2 control-label">
						 ADoR (Allocatecd District of reponsibity):
						</label>
						<div class="col-sm-6">
    	                <?php 
	                    foreach($arrDistList as $dist):
	                    	echo $dist->dist01name.", ";
                    	endforeach; ?>
    						</div>						
					</div>
				<?php endif;*/?>
	
</div>
</div>
<?= $this->endSection() ?>