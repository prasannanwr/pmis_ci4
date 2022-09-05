<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
					Construction &raquo; Add/Edit Form
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
                            <input id="con02construction_type_code" class="form-control" type="text" name="con02construction_type_code" maxlength="5" value="<?php echo et_setFormVal('con02construction_type_code', $objOldRec); ?>"  />
                            
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Name:
						</label>
						<div class="col-sm-6">
                            <input id="con02construction_type_name" class="form-control" type="text" name="con02construction_type_name" maxlength="40" value="<?php echo et_setFormVal('con02construction_type_name', $objOldRec); ?>"  />
 
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="con02description" class="form-control" name="con02description" maxlength="100"><?php echo et_setFormVal('con02description', $objOldRec); ?></textarea>
                  
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
                        <?php echo form_hidden('con02id', et_setFormVal('con02id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('construction', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            con02construction_type_code:
                            {     
                                  maxlength: 5,
                                  required: true
                            },
                            con02construction_type_name:
                            {
                                  maxlength: 40,
                                  required: true
                            },
                            con02description:
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
<?=$this->endSection();?>