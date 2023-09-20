<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>

<?php $uRights = session()->get('user_rights'); ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="panel panel-primary registration">
            <div class="panel-heading">Add/Edit User</div>
            <div class="panel-body">
                <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <form class="" action="<?= site_url('user/register') ?>" method="post">
                    <div class="form-group" style="clear: both">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo ($arrData != ''?$arrData['name']: '');?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo ($arrData != ''? $arrData['email']: '');?>">
                    </div>
                    <?php if(empty($arrData)) : ?>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirm" id="password_confirm">
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="phone_no">Type</label>
                        <?php
                           $typeoptions = array(
                                ENUM_ADMINISTRATOR      => 'Administrator',
                                ENUM_CENTRAL_MANAGER    => 'Central Manager',
                                ENUM_REGIONAL_MANAGER   => 'Regional Manager',
                                ENUM_CENTRAL_OPERATOR   => 'Central Operator',
                                ENUM_REGIONAL_OPERATOR  => 'Regional Operator',
                                6                       => 'Guest' 
                            );
                           echo form_dropdown('type', $typeoptions, '5', 'class="form-control" ');
                               ?>
                    </div>
                    <!-- <div class="form-group">
                        <label for="phone_no">Rights</label>
                        <select class="form-control" name="rights">
                            <?php //foreach( $arrRights as $k=>$v): ?>
                            <option value="<?php //echo $k;?>" <?php //echo ($arrData != '' && ($k == $arrData['user_rights']))? 'selected ="selected"': '';?>><?php //echo $v;?></option>
                            <?php //endforeach;?>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="phone_no">Select District</label>
                        <!-- <select size="15"  class="form-control" name="district[]" multiple="multiple" id="selDistrict">
                            <?php //foreach( $arrDist as $row): ?>
                            <option value="<?php //echo $row['hlcit_code'];?>" <?php //echo ($arrData != '' && (in_array($row['hlcit_code'] , $arrData['distList'])))? 'selected ="selected"': '';?>><?php //echo $row['district'];?></option>
                            <?php //endforeach;?>
                        </select> -->
                        <?php //echo et_form_dropdown_db('district_auth[]', 'dist01district', 'dist01name','dist01id', ($arrData != ''?$arrData['dist_id']: ''),'', 'class="form-control childDrops" id="multiple" multiple="multiple" ') ?>
                        <?php // echo form_dropdown('District', $arrDistList, '');?>
                         <?php echo et_form_dropdown_db('district_auth[]', 'dist01district', 'dist01name','dist01id', '','', 'class="form-control childDrops" id="multiple" multiple="multiple" ') ?>

                    </div>
                    
                    <?php if( $arrPalika) : ?>
                    <div class="form-group">
                        <label for="phone_no">Palika</label>
                        <select size="7"  class="form-control" name="palika[]" multiple="multiple" id="palika" >
                            <option value="">-Select-</option>
                            <?php foreach( $arrPalika as $row): ?>
                            <option value="<?php echo $row['hlcit_code'];?>" <?php echo ($arrData != '' && (in_array($row['hlcit_code'] , $arrData['palikaList'])))? 'selected ="selected"': '';?>><?php echo $row['vdc_name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <?php endif; ?>
                    
                    <!-- <div class="form-group">
                        <label for="phone_no">Phone No</label>
                        <input type="text" class="form-control" name="phone_no" id="phone_no" >
                    </div> -->
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="submit" name="submit" class="btn btn-success" value="Cancel">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
<style>
#dataList ul li{
    margin-top: 10px;
}
</style>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#selDistrict").change(function() {
            var distcode = jQuery(this).val();
            jQuery.ajax({
                method: "GET",
                url: "<?=site_url('user/getPalika');?>",
                data: { distcode : distcode},
                success: function(msg) {
                    console.log(msg);
                    jQuery("#palika").html(msg)
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>