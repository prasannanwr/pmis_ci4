<?php
	$form_attributes = array(
		'id' => 'std-value-form',
		'class' => 'form-horizontal'
	);

	$input_department = array(
		'id' => 'department',
		'name' => 'department',
		'value' => $department_list,
		'class' => 'input-block-level input-xlarge',
		'autofocus' => 'focus',

	);
	
	$input_employee_name=array(
					'id'=>'employee_name',
					'name'=>'employee',
					'value'=>$employee_list
					);
	$input_alert_date=array(
							'id'=>'max_value',
							'name'=>'max_value',
							'value'=>$alert_date,
							);
	
	$btn_submit = array(
		'id' => 'btn_submit',
		'name' => 'btn_submit',
		'value' => 'submit',
		'type' => 'submit',
		'content' => 'Submit',
		'class' => 'btn btn-primary'
	);


if($department_id==0){
					echo form_open('settings/set_value/2', $form_attributes);?>
					
	<div class="control-group">
		<label class="control-label" for="name">Select Department</label>
		<div class="controls">
			<?php echo form_dropdown('department',$department_list, $department_id,'id="chkst_id" class="input-block-level input-xlarge"') ?>
		</div>
	</div>


<?php	
	}
	else{

 echo form_open('setting/submit_std_value', $form_attributes) ?>
	<?php if (validation_errors() != ""): ?>
		<div class="alert alert-error">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif ?>

<div class="control-group">
		<label class="control-label" for="name">Select Department</label>
		<div class="controls">
			<?php echo form_dropdown('department',$department_list, $department_id,'id="chkst_id" class="input-block-level input-xlarge"') ?>
		</div>
	</div>

   	<div class="control-group">
		<label class="control-label" for="name">Select Employee:</label>
		<div class="controls">
			<?php echo form_dropdown('employee_id',$employee_list,'','id="chkst_id" class="input-block-level input-xlarge"') ?>
		</div>
	</div>

<div class="control-group">
		<label class="control-label" for="name">Select Equipment Item:</label>
		<div class="controls">
			<?php echo form_dropdown('equipment_item_code',$equipment_item_code_list,'','id="chkst_id" class="input-block-level input-xlarge"') ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="name">Alert Date:</label>
		<div class="controls">
			<?php echo form_input($input_alert_date) ?>
		</div>
	</div>
    <?php } ?>
	<div class="form-actions">
		<?php echo form_button($btn_submit); ?>
		<?php echo anchor('organization', 'Cancel', array('class' => 'btn')); ?>
	</div>

	<?php
		if(isset($update_id))
		{
			echo form_hidden('id', $update_id);
		}
	?>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
	{
		$('[autofocus]:not(:focus)').eq(0).focus();
		
	    $('#org-form').validate(
	    	{
			    rules:
			    {
				    name:
				    {
					    minlength: 5,
					    required: true
				    }
			    },
			    highlight: function(element)
			    {
			    	$(element).closest('.control-group').removeClass('success').addClass('error');
			    },
			    success: function(element)
			    {
			    	element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
			    }
		});
	});
</script>