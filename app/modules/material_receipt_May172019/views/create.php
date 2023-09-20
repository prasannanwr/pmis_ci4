<div class="container-fluid">
    <div class="panel panel-default">
        <div class="AddEdit-form ">
            <div class="panel-heading">
                <h1 class="">
                    Material&raquo;Receipt Form
                </h1>
            </div>
            <?php echo form_open_multipart($postURL, array('id' => 'material-form', 'class' => 'form-horizontal panel-body', 'role'=>'form','data-form'=>'validate')) ?>
            <?php if( isset($message) && $message!=''): ?>
                <div class="message">
                    <?php var_dump( $message);?>
                </div>
            <?php endif;?>

            <div class="row clearfix">

                <div class="col-lg-12">

                    <div class="col-lg-5">

                        <?php  if ($this->session->userdata('type') == ENUM_ADMINISTRATOR) { ?>
                        <div class="form-group">
                            <label for="type" class="col-sm-3 control-label">
                                Regional Office:
                            </label>
                            <div class="col-sm-6">
                                <?php echo et_form_dropdown_db('region', 'regional_office', 'region_name', 'region_code', '', '', 'class="form-control"') ?>
                                <?php echo form_error('region'); ?>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <label for="type" class="col-sm-3 control-label">
                                Type:
                            </label>
                            <div class="col-sm-6">
<!--                                <select name="type" id="type" class="form-control" id="type">-->
<!--                                    <option value="">--Please select--</option>-->
<!--                                    <option value="Bulldog">Bulldog grip</option>-->
<!--                                    <option value="Cable">Cable</option>-->
<!--                                </select>-->
                                <?php echo et_form_dropdown_db('type', 'material_type', 'name', 'id', et_setFormVal('name', $objOldRec), '', 'class="form-control"') ?>
                                <?php echo form_error('type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="diameter" class="col-sm-3 control-label">
                                Diameter:
                            </label>
                            <div class="col-sm-6">
<!--                                <select name="diameter" id="diameter" class="form-control">-->
<!--                                    <option value="">--Please select--</option>-->
<!--                                    <option value="13">13</option>-->
<!--                                    <option value="26">26</option>-->
<!--                                    <option value="32">32</option>-->
<!--                                    <option value="40">40</option>-->
<!--                                </select>-->
                                <?php echo et_form_dropdown_db('diameter', 'diameter', 'name', 'id', et_setFormVal('name', $objOldRec), '', 'class="form-control"') ?>
                                <?php echo form_error('diameter'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_id" class="col-sm-3 control-label">
                                Input Id:
                            </label>
                            <div class="col-sm-6">
                                <input id="input_id" class="form-control" type="text" name="input_id" maxlength="255" value="" readonly="readonly"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lot_no" class="col-sm-3 control-label">
                                Lot No./Reel No.:
                            </label>
                            <div class="col-sm-6">
                                <input id="lot_no" class="form-control" type="text" name="lot_no" maxlength="255" value="" readonly="readonly"  />
                                <?php echo form_error('lot_no'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="units" class="col-sm-3 control-label">
                                Units/Length:
                            </label>
                            <div class="col-sm-6">
                                <input id="units" class="form-control" type="text" name="units" maxlength="255" value=""  />
                                <?php echo form_error('units'); ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="receipt_date" class="col-sm-3 control-label">
                                        Receipt date:
                                    </label>
                                    <div class="col-lg-7 datebox-container ">
                                        <div class="col-lg-10 nopad datetimepicker input-group date ">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                            <input type="text" class=" form-control " name="receipt_date" id="receipt_date" value=""/>
                                        </div>
                                    </div>
                                    <?php echo form_error('receipt_date'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="purchased_by" class="col-sm-3 control-label">
                                        Purchased by:
                                    </label>
                                    <div class="col-sm-6">
                                        <?php echo et_form_dropdown_db('purchased_by', 'funding_agency', 'name', 'id', et_setFormVal('name', $objOldRec), '', 'class="form-control"') ?>
                                        <?php echo form_error('purchased_by'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-sm-3 control-label">
                                        Supplier:
                                    </label>
                                    <div class="col-sm-6">
                                        <?php echo et_form_dropdown_db('supplier', 'supplier', 'name', 'supplier_id', et_setFormVal('name', $objOldRec), '', 'class="form-control"') ?>
                                        <?php echo form_error('supplier'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rate" class="col-sm-3 control-label">
                                        Rate/meter or pcs:
                                    </label>
                                    <div class="col-sm-6">
                                        <input id="rate" class="form-control" type="text" name="rate" maxlength="255" value=""  />
                                        <?php echo form_error('rate'); ?>
                                    </div>
                                </div>
                            </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-12">
                            <?php
                            $btn_submit = array(
                                'dev01id' => 'btn_submit',
                                'name' => 'btn_submit',
                                'value' => 'submit',
                                'type' => 'submit',
                                'content' => 'Submit',
                                'class' => 'btn btn-primary'
                            );
                            $btn_add_more = array(
                                'dev01id' => 'btn_add_more',
                                'name' => 'btn_add_more',
                                'value' => 'submit',
                                'type' => 'submit',
                                'content' => 'Submit and Add more',
                                'class' => 'btn btn-primary'
                            );
                            ?>
                            <?php echo form_hidden('supplier_id', et_setFormVal('supplier_id', $objOldRec)); ?>
                            <?php echo form_button($btn_add_more); ?>
                            <?php echo form_button($btn_submit); ?>
                            <?php echo anchor('dashboard', 'Cancel', array('class' => 'btn btn-default')); ?>
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

                $('#material-form').validate(
                    {
                        rules:
                            {
                                type:
                                    {
                                        required: true
                                    },
                                material:
                                    {
                                        required: true
                                    },
                                input_id:
                                    {
                                        required: true
                                    },
                                lot_no:
                                    {
                                        required: true
                                    },
                                units:
                                    {
                                        required: true
                                    },
                                receipt_date:
                                    {
                                        required: true
                                    },

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

                /* auto generate the input id and lot no */
                var cyear ="<?php echo date("Y");?>";
                var region = "<?php echo $region;?>";
                var i = "<?php echo $last_record;?>";
                
                $("#diameter").on('change',function() {
                    var type = $("#type").val();
                    //var diameter = $("#diameter").val();
                    var diameter = $("#diameter option:selected").text();
                    <?php  if ($this->session->userdata('type') == ENUM_ADMINISTRATOR) { ?>
                    region = $("#region").val();
                    <?php } ?>
                    if(type == "1"){
                        var inputid = "R-"+cyear+region+"-"+diameter+"B-"+i;
                        var lot = region+"-"+diameter+"B-"+i;
                    } else {
                        var inputid = "R-"+cyear+region+"-"+diameter+"C-"+i;
                        var lot = region+"-"+diameter+"C-"+i;
                    }
                    $("#input_id").val(inputid);
                    
                    $("#lot_no").val(lot);
                    

                });
                $("#type").on('change',function() {
                    $("#input_id").val('');
                   // $("#lot_no").val('');
                    $("#diameter").val(' ');
                });
            });
        </script>