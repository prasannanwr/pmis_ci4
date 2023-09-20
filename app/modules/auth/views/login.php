<!-- TPL File: <?php echo __FILE__ ;?> -->
<?php
  $btn_login = array(
    'id' => 'btn_login',
    'name' => 'btn_login',
    'value' => 'login',
    'type' => 'submit',
    'content' => 'Login',
    'class' => 'btn btn-primary'
  );
?>
        <div class="">          
        <div class=" col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">          
        <div class="login-form ">          
        <h1> Log In </h1>
<?php echo form_open('auth/login', array('id' => 'login-form', 'class' => '')) ?>
  <?php if (validation_errors() != ""): ?>
    <div class="alert alert-error" >
      <?php echo validation_errors(); ?>
    </div>
  <?php endif ?>

            <div class="form-group">
            <label>User Name</label>
              <?php //echo form_input($identity) ?>
              <input type="text" class="form-control" placeholder="User Name" id="identity" name="identity">
            </div>
             <div class="form-group">
            <label>Password</label>
              <?php //echo form_input($password) ?>
              <input type="password" class="form-control" placeholder="Password" id="password" name="password">
            </div>
            <?php echo form_button($btn_login); ?>
         </form>
         </div>
        </div>        
        </div> 

</form>
<style>
.alert.alert-error.alert-dismissable{
  font-size: 18px;
   text-align: center;
    padding-bottom: 0px; 
    font-weight: bold;  
}

</style>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
  {
      $('[autofocus]:not(:focus)').eq(0).focus();
      $('#login-form').validate(
        {
          rules:
          {
            identity:
            {
              required: true
            },
            password:
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
	
	$("#identity").focus();
  });
</script>