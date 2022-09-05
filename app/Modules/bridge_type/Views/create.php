    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
						Bridge Type &raquo; Add/Edit Form
					</h1>
				</div>
                <?php echo form_open_multipart($postURL, array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role'=>'form')) ?>
                    <?php if( isset($message) && $message!=''): ?>
                    <div class="message alert alert-danger">
                        <?php var_dump($message) ;?>
                    </div>
                    <?php endif;?>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label ">
							Bridge Type Code:
						</label>
						<div class="col-sm-6">
                            <input id="bri01bridge_type_code" class="form-control" type="text" name="bri01bridge_type_code" maxlength="5" value="<?php echo et_setFormVal('bri01bridge_type_code', $objOldRec); ?>"  />
                            <?php echo form_error('bri01bridge_type_code'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label  ">
						  Bridge Name:
						</label>
						<div class="col-sm-6">
                            <input id="bri01bridge_type_name" class="form-control" type="text" name="bri01bridge_type_name" maxlength="40" value="<?php echo et_setFormVal('bri01bridge_type_name', $objOldRec); ?>"  />
                            <?php echo form_error('bri01bridge_type_name'); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="bri01description" class="form-control" type="text" name="bri01description" maxlength="100"><?php echo et_setFormVal('bri01description', $objOldRec); ?></textarea>
                            <?php echo form_error('bri01description'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('bri01id', et_setFormVal('bri01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('bridge_type', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            bri01bridge_type_code:
                            {     
                                  maxlength: 4,
                                  required: true
                            },
                            bri01bridge_type_name:
                            {
                                  maxlength: 40,
                                  required: true
                            },
                            bri01description:
                            {
                                  maxlength: 100,
                                  required: false
                            },
                           
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
