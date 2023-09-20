    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
					RM / UM  &raquo; Add/Edit Form
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
							Name:
						</label>
						<div class="col-sm-6">
                            <input id="muni01name" class="form-control" type="text" name="muni01name"  value="<?php echo et_setFormVal('muni01name', $objOldRec); ?>"  />
                            <?php echo form_error('muni01name'); ?>
						</div>
					</div>
                <div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Location Type:
						</label>
						<div class="col-sm-6">
                         <select class="form-control height" name="muni01type" id="muni01type">
							<option class="" value="<?php echo ENUM_LOC_MUNICIPALITY ;?>" >MUNICIPALITY</option>
							<option class="" value="<?php echo ENUM_LOC_VDC ;?>" >VDC</option>
							
						</select>
						</div>
					</div>                    
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							District Name:
						</label>
						<div class="col-sm-6">
                         <?php echo et_form_dropdown_db('muni01dist01id', 'dist01district', 'dist01name', 'dist01id', et_setFormVal('muni01dist01id', $objOldRec), '', 'class="form-control"') ?>
  
                            <?php echo form_error('muni01dist01id'); ?>
						</div>
					</div>
                    <div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							RM/UM Code:
						</label>
						<div class="col-sm-6">
                          <input id="muni01code" class="form-control" type="text" name="muni01code"  value="<?php echo et_setFormVal('muni01code', $objOldRec); ?>"  />
                            <?php echo form_error('muni01code'); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="dist0remark" class="form-control" name="dist01remark" ><?php echo et_setFormVal('dist01remark', $objOldRec); ?></textarea>
                            <?php echo form_error('dist01remark'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'muni01id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('muni01id', et_setFormVal('muni01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('vcd_municipality', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            muni01name:
                            {
                                   maxlength: 80,
                                  required: true
                            },
                            muni01type:
                            {
                                   maxlength: 9,
                                  required: true
                            },
                            
                             muni01remark:
                            {
                                   maxlength: 90,
                                  
                            },
                            
                             muni01code:
                            {
                                   maxlength: 9,
                                  required: true
                            },
                            
                             muni01dist01id:
                            {
                                   maxlength: 8,
                                  required: true
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
