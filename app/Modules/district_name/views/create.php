<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
					zone &raquo; Add/Edit Form
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
							District Name:
						</label>
						<div class="col-sm-6">
                            <input id="dist01name" class="form-control" type="text" name="dist01name" maxlength="50" value="<?php echo et_setFormVal('dist01name', $objOldRec); ?>"  />
                          
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Zone:
						</label>
						<div class="col-sm-6">
                      <?php echo et_form_dropdown_db('dist01zon01id', 'zon01zone', 'zon01name', 'zon01id', et_setFormVal('dist01zon01id', $objOldRec), '', 'class="form-control"') ?>
                          
						</div>
					</div>
                    <div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							code:
						</label>
						<div class="col-sm-6">
                            <input id="dist01code" class="form-control" type="text" name="dist01code" maxlength="4" value="<?php echo et_setFormVal('dist01code', $objOldRec); ?>"  />
                          
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Regional Office:
						</label>
						<div class="col-sm-6">
                      <?php echo et_form_dropdown_db('dist01tbis01id', 'tbis01regional_office', 'tbis01name', 'tbis01id', et_setFormVal('dist01tbis01id', $objOldRec), '', 'class="form-control"') ?>					  
                           
						</div>
					</div>

          <div class="form-group">
            <label for="first_name" class="col-sm-3 control-label">
              State:
            </label>
            <div class="col-sm-6">
                      <?php echo et_form_dropdown_db('province_id', 'province', 'province_name', 'province_id', et_setFormVal('dist01state', $objOldRec), '', 'class="form-control"') ?>           
                           
            </div>
          </div>
				
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="dist01remark" class="form-control" name="dist01remark" maxlength="100"><?php echo et_setFormVal('dist01remark', $objOldRec); ?></textarea>
                           
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'zon01id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('dist01id', et_setFormVal('dist01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('district_name', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            dist01name:
                            {
                                   maxlength: 50,
                                  required: true
                            },
                            dist01zon01id:
                            {
                                   maxlength: 4,
                                 
                            },
                            dist01remark:
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
<?=$this->endSection();?>