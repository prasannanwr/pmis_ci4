    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
					Walkway Width &raquo; Add/Edit Form
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
						WWW	Code:
						</label>
						<div class="col-sm-6">
                            <input id="wal01walkwaywidth_code" class="form-control" type="text" name="wal01walkwaywidth_code" maxlength="3" value="<?php echo et_setFormVal('wal01walkwaywidth_code', $objOldRec); ?>"  />
                            <?php echo form_error('wal01walkwaywidth_code'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Width:
						</label>
						<div class="col-sm-6">
                            <input id="wal01walkway_width" class="form-control" type="text" name="wal01walkway_width" maxlength="30" value="<?php echo et_setFormVal('wal01walkway_width', $objOldRec); ?>"  />
                            <?php echo form_error('wal01walkway_width'); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="wal01description" class="form-control" name="wal01description" maxlength="100"><?php echo et_setFormVal('wal01description', $objOldRec); ?></textarea>
                            <?php echo form_error('wal01description'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'wal01id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('wal01id', et_setFormVal('wal01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('walkway_width', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            wal01walkwaywidth_code:
                            {
                                   maxlength: 4,
                                  number: true
                            },
                            wal01walkway_width:
                            {
                                   maxlength: 4,
                                  required: true
                            },
                            wal01description:
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
