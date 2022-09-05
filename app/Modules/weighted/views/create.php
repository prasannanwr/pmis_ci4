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
						<label for="" class="col-sm-3 control-label">
							Logo Name:
						</label>
						<div class="col-sm-6">
                            <input id="log01name" class="form-control" type="text" name="log01name" maxlength="20" value="<?php echo et_setFormVal('log01name', $objOldRec); ?>"  />
                            <?php echo form_error('log01name'); ?>
						</div>
					</div>
					<div class="form-group" >
						<label for="" class="col-sm-3 control-label">
						Logo:
						</label>
						<div class="col-sm-6 required">
                            <input id="log01file" class="form-control" type="file" name="log01file"  value="<?php echo et_setFormVal('log01file', $objOldRec); ?>"  />
                            <?php echo form_error('log01file'); ?>
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
                        <?php echo form_hidden('log01id', et_setFormVal('log01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('logo_upload', 'Cancel', array('class' => 'btn btn-default')); ?>
						</div>
					</div>
                    <?php echo form_close();?>

			</div>
		</div>
    </div>
                


