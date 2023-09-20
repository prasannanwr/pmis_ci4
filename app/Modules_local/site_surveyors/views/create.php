<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
 <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
					Site Surveyors&raquo; Add/Edit Form
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
                            <input id="ssr01surveyor_id" class="form-control" type="text" name="ssr01surveyor_id" maxlength="3" value="<?php echo et_setFormVal('ssr01surveyor_id', $objOldRec); ?>"  />
                            <?php echo form_error('ssr01surveyor_id'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Name:
						</label>
						<div class="col-sm-6">
                            <input id="ssr01surveyor_name" class="form-control" type="text" name="ssr01surveyor_name" maxlength="30" value="<?php echo et_setFormVal('ssr01surveyor_name', $objOldRec); ?>"  />
                            <?php echo form_error('ssr01surveyor_name'); ?>
						</div>
					</div>
                    <div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Birth Date:
						</label>
						<div class="col-sm-6">
                            <input id="ssr01birth_date" class="form-control input-group date" type="text" name="ssr01birth_date" maxlength="30" value="<?php echo et_setFormVal('ssr01birth_date', $objOldRec); ?>"  />
                            <?php echo form_error('ssr01birth_date'); ?>
						</div>
					</div>
                    <div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Address:
						</label>
						<div class="col-sm-6">
                            <input id="ssr01address" class="form-control" type="text" name="ssr01address" maxlength="30" value="<?php echo et_setFormVal('ssr01address', $objOldRec); ?>"  />
                            <?php echo form_error('ssr01address'); ?>
						</div>
					</div>
                    <div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Agency Id:
						</label>
						<div class="col-sm-6">
                            <input id="ssr01agency_id" class="form-control" type="text" name="ssr01agency_id" maxlength="30" value="<?php echo et_setFormVal('ssr01agency_id', $objOldRec); ?>"  />
                            <?php echo form_error('ssr01agency_id'); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="ssr01description" class="form-control" name="ssr01description" maxlength="100"><?php echo et_setFormVal('ssr01description', $objOldRec); ?></textarea>
                            <?php echo form_error('ssr01description'); ?>
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
                        <?php echo form_hidden('id', et_setFormVal('id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('site_surveyors', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            ssr01surveyor_id:
                            {
                                   maxlength: 10,
                                  required: true
                            },
                            ssr01surveyor_name:
                            {
                                   maxlength: 75,
                                  required: true
                            },
                            
                            ssr01birth_date:
                            {
                                
                                  date: true
                            },
                            
                            ssr01address:
                            {
                                   maxlength:95,
                                  
                            },
                            
                            ssr01agency_id:
                            {
                                   maxlength: 4,
                                   number:true
                            },
                            ssr01description:
                            {
                                  maxlength: 95,
                                  
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
<?= $this->endSection() ?>