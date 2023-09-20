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

	$field_list=array('ASR A Tx. Control Panel'=>'asr_a_tx_txcp_rack_a', 
				'ASR A Tx.Mod'=>'asr_a_tx_mod',
				'ASR A Heater Control Panel'=>'asr_a_htr_cntrl_pnl',
				'ASR A Ion Pump Power Panel'=>'asr_a_ion_pmp_pwr_pnl', 
				'ASR A Tx. Monitor Panel'=>'asr_a_tx_mntr_pnl', 
				'ASR A Modulator Unit'=>'asr_a_mdltr_unt', 
				'ASR A Focus Coil Power Panel'=>'asr_a_fcs_cl_pwr_pnl', 
				'ASR A Rx Rack (A) - Rx. Control Panel'=>'asr_a_rx_rka_rx_cntrl_pnl', 
				'ASR A Signal Process Rack (A) SIG. Proc.PNL'=>'asr_a_sgnl_prcs_rka_sig_proc_npl', 
				'ASR A Local Control Rack-Monitor Panel'=>'asr_a_lcl_cntrl_rk_mntr_pnl', 
				'ASR A Polarization (LIN/CIR)'=>'asr_a_plrztn', 
				'ASR A Staggering (ON/OFF)'=>'asr_a_stgrn', 
				'SSR A POWER INT/SLS'=>'ssr_a_pwr', 
				'SSR A VSWR INT/SLS'=>'ssr_a_vswr', 
				'SSR A INT Mode: A, A/C, A/A/C'=>'ssr_a_int_md', 
				'SSR A STC ON'=>'ssr_a_stc_on', 
				'SSR A CH A ( ACT/STBY)'=>'ssr_a_cha', 
				'SSR A Alarms & Lamp Test'=>'ssr_a_alrm_lmp_tst', 
				 
				'ASR B Tx. Control Panel (Rack-B) '=>'asr_b_tx_txcp_rack_b', 
				'ASR B Transmission mod'=>'asr_b_tx_mod', 
				'ASR B Heater Control Panel'=>'asr_b_htr_cntrl_pnl', 
				'ASR B Ion Pump Power Panel'=>'asr_b_ion_pmp_pwr_pnl', 
				'Tx. Control Panel25'=>'asr_b_tx_mntr_pnl', 
				'Tx. Control Panel26'=>'asr_b_mdltr_unt', 
				'Tx. Control Panel27'=>'asr_b_fcs_cl_pwr_pnl', 
				'Tx. Control Panel28'=>'asr_b_rx_rkb_rx_cntrl_pnl', 
				'Tx. Control Panel29'=>'asr_b_sgnl_prcs_rkb_sig_proc_npl', 
				'Tx. Control Panel30'=>'asr_b_lcl_cntrl_rk_mntr_pnl', 
				'Tx. Control Panel31'=>'asr_b_xxx', 
				'Tx. Control Panel32'=>'asr_b_stgrn', 
				'Tx. Control Panel33'=>'ssr_b_pwr', 
				'Tx. Control Panel34'=>'ssr_b_vswr', 
				'Tx. Control Panel35'=>'ssr_b_int_md',
				'Tx. Control Panel36'=> 'ssr_b_stc_on',
				'Tx. Control Panel37'=>'ssr_b_chb', 
				'Tx. Control Panel38'=>'ssr_b_alrm_lmp_tst',);
	$btn_submit = array(
		'id' => 'btn_submit',
		'name' => 'btn_submit',
		'value' => 'submit',
		'type' => 'submit',
		'content' => 'Submit',
		'class' => 'btn btn-primary'
	);
?>

<?php echo form_open('setting/submit_std_value', $form_attributes) ?>
	<?php if (validation_errors() != ""): ?>
		<div class="alert alert-error">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif ?>


   	<div class="control-group">
		<label class="control-label" for="name">Select Checksheet:</label>
		<div class="controls">
			<?php echo form_dropdown($input_chk_sht['name'],$chk_list, $chk_no,'id="chkst_id" class="input-block-level input-xlarge"') ?>
		</div>
	</div>


	<div class="control-group">
		<label class="control-label" for="name">Field Name:</label>
		<div class="controls">
			<?php echo form_input($input_field_name) ?>
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