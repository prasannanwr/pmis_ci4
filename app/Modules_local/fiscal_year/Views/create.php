<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
						Fiscal Year&raquo; Add/Edit Form
					</h1>
				</div>
               <?php echo form_open_multipart($postURL, array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role'=>'form')) ?>
        
                    <?php if( isset($message) && $message!=''): ?>
                    <div class="message alert alert-danger">
                        <?php var_dump($message) ;?>
                    </div>
                    <?php endif;?>
					<?php 
						$currentyear = date("Y"); 						
						$currentmonth = date("m");
						$currentday = date("d");
						$nextfy = $currentyear.($currentyear+1);						
						?>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label ">
							Fiscal Year
						</label>
						<div class="col-sm-6">						
						<?php if($objOldRec != '') { ?>
                            <input id="fis01year" class="form-control" type="text" name="fis01year" maxlength="9" value="<?php echo et_setFormVal('fis01year', $objOldRec); ?>" readonly="readonly" />
						<?php } else { ?>
							<input id="fis01year" class="form-control" type="text" name="fis01year" maxlength="9" value="<?php echo $nextfy?>" readonly="readonly"  />
						<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label  ">
						  Code:
						</label>
						<div class="col-sm-6">
						<?php if($objOldRec != '') { ?>
                            <input id="fis01code" class="form-control" type="text" name="fis01code" maxlength="10" value="<?php echo et_setFormVal('fis01code', $objOldRec); ?>"  />
						<?php } else { ?>
							<input id="fis01code" class="form-control" type="text" name="fis01code" maxlength="10" value="<?php echo $nextfy; ?>"  />
						<?php } ?>
						</div>
					</div>
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
						  if($currentmonth >= 7 && $currentday >= 16) {
							  $btn_submit = array(
                                      'id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
						  } else {
							  if($objOldRec != '') {
							  $btn_submit = array(
                                      'id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );								
							  } else {
								  $btn_submit = array(
                                      'id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary',
									  'disabled' => 'disabled'
                                );
								echo "You cannot add new Fiscal year before July 16.";
							  }
						  }
                          ?>
                        <?php echo form_hidden('id', et_setFormVal('id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('fiscal_year', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            fis01year:
                            {
                                   maxlength: 9,
                                  number: true
                            },
                            fis01code:
                            {
                                   maxlength: 10,
                                  
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