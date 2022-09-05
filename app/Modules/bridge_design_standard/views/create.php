    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
				Bridge Design Standard &raquo; Add/Edit Form
					</h1>
				</div>
                <?php echo form_open_multipart($postURL, array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role'=>'form')) ?>
                    <?php if( isset($message) && $message!=''): ?>
                    <div class="message">
                        <?php var_dump( $message);?>
                    </div>
                    <?php endif;?>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Code:
						</label>
						<div class="col-sm-6">
                            <input id="bri02bds_type_code" class="form-control" type="text" name="bri02bds_type_code" maxlength="4" value="<?php echo et_setFormVal('bri02bds_type_code', $objOldRec); ?>"  />
                            <?php echo form_error('bri02bds_type_code'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Name:
						</label>
						<div class="col-sm-6">
                            <input id="bri02bds_type_name" class="form-control" type="text" name="bri02bds_type_name" maxlength="50" value="<?php echo et_setFormVal('bri02bds_type_name', $objOldRec); ?>"  />
                            <?php echo form_error('bri02bds_type_name'); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="bri02description" class="form-control" name="bri02description" maxlength="100"><?php echo et_setFormVal('bri02description', $objOldRec); ?></textarea>
                            <?php echo form_error('bri02description'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'bri02id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('bri02id', et_setFormVal('bri02id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('bridge_design_standard', 'Cancel', array('class' => 'btn btn-default')); ?>
						</div>
					</div>
                    <?php echo form_close();?>

			</div>
		</div>
    </div>
                

<script type="text/javascript">
$(document).ready(function()
      {
            $('[autofocus]:not(:focus)').eq(0).focus();
            
            $('#emp-form').validate(
            {
                      rules:
                      {
                            bri02bds_type_code:
                            {
                                   maxlength: 4,
                                  required: true
                            },
                            bri02bds_type_name:
                            {
                                   maxlength: 50,
                                  required: true
                            },
                            bri02description:
                            {
                                  maxlength: 100,
                                  
                            }
                      },
                      highlight: function(element)
                      {
                        $(element).closest('.form-group').removeClass('success').addClass('error');
                      },
                      success: function(element)
                      {
                        element.text('OK!').addClass('valid').closest('.form-group').removeClass('error').addClass('success');
                      }
            });
      });
</script>
