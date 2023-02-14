<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
				Main Walkway Cable Diam &raquo; Add/Edit Form
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
						Main Walkway Cable Diam Type Code:
						</label>
						<div class="col-sm-6">
                            <input id="cab01mcnww_type_code" class="form-control" type="text" name="cab01mcnww_type_code" maxlength="5" value="<?php echo et_setFormVal('cab01mcnww_type_code', $objOldRec); ?>"  />
                            
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Main Walkway Cable Diam Type Number:
						</label>
						<div class="col-sm-6">
                            <input id="cab01mcnww_type_number" class="form-control" type="text" name="cab01mcnww_type_number" maxlength="5" value="<?php echo et_setFormVal('cab01mcnww_type_number', $objOldRec); ?>"  />
                            
						</div>
					</div>
                    <div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
						Description:
						</label>
						<div class="col-sm-6">
                            <input id="cab01description" class="form-control" type="text" name="cab01description"  value="<?php echo et_setFormVal('cab01description', $objOldRec); ?>"  />
                            
						</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'cab01id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('cab01id', et_setFormVal('cab01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('main_walkway_cable_number', 'Cancel', array('class' => 'btn btn-default')); ?>
						</div>
					</div>
                    <?php echo form_close();?>

			</div>
		</div>
    </div>
                

<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
      {
            $('[autofocus]:not(:focus)').eq(0).focus();
            
            $('#emp-form').validate(
            {
                      rules:
                      {
                            cab01mcnww_type_code:
                            {
                                   maxlength: 5,
                                  
                            },
                            cab01mcnww_type_number:
                            {
                                   maxlength: 5,
                                   
                            },
                            cab01description:
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