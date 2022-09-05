    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
					Cost Components &raquo; Add/Edit Form
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
                            <input id="cmp01component_id" class="form-control" type="text" name="cmp01component_id" maxlength="5" value="<?php echo et_setFormVal('cmp01component_id', $objOldRec); ?>"  />
                            <?php echo form_error('cmp01component_id'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Name:
						</label>
						<div class="col-sm-6">
                            <input id="cmp01component_name" class="form-control" type="text" name="cmp01component_name" maxlength="40" value="<?php echo et_setFormVal('cmp01component_name', $objOldRec); ?>"  />
                            <?php echo form_error('cmp01component_name'); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="cmp01description" class="form-control" name="cmp01description" maxlength="100"><?php echo et_setFormVal('cmp01description', $objOldRec); ?></textarea>
                            <?php echo form_error('cmp01description'); ?>
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
                        <?php echo form_hidden('cmp01id', et_setFormVal('cmp01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('rust_prev_measures', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            cmp01component_id:
                            {     
                                  maxlength: 5,
                                  required: true
                            },
                            cmp01component_name:
                            {
                                  maxlength: 40,
                                  required: true
                            },
                            cmp01description:
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
