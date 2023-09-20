<div class="container-fluid">
    <div class="panel panel-default">
        <div class="AddEdit-form ">
            <div class="panel-heading">
                <h1 class="">
                    Material Issue Form
                </h1>
            </div>
            <?php echo form_open_multipart($postURL, array('id' => 'requisition-form', 'class' => 'form-horizontal panel-body', 'role'=>'form','data-form'=>'validate')) ?>
            <?php if( isset($message) && $message!=''): ?>
                <div class="message">
                    <?php var_dump( $message);?>
                </div>
            <?php endif;?>

            <div class="row clearfix">

                <div class="col-lg-12">

                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="requisition_num" class="col-sm-3 control-label">
                                Requisition No.:
                            </label>
                            <div class="col-sm-6">
                                <?php if($this->session->userdata('type') == ENUM_ADMINISTRATOR) { ?>
                                    <?php echo et_form_dropdown_db('requisition_num', 'requisition', 'req_id', 'id', et_setFormVal('requisition_num', $objOldRec), '', 'class="form-control"') ?>
                                <?php } else { ?>
                                    <?php echo et_form_dropdown_db('requisition_num', 'requisition', 'req_id', 'id', et_setFormVal('requisition_num', $objOldRec), array(0=>'region',1=>$region), 'class="form-control"') ?>
                                <?php } ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="issued_to" class="col-sm-3 control-label">
                                Issued to:
                            </label>
                            <div class="col-sm-6">
                                <input id="issued_to" class="form-control" type="text" name="issued_to" maxlength="255" value="<?php echo et_setFormValBlank('org_name', $objOldRec); ?>" readonly="readonly"  />
                                <?php echo form_error('issued_to'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bridge_name" class="col-sm-3 control-label">
                                Bridge name:
                            </label>
                            <div class="col-sm-6">
                                <input id="bridge_name" class="form-control" type="text" name="bridge_name" maxlength="255" value="<?php echo et_setFormValBlank('bridge_name', $objOldRec); ?>" readonly="readonly"  />
                                <?php echo form_error('bridge_name'); ?>
                            </div>
                        </div>                     

                        <div class="form-group">
                            <label for="lot" class="col-sm-3 control-label">
                                Reel/Lot No:
                            </label>
                            <div class="col-sm-6">
                                <?php if($this->session->userdata('type') == ENUM_ADMINISTRATOR) { ?>
                                    <?php echo et_form_dropdown_db('lot', 'material_receipt', 'lot', 'id', et_setFormVal('lot', $objOldRec), '', 'class="form-control"') ?>
                                <?php } else { ?>
                                <?php echo et_form_dropdown_db('lot', 'material_receipt', 'lot', 'id', et_setFormVal('lot', $objOldRec), array(0 => 'region',1=> $region), 'class="form-control"') ?>
                                <?php } ?>
                                <?php echo form_error('lot'); ?>
                            </div>
                            <p class="stockinfo"></p>
                        </div>

                        <div class="form-group">
                                    <label for="issued_date" class="col-sm-3 control-label">
                                        Issued date:
                                    </label>
                                    <div class="col-lg-7 datebox-container ">
                                        <div class="col-lg-10 nopad datetimepicker input-group date ">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                            <input type="text" class=" form-control " name="issued_date" id="issued_date" value="<?php echo et_setFormValBlank('issued_date', $objOldRec); ?>"/>
                                        </div>
                                    </div>
                                    <?php echo form_error('issued_date'); ?>
                                </div>

                        <div class="form-group">
                            <label for="units" class="col-sm-3 control-label">
                                Length/Units:
                            </label>
                            <div class="col-sm-6">
                                <input id="units" class="form-control" type="text" name="units" maxlength="255" value="<?php echo et_setFormValBlank('units', $objOldRec); ?>"  />
                                <?php echo form_error('units'); ?>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-6 table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>                                
                                <th width="5px">SN</th>
                                <th>Diameter</th>
                                <th>Length/Nos</th>
                                <th>Item</th>                                
                            </tr>
                        </thead>
                        <tbody id="issued_data">
                            <?php
                            if(isset($materialIssueinfo)) {
                                $i =1;
                                $str = '';
                                foreach ($materialIssueinfo as $material) {            
                                    $str .="<tr><td>$i</td>";
                                    $str .="<td>".$material->diametername."</td>";
                                    $str .="<td>".$material->units."</td>";
                                    if($material->type == "1"){
                                        $str .="<td>Bulldog grip</td>";
                                    } else {
                                        $str .="<td>Cable</td>";
                                    }
                                    $str .="</tr>";
                                    $i++;
                                }
                                echo $str;
                            }
                            ?>
                        </tbody>
                    </table>
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
                        ?>
                        <?php echo form_hidden('id', et_setFormVal('id', $objOldRec)); ?>
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
                $('#requisition-form').validate(
                    {
                        rules:
                            {
                                requisition_id:
                                    {
                                        required: true
                                    },
                                issued_for:
                                    {
                                        required: true
                                    },
                                bridge_name:
                                    {
                                        required: true
                                    },
                                district:
                                    {
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

                $("#requisition_num").on('change',function () {                    
                    var reqnum = $(this).val();
                    $.ajax({
                        method: "GET",
                        url: "<?php echo $ajaxURL;?>",
                        data: { reqid: reqnum}
                    }).done(function (msg) {                        
                        //console.log(msg);return false;
                        var data = JSON.parse(msg);
                        $("#bridge_name").val(data.bridge);
                        $("#issued_to").val(data.issued);
                        $("#issued_data").html(data.issued_data);
                    })
                });

                /* lot number change */
                $("#lot").on('change',function () {
                    var lot = $(this).val();
                    $.ajax({
                        method: "GET",
                        url: "<?php echo $ajaxStockURL;?>",
                        data: { lot: lot}
                    }).done(function (msg) {
                        $(".stockinfo").html(msg);
                    })
                });

            });
        </script>