    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
						Contributing Agencies &raquo; Add/Edit Form
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
                            <input id="sup01sup_agency_code" class="form-control" type="text" name="sup01sup_agency_code" maxlength="3" value="<?php echo et_setFormVal('sup01sup_agency_code', $objOldRec); ?>"  />
                            <?php echo form_error('sup01sup_agency_code'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Name:
						</label>
						<div class="col-sm-6">
                            <input id="sup01sup_agency_name" class="form-control" type="text" name="sup01sup_agency_name" maxlength="30" value="<?php echo et_setFormVal('sup01sup_agency_name', $objOldRec); ?>"  />
                            <?php echo form_error('sup01sup_agency_name'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Type:
						</label>
						<div class="col-sm-6">
                        
                        <select class="form-control height" name="sup01sup_agency_type" id="sup01sup_agency_type">
						 <?php if( $objOldRec->sup01sup_agency_type == '' || $objOldRec->sup01sup_agency_type == 'null' ){?>
                           
                            <option class=""  value="0"  >None</option>
							<option class=""  value="<?php echo ENUM_SUPPORT_LOCAL ;?>" >Local</option>
							<option class="" value="<?php echo ENUM_SUPPORT_GOVERMENT ;?>"  >Govt.</option>
							<option class="" value="<?php echo ENUM_SUPPORT_OTHER ;?>" >Other</option>
                             
						    <?php }else{ ?>
                            
                            <option class=""  value="0" <?php echo $objOldRec->sup01sup_agency_type == 0 ? "selected": " " ; ?> >None</option>
							<option class=""  value="<?php echo ENUM_SUPPORT_LOCAL ;?>" <?php echo $objOldRec->sup01sup_agency_type == ENUM_SUPPORT_LOCAL ? "selected": " " ; ?> >Local</option>
							<option class="" value="<?php echo ENUM_SUPPORT_GOVERMENT ;?>" <?php echo $objOldRec->sup01sup_agency_type == ENUM_SUPPORT_GOVERMENT ? "selected": " " ; ?> >Govt.</option>
							<option class="" value="<?php echo ENUM_SUPPORT_OTHER ;?>" <?php echo $objOldRec->sup01sup_agency_type == ENUM_SUPPORT_OTHER ? "selected": " " ; ?> >Other</option>
                             
                         <?php } ?>
                                 
                    	</select>                        
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Indexing:
						</label>
						<div class="col-sm-6">
                        
                        <select class="form-control height" name="sup01index" id="sup01index">
                            
					 <?php if( $objOldRec->sup01index == '' || $objOldRec->sup01index == 'null' ){?>
                             <?php 
                            for ($i = 1; $i <= 15; $i++) {
                             ?>
 							<option class=""  value="<?php echo $i ; ?>"  ><?php echo $i; ?></option>
					       <?php 
                            } 
                            ?>
					<?php }else{ ?>
                             <?php 
                            for ($i = 1; $i <= 15; $i++) {
                             ?>
 							<option class=""  value="<?php echo $i ; ?>" <?php echo $objOldRec->sup01index == $i ? "selected": " " ; ?> ><?php echo $i; ?></option>
					       <?php 
                            } 
                            ?>
                    
                    <?php } ?>
                            

                    	</select>                        
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							Description:
						</label>
						<div class="col-sm-6">
                            <textarea id="sup01description" class="form-control" name="sup01description" maxlength="100"><?php echo et_setFormVal('sup01description', $objOldRec); ?></textarea>
                            <?php echo form_error('sup01description'); ?>
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
                        <?php echo anchor('supporting_agencies', 'Cancel', array('class' => 'btn btn-default')); ?>
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
                            sup01sup_agency_code:
                            {
                                   maxlength: 9,
                                  required: true
                            },
                            sup01sup_agency_name:
                            {
                                   maxlength: 39,
                                  required: true
                            },
                            sup01sup_agency_type:
                            {
                                   maxlength: 29,
                                  
                            },
                            sup01description:
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
