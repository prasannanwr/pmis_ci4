    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
					Bridge Designer&raquo; Add/Edit Form
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
							Designer Id:
						</label>
						<div class="col-sm-6">
                            <input id="bdr01designer_id" class="form-control" type="text" name="bdr01designer_id" maxlength="5" value="<?php echo et_setFormVal('bdr01designer_id', $objOldRec); ?>"  />
                            <?php echo form_error('bdr01designer_id'); ?>
						</div>
					</div>
					<div class="form-group" >
						<label for="Designer_Name" class="col-sm-3 control-label">
							Designer Name:
						</label>
						<div class="col-sm-6 required">
                            <input id="bdr01designer_name" class="form-control" type="text" name="bdr01designer_name" maxlength="30" value="<?php echo et_setFormVal('bdr01designer_name', $objOldRec); ?>"  />
                            <?php echo form_error('bdr01designer_name'); ?>
						</div>
					</div>
                    <div class="form-group">
						<label for="Birth_Date:" class="col-sm-3 control-label">
							Birth Date:
						</label>
						<div class="col-sm-6">
                            <input id="bdr01birth_date" class="form-control" type="text" name="bdr01birth_date" maxlength="30" value="<?php echo et_setFormVal('bdr01birth_date', $objOldRec); ?>"  />
                            <?php echo form_error('bdr01birth_date'); ?>
						</div>
					</div>
                    <div class="form-group">
						<label for="Address" class="col-sm-3 control-label">
							Address:
						</label>
						<div class="col-sm-6">
                            <input id="bdr01address" class="form-control" type="text" name="bdr01address" maxlength="30" value="<?php echo et_setFormVal('bdr01address', $objOldRec); ?>"  />
                            <?php echo form_error('bdr01address'); ?>
						</div>
					</div>
                    <div class="form-group">
						<label for="Agency_Id" class="col-sm-3 control-label">
							Agency Id:
						</label>
						<div class="col-sm-6">
                            <input id="bdr01agency_id" class="form-control" type="text" name="bdr01agency_id" maxlength="30" value="<?php echo et_setFormVal('bdr01agency_id', $objOldRec); ?>"  />
                            <?php echo form_error('bdr01agency_id'); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label for="Description" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="bdr01description" class="form-control" name="bdr01description" maxlength="100"><?php echo et_setFormVal('bdr01description', $objOldRec); ?></textarea>
                            <?php echo form_error('bdr01description'); ?>
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
                        <?php echo form_hidden('bdr01id', et_setFormVal('bdr01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('bridge_designer', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            bdr01designer_id:
                            {
                                  number: true,
                                  maxlength: 5 
                            },
                            bdr01designer_name:
                            {
                                  required: true,
                                  maxlength: 30 
                            },
                            bdr01agency_id:
                            {
                                  required: true,
                                  maxlength: 5
                            },
                            bdr01address:
                            {
                                  required: true,
                                  maxlength: 30
                            },
                             bdr01birth_date:
                            {
                                 date: true,
                                  maxlength: 30
                            },
                            bdr01description:
                            {
                                  maxlength: 100 
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
