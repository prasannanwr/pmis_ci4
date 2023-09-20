<?php
	$form_attributes = array(
		'id' => 'std-value-form',
		'class' => 'form-horizontal'
	);

	$input_chk_sht = array(
		'id' => 'chksheet',
		'name' => 'chksheet',
		'value' => $chk_list,
		'class' => 'input-block-level input-xlarge',
		'autofocus' => 'focus',

	);
	
	$input_field_name=array(
					'id'=>'field_name',
					'name'=>'field_name',
					'value'=>$field_name
					);
	$input_max_value=array(
							'id'=>'max_value',
							'name'=>'max_value',
							'value'=>$max_value,
							);
	$input_min_value=array(
							'id'=>'min_value',
							'name'=>'min_value',
							'value'=>$min_value
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

<?php if (is_numeric($check_sheet_id)&&$check_sheet_id!=0){ 
			echo form_open('settings/submit_std_value', $form_attributes); }
		else{
			echo form_open('settings/set_value/1', $form_attributes);
			}
?>
	<?php if (validation_errors() != ""): ?>
		<div class="alert alert-error">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif ?>


   	<div class="control-group">
		<label class="control-label" for="name">Select Checksheet:</label>
		<div class="controls">
			<?php echo form_dropdown($input_chk_sht['name'],$chk_list, $check_sheet_id,'id="chkst_id" class="input-block-level input-xlarge"') ;?>
		</div>
	</div>

<?php if (is_numeric($check_sheet_id)&&$check_sheet_id!=0){ ?>

	<div class="control-group">
		<label class="control-label" for="name">Field Name:</label>
		<div class="controls">
			<?php echo form_dropdown('field_name',$field_list, $field_name,'id="field_name" class="input-block-level input-xlarge"'); ?>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="name">Max Value:</label>
		<div class="controls">
			<?php echo form_input($input_max_value) ?>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="name">Min Value:</label>
		<div class="controls">
			<?php echo form_input($input_min_value) ?>
		</div>
	</div>
    
    <?php } ?>

	<div class="form-actions">
		<?php echo form_button($btn_submit); ?>
		<?php echo anchor('settings', 'Cancel', array('class' => 'btn')); ?>
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