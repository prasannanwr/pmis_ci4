<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
					Handrail Cable&raquo; Add/Edit Form
					</h1>
				</div>
                <?php echo form_open_multipart($postURL, array('hdc01id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role'=>'form')) ?>
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
                            <input id="hdc01hhcn_type_code" class="form-control" type="text" name="hdc01hhcn_type_code" maxlength="5" value="<?php echo et_setFormVal('hdc01hhcn_type_code', $objOldRec); ?>"  />
                            
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
						Number:
						</label>
						<div class="col-sm-6">
                            <input id="hdc01hhcn_type_number" class="form-control" type="text" name="hdc01hhcn_type_number" maxlength="10" value="<?php echo et_setFormVal('hdc01hhcn_type_number', $objOldRec); ?>"  />
                            
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="hdc01description" class="form-control" name="hdc01description" maxlength="100"><?php echo et_setFormVal('hdc01description', $objOldRec); ?></textarea>
                            
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'hdc01id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('hdc01id', et_setFormVal('hdc01id', $objOldRec)); ?>
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
                            hdc01hhcn_type_code:
                            {
                                   maxlength: 4,
                                   number: true
                                 
                            },
                            hdc01hhcn_type_number:
                            {
                                   maxlength: 10,
                                  number: true
                            },
                            hdc01description:
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
<?= $this->endSection();?>