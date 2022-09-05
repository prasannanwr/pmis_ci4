<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div class="container-fluid">
      <div class="panel panel-default">
            <div class="AddEdit-form ">
                  <div class="panel-heading">
                        <h1 class="">
                              State &raquo; Add/Edit Form
                        </h1>
                  </div>
                  <?php echo form_open_multipart($postURL, array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role' => 'form')) ?>
                  <div class="form-group">
                        <label for="first_name" class="col-sm-3 control-label">
                              Name:
                        </label>
                        <div class="col-sm-6">
                              <input id="province_name" class="form-control" type="text" name="province_name" maxlength="255" value="<?php echo et_setFormValBlank('province_name', $objOldRec); ?>" />
                        </div>
                  </div>
                  <div class="form-group">
                        <label for="first_name" class="col-sm-3 control-label">
                              code:
                        </label>
                        <div class="col-sm-6">
                              <input id="province_code" class="form-control" name="province_code" maxlength="10" value="<?php echo et_setFormValBlank('province_code', $objOldRec); ?>" />
                        </div>
                  </div>

                  <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                              <?php
                              $btn_submit = array(
                                    'province_id' => 'btn_submit',
                                    'name' => 'btn_submit',
                                    'value' => 'submit',
                                    'type' => 'submit',
                                    'content' => 'Submit',
                                    'class' => 'btn btn-primary'
                              );
                              ?>
                              <?php echo form_hidden('province_id', et_setFormVal('province_id', $objOldRec)); ?>
                              <?php echo form_button($btn_submit); ?>
                              <?php echo anchor('province', 'Cancel', array('class' => 'btn btn-default')); ?>
                        </div>
                  </div>
                  <?php echo form_close(); ?>

            </div>
      </div>
</div>

<script type="text/javascript">
      $(document).ready(function() {
            $('[autofocus]:not(:focus)').eq(0).focus();

            $('#emp-form').validate({
                  rules: {
                        dev01name: {
                              maxlength: 100,
                              required: true
                        },

                        dev01remark: {
                              maxlength: 50

                        }

                  },
                  highlight: function(element) {
                        $(element).closest('.form-group').removeClass('success').addClass('error');
                  },
                  success: function(element) {
                        element.text('OK!').addClass('valid').closest('.form-group').removeClass('error').addClass('success');
                  }
            });
      });
</script>
<?= $this->endSection() ?>