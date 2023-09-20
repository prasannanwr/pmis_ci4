<?php
$form_attributes = array(
		'id' => 'emp-eqp-form',
		'class' => 'form-horizontal'
	);

$btn_submit = array(
		'id' => 'btn_submit',
		'name' => 'btn_submit',
		'value' => 'submit',
		'type' => 'submit',
		'content' => 'Submit',
		'class' => 'btn btn-primary'
	);

$dept_set = array('' => 'Select Department');
foreach ($department_info as $key => $dept)
{
	$dept_set[$dept['org_name']][$dept['id']] = $dept['name'];
}

$eqp_set = array();
foreach ($equipment_info as $key => $eqp)
{
	$eqp_set[$eqp['eqp_cat']][$eqp['eqp_itm']][$eqp['id']] = $eqp['code'];
}

$input_name = array(
	'id' => 'emp_name',
	'name' => 'emp_name',
	'value' => $user_info->first_name.' '.$user_info->last_name,
	'class' => 'input-block-level input-xlarge',
	'disabled' => 'disabled'
);

?>

<?php echo form_open('employee_equipment/assign', $form_attributes); ?>
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="emp_name">Employee:</label>
			<div class="controls">
				<?php echo form_input($input_name); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="dep_id">Department:</label>
			<div class="controls">
				<?php echo form_dropdown('dep_id', $dept_set, $dep_id, 'id="dep_id" class="input-block-level input-xlarge" autofocus'); ?>
			</div>
		</div>
		<?php foreach ($eqp_set as $k => $eqp_cat): ?>
			
			<?php foreach ($eqp_cat as $l => $eqp_itm): ?>
				<div class="navbar">
					<div class="navbar-inner">
						<span class="brand"><?php echo $k.'::'.$l; ?></span>
					</div>
				</div>
				<div class="well well-small">
				<?php foreach ($eqp_itm as $m => $eqp_itm_cd): ?>
					<div class="control-group">
						<div class="controls">
							<label class="checkbox">
							<?php echo form_checkbox('eqp_itm_cd[]', $m); ?> <?php echo $eqp_itm_cd; ?>
							</label>
						</div>
					</div>
				<?php endforeach ?>
				</div>
			<?php endforeach ?>
		<?php endforeach ?>
		<div class="form-actions">
			<?php echo form_button($btn_submit); ?>
			<?php echo anchor('employee/view/'.$emp_id, 'Cancel', array('class' => 'btn')); ?>
		</div>
		<?php echo form_hidden('emp_id', $emp_id); ?>

</fieldset>
</form>

<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
	{
		$('[autofocus]:not(:focus)').eq(0).focus();

		$('#dep_id').change(function(){
			dep_id = $(this).val();
			current_url = '<?php echo site_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>';

			window.location.href = current_url+'/'+dep_id;

		});
		
	    $('#emp-eqp-form').validate(
	    	{
			    rules:
			    {
				    dep_id:
				    {
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