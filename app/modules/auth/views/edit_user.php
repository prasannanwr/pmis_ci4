    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
						User &raquo; Add/Edit Form
					</h1>
				</div>
                <?php echo form_open_multipart("users/create/".$user->id, array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role'=>'form')) ?>
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
                                ENUM_REGIONAL_MANAGER   => 'Regional Manager',
                                ENUM_GUEST              => 'Guest'
                            );
                            ?>
                               
							<?php
                            
                             echo form_dropdown('type', $typeoptions, $userType, 'class="form-control" ');?>
						</div>
					</div>  
                     <div class="form-group">
						<label for="district_auth" class="col-sm-3 control-label">
							Selected Region:
						</label>
						<div class="col-sm-6">
                         <?php echo et_form_dropdown_db('regional_office', 'regional_office', 'region_name','id', '','', 'class="form-control childDrops" id="regional_office"') ?>
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
                        <?php echo form_hidden('id', $user->id);?>
                        <?php echo form_hidden($csrf); ?>
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
<!--
<?php echo form_open_multipart("auth/edit_user/".$user->id, array('id' => 'emp-form', 'class' => 'form-horizontal')) ?>
      <div class="well">
      <div class="control-group">
            <label class="control-label" for="first_name">First Name:</label>
            <div class="controls">
                  <?php echo form_input($first_name);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="last_name">Last Name:</label>
            <div class="controls">
                  <?php echo form_input($last_name);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="gender">Gender:</label>
            <div class="controls">
      <label class="radio inline">
                  <?php echo form_radio($gender_m);?>Male
      </label>
      <label class="radio inline">
          <?php echo form_radio($gender_f);?>Female
      </label>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="city">City:</label>
            <div class="controls">
                  <?php echo form_input($city);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="country">Country:</label>
            <div class="controls">
                  <?php echo form_input($country);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="phone">Tel. No:</label>
            <div class="controls">
                  <?php echo form_input($phone);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="mobile">Mobile:</label>
            <div class="controls">
                  <?php echo form_input($mobile);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="academic1">Academic1:</label>
            <div class="controls">
                  <?php echo form_input($academic1);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="academic2">Academic2:</label>
            <div class="controls">
                  <?php echo form_input($academic2);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="academic3">Academic3:</label>
            <div class="controls">
                  <?php echo form_input($academic3);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="image">Upload Picture:</label>
            <div class="controls">
                  <?php echo form_input($image);?>
            </div>
      </div>
      </div>
      <div class="well">
      <div class="control-group">
            <label class="control-label" for="username">Username:</label>
            <div class="controls">
                  <?php echo form_input($username);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="password">Password:</label>
            <div class="controls">
                  <?php echo form_input($password);?>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label" for="password_confirm">Confirm Password:</label>
            <div class="controls">
                  <?php echo form_input($password_confirm);?>
            </div>
      </div>
      </div>

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
      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>
      <div class="form-actions">
            <?php echo form_button($btn_submit); ?>
            <?php echo anchor('employee', 'Cancel', array('class' => 'btn')); ?>
      </div>

<?php echo form_close();?>

<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.validate.min.js"></script>
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
                            }
                      },
                      highlight: function(element)
                      {
                        $(element).closest('.control-group').removeClass('success').addClass('error');
                      },
                      success: function(element)
                      {
                        element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
                      }
            });
      });
</script>
-->