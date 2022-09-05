<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

            <div class="container-fluid">
  
                <!-- Page Heading -->
                <div class="row">
                   <h2>Choose District</h2>
                </div>
                <!-- /.row -->
				<div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
					<div class="col-lg-5 clearfix">
                   <form action="<?php echo site_url();?>/reports/R_Completed_Palika_report<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" method="post">
                <div class="form-group clearfix">
                    <div class="form-group clearfix">
                        <label class="col-lg-4 ">District:</label>
                        <div class="col-lg-8 ">
                            <?php if(is_array($arrDistList)){ ?>
                                <select name="selAgency" class="form-control onChangeDist" data-targetvdc="#bri03municipality">
								<option>-Select District-</option>
                                    <?php foreach($arrDistList as $dataRow){ ?>
                                        <option value="<?php echo $dataRow->dist01id ;?>"><?php echo $dataRow->dist01name; ?></option>
                                    <?php }?>
                                </select>
                            <?php }?>   </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-lg-4 ">Municipality/Palika:</label>
                        <div class="col-lg-8 ">
                            <?php if(is_array($arrMunicipalityList)){ ?>
                                <select name="bri03municipality" id="bri03municipality" class="form-control">
								<option>-Select Palika-</option>
                                    <?php foreach($arrMunicipalityList as $dataRow){ ?>
                                        <option value="<?php echo $dataRow->muni01id ;?>"><?php echo $dataRow->muni01name; ?></option>
                                    <?php }?>
                                </select>
                            <?php } ?>   </div>
                    </div>
                <div class="form-group clearfix">
                <label class="col-lg-4 ">&nbsp;</label>
                <div class="col-lg-3 ">
                <input type="submit" class=" form-control btn btn-sm btn-primary" name="submit"  value="Report"/>
            </div>
               <div class="col-lg-3 ">
               <a href="<?php echo  site_url(); ?>" class=" form-control btn btn-sm btn-success">Back</a>
              <!--<input type="submit" class=" form-control btn btn-sm btn-success" name="submit"  value="Back"/>-->
            </div>
                </div>
                
                  </form>
                    
                        
					
                       
					</div>
					
				</div>
                <!-- /.row -->               
                </div>
                <!-- /.row -->

            </div>
<script type="text/javascript">
    $arrVDCList = <?php echo json_encode($arrVDCList);?>;
    function popCombo( $strTarget, $arrList, $strBind, $strDisp, $strSel ){

        $strRet = '';
        console.log($arrList);

        $.each($arrList, function(){

            $strRet += '<option value="'+this[ $strBind ] +'">' + this[$strDisp] + '</option>';

        });

        $( $strTarget ).append( $strRet );

    }

    function onChangeDistrict($targetObj, $srcSelDist){

        items = $arrVDCList.filter(function(item){

            return (item.dist01id == $srcSelDist);

        });

        $( $targetObj ).html('');

        popCombo( $targetObj, items, 'muni01id', 'muni01name');

    }

    $('.onChangeDist').on('change', function(){

        $target = $(this).data('targetvdc');
        console.log($(this).val());
        onChangeDistrict( $target, $(this).val() );

    })
</script>
            
            