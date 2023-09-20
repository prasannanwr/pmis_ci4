<?php
	$form_attributes = array(
		'id' => 'std-value-form',
		'class' => 'form-horizontal'
	);

	$input_start_date = array(
		'id' => 'start_date',
		'name' => 'start_date',
		'value' => $start_date,
		'class' => 'input-block-level input-xlarge',

	);
	
	
	
	$input_end_date=array(
					'id'=>'end_date',
					'name'=>'end_date',
					'value'=>$end_date,
					'class' => 'input-block-level input-xlarge',
					
					);
	
	$btn_submit = array(
		'id' => 'btn_submit',
		'name' => 'btn_submit',
		'value' => 'submit',
		'type' => 'submit',
		'content' => 'Submit',
		'class' => 'btn btn-primary'
	);
?>

<?php echo form_open('employee/submit_license', $form_attributes) ?>
	<?php if (validation_errors() != ""): ?>
		<div class="alert alert-error">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif ?>


   	<div class="control-group">
		<label class="control-label" for="name">Select License:</label>
		<div class="controls">
			<?php echo form_dropdown('license_type',$license_list,'','id="chkst_id" class="input-block-level input-xlarge"') ?>
		</div>
	</div>


	<div class="control-group">
		<label class="control-label" for="name">Start Date:</label>
		<div class="controls">
			<?php echo form_input($input_start_date) ?>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="name">End Date:</label>
		<div class="controls">
			<?php echo form_input($input_end_date) ?>
		</div>
	</div>
    

	<div class="form-actions">
		<?php echo form_button($btn_submit); ?>
		<?php //echo anchor('settings/view/1', 'Cancel', array('class' => 'btn')); ?>
	</div>

	<?php
		
			echo form_hidden('emp_id', $emp_id);
		
	?>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function()
	{
		$('[autofocus]:not(:focus)').eq(0).focus();
		$('#start_date').datepicker();
		$('#end_date').datepicker();
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