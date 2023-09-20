<div class="container-fluid">
    <div class="panel panel-default">
        <div class="AddEdit-form ">
            <div class="panel-heading">
                <h1 class="">
                    Requisition Form
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

                    <div class="col-lg-7">

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
                            <label for="requisition_id" class="col-sm-3 control-label">
                                Requisition Id:
                            </label>
                            <div class="col-sm-6">
                                <input id="requisition_id" class="form-control" type="text" name="requisition_id" maxlength="255" value="<?php echo $requisition_id;?>" readonly="readonly"  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="issued_for" class="col-sm-3 control-label">
                                Issued to:
                            </label>
                            <div class="col-sm-6">
                                <?php echo et_form_dropdown_db('issued_for', 'organization', 'name', 'organization_id', et_setFormVal('name', $objOldRec), '', 'class="form-control"') ?>
                                <?php echo form_error('issued_for'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bridge_name" class="col-sm-3 control-label">
                                Bridge name:
                            </label>
                            <div class="col-sm-6">
                                <input id="bridge_name" class="form-control" type="text" name="bridge_name" maxlength="255" value=""  />
                                <?php echo form_error('bridge_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="district" class="col-sm-3 control-label">
                                District:
                            </label>
                            <div class="col-sm-6">
                                <?php //echo et_form_dropdown_db('district', 'district', 'dist_name', 'dist_id', et_setFormVal('dist_name', $objOldRec), '', 'class="form-control"') ?>
                                <?php echo et_form_dropdown_db_dist('district',

                                    'district', 'dist_name', 'dist_id',

                                    et_setFormVal('dist_name', $objOldRec),

                                    '',

                                    'class="form-control onChangeDist" data-targetvdc="#palika" ', array('SortBy'=>'dist_name'));?>

                                <?php echo form_error('district'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">State</label>
                            <div class="col-sm-6 ">
                                <input id="state" class="form-control" type="text" name="state" value="" readonly  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Palika</label>
                            <div class="col-sm-6 ">
							<!--<input id="palika" class="form-control" type="text" name="palika" maxlength="255" value=""  />-->
                                <?php echo form_error('palika'); ?>
                                <?php echo et_form_dropdown_db('palika',

                                   'muni01municipality_vcd', 'muni01name','muni01id',
								   
                                   '',
								   
                                   '', 
								   
								   'class="form-control" ', array('SortBy'=>'muni01name DESC')) ?>
									
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bridge_num" class="col-sm-3 control-label">
                                Bridge no.:
                            </label>
                            <div class="col-sm-6">
                                <input id="bridge_num" class="form-control" type="text" name="bridge_num" maxlength="255" value=""  />
                                <?php echo form_error('bridge_num'); ?>
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

                $arrVDCList = <?php echo json_encode($arrVDCList);?>;

                function popCombo( $strTarget, $arrList, $strBind, $strDisp, $strSel ){

                    $strRet = '';

                    $.each($arrList, function(){

                        $strRet += '<option value="'+this[ $strBind ] +'">' + this[$strDisp] + '</option>';

                    });

                    $( $strTarget ).append( $strRet );

                }

                function onChangeDistrict($targetObj, $srcSelDist){

                    items = $arrVDCList.filter(function(item){

                        return (item.muni01dist01id == $srcSelDist);

                    });

                    $( $targetObj ).html('');

                    popCombo( $targetObj, items, 'muni01id', 'muni01name');

                }

                $('.onChangeDist').on('change', function(){

                    $target = $(this).data('targetvdc');
                    //console.log($target);

                    onChangeDistrict( $target, $(this).val() );

                    //update state
                    var district = $(this).val();
                    $.ajax({
                        method: "GET",
                        url: "<?php echo $ajaxURL;?>",
                        data: { dist_id: district}
                    }).done(function (msg) {
                        $("#state").val(msg);
                    })

                });

                <?php  if ($this->session->userdata('type') == ENUM_ADMINISTRATOR) { ?>
                $('#region').on('change', function() {
                    var region  = $(this).val();
                    var datey = <?php echo date("Y");?>;
                    var last_record = <?php echo $last_record; ?>;
                    var requision_num = region+"Ri-"+datey+last_record+"D";
                    $('#requisition_id').val(requision_num);
                });
                <?php } ?>

                /* auto generate the input id and lot no */
                var cyear ="<?php echo date("Y");?>";
            });
        </script>