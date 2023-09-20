<?php
	$form_attributes = array(
		'id' => 'std-value-form',
		'class' => 'form-horizontal'
	);

	$input_license_name = array(
		'id' => 'chksheet',
		'name' => 'license_name',
		'value' => $license_name,
		'class' => 'input-block-level input-xlarge',
		'autofocus' => 'focus',

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

<?php echo form_open('settings/submit_license', $form_attributes) ?>
	<?php if (validation_errors() != ""): ?>
		<div class="alert alert-error">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif ?>


   	
	<div class="control-group">
		<label class="control-label" for="name">Field Name:</label>
		<div class="controls">
			<?php echo form_input($input_license_name) ?>
		</div>
	</div>
    
    	
	<div class="control-group">
		<label class="control-label" for="name">Status:</label>
		<div class="controls">
			<?php echo form_radio('status', '1', TRUE); ?>
		</div>
	</div>
    
    
    
    
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