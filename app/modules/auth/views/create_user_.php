    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
						User &raquo; Add/Edit Form
					</h1>
				</div>
                <?php echo form_open_multipart("users/create", array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role'=>'form')) ?>
                    <?php if( $message): ?>
                    <div class="alert alert-danger">
                        <?php echo $message;?>
                    </div>
                    <?php endif;?>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label">
							First Name:
						</label>
						<div class="col-sm-6">
                            <?php echo form_input($first_name);?>
						</div>
					</div>
					<div class="form-group">
						<label for="last_name" class="col-sm-3 control-label">
							Last Name:
						</label>
						<div class="col-sm-6">
							<?php echo form_input($last_name);?>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">
							Email:
						</label>
						<div class="col-sm-6">
							<?php echo form_input($email);?>
						</div>
					</div>
                    <div class="form-group">
						<label for="type" class="col-sm-3 control-label">
							Type:
						</label>
						<div class="col-sm-6"> 
                           <?php
                           $typeoptions = array(
                                ENUM_ADMINISTRATOR      => 'Administrator',
                                ENUM_CENTRAL_MANAGER    => 'Central Manager',
                                ENUM_REGIONAL_MANAGER   => 'Regional Manager',
                                ENUM_CENTRAL_OPERATOR   => 'Central Operator',
                                ENUM_REGIONAL_OPERATOR  => 'Regional Operator',
                            );
                               ?>
                               
							<?php
                             if(is_array($arrDistList)){
                              //  var_dump($arrDistList);
                             }
                             echo form_dropdown('type', $typeoptions, '5', 'class="form-control" ');?>
						</div>
					</div>  
                     <div class="form-group">
						<label for="district_auth" class="col-sm-3 control-label">
							Selected District:
						</label>
						<div class="col-sm-6">
							<?php // echo form_dropdown('District', $arrDistList, '');?>
                         <?php echo et_form_dropdown_db('district_auth[]', 'dist01district', 'dist01name','dist01id', '','', 'class="form-control childDrops" id="multiple" multiple="multiple" ') ?>

						</div> 
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-3 control-label">
							Username:
						</label>
						<div class="col-sm-6">
							<?php echo form_input($username);?>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">
							Password:
						</label>
						<div class="col-sm-6">
							<?php echo form_input($password);?>
						</div>
					</div>
					<div class="form-group">
						<label for="password_confirm" class="col-sm-3 control-label">
							Confirm Password:
						</label>
						<div class="col-sm-6">
							<?php echo form_input($password_confirm);?>
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
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('users', 'Cancel', array('class' => 'btn btn-default')); ?>
						</div>
					</div>
                    <?php echo form_close();?>

			</div>
		</div>
    </div>
                

<link href="<?php echo base_url(); ?>js/choosen/chosen.css" rel="stylesheet">
  
<script type="text/javascript" src="<?php echo base_url(); ?>js/choosen/chosen.jquery.js"></script>
<script type="text/javascript">
    ///$(document).ready(function() {
        //$('#multiselected').multiselect();
    //});
</script>
<script type="text/javascript">
       $(document).ready(function() {
        function applyChoosen()
        {
        	$('.childDrops').chosen({width: '550px'});
        }
        applyChoosen();
        });
    </script>
<script type="text/javascript">


$(document).ready(function()
      {
            $('[autofocus]:not(:focus)').eq(0).focus();
            
            $('#emp-form').validate(
            {
                      rules:
                      {
                            first_name:
                            {
                                  required: true
                            },
                            last_name:
                            {
                                  required: true
                            },
                            username:
                            {
                                  minlength: 5,
                                  required: true
                            },
                            password:
                            {
                                  minlength: 8,
                                  required: true
                            },
                            password_confirm:
                            {
                                  minlength: 8,
                                  required: true,
                                  equalTo: "#password"
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