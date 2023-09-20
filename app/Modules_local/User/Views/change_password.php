	
<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
 <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
				<h1>Change Password<?php //echo lang('change_password_heading');?></h1>	
				</div>
    



<?php echo form_open("user/change_password");?>
                <div class="form-group clearfix">
						<label for="first_name" class="col-sm-4 control-label">
						 <?php //echo lang('change_password_old_password_label', 'old_password');?>
                         Old Password
						</label>
						<div class="col-sm-6">
                    <?php echo form_input($old_password);?>
    						</div>
					</div>
    
               <div class="form-group clearfix">
						<label class="col-sm-4" for="new_password">New Password<?php //echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> 
						<div class="col-sm-6">
                     <?php echo form_input($new_password);?>
    						</div>
					</div>
   
                 <div class="form-group clearfix">
						 <label for="" class="col-sm-4"> Confirm New Password<?php //echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> </label>
						<div class="col-sm-6">
                    <?php echo form_input($new_password_confirm);?>
    						</div>
					</div>
     
      <?php echo form_input($user_id);?>
                    <div class="form-group clearfix">
						 <label for="" class="col-sm-4"> </label>
						<div class="col-sm-6">
                    <?php //echo form_submit('submit', 'Submit');?>
					<button type="submit" class="btn btn-success">Submit</button>
                    <button type="submit" name="submit" class="btn btn-success" value="Cancel">Cancel</button>
    						</div>

					</div>
  
    

<?php echo form_close();?>


</div>
</div>
</div>
<style>
 .AddEdit-form  form{
    margin-top: 10px;
 }
</style>
<?= $this->endSection() ?>