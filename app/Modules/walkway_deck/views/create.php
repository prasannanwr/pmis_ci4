<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
						Walkway Deck Type &raquo; Add/Edit Form
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
                            <input id="wad01walkway_deck_type_code" class="form-control" type="text" name="wad01walkway_deck_type_code" maxlength="3" value="<?php echo et_setFormValBlank('wad01walkway_deck_type_code', $objOldRec); ?>"  />
                            
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Name:
						</label>
						<div class="col-sm-6">
                            <input id="wad01walkway_deck_type_name" class="form-control" type="text" name="wad01walkway_deck_type_name" maxlength="30" value="<?php echo et_setFormValBlank('wad01walkway_deck_type_name', $objOldRec); ?>"  />
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="wad01description" class="form-control" name="wad01description" maxlength="100"><?php echo et_setFormValBlank('wad01description', $objOldRec); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'wad01id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('wad01id', et_setFormVal('wad01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('walkway_deck', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            wad01walkway_deck_type_code:
                            {
                                   maxlength: 4,
                                  required: true
                            },
                            wad01walkway_deck_type_name:
                            {
                                   maxlength: 39,
                                  required: true
                            },
                            wad01description:
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
<?= $this->endSection(); ?>