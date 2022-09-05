<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
    <div class="container-fluid">
		<div class="panel panel-default">
			<div class="AddEdit-form ">
				<div class="panel-heading">
					<h1 class="">
						Annual Planning &raquo; Add/Edit Form
					</h1>
				</div>
                <?php echo form_open_multipart($postURL, array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role'=>'form')) ?>
                  
                    <?php if( isset($message) && $message!=''): ?>
                    <div class="message alert alert-danger">
                        <?php var_dump($message) ;?>
                    </div>
                    <?php endif;?>
                    <input type="hidden" name="fconst" value="<?php echo $fc;?>" />
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label ">
							Fiscal Year:
						</label>
						<div class="col-sm-6">
                            <input readonly="readonly" class="form-control" value="<?php echo $fy;//echo et_setFormVal('fis02year', $fy); ?>"  />
                            <input type="hidden" id="fis02year" class="form-control" type="text" name="fis02year" maxlength="15" value="<?php echo $fy;//echo et_setFormVal('fis02year', $fy); ?>"  />
						</div>
					</div>
					<div class="form-group">
						<label for="first_name" class="col-sm-3 control-label  ">
						  District Name:
						</label>
						<div class="col-sm-6">
                        <input type="hidden" id="fis02dist01codeid" class="form-control" type="text" name="fis02dist01codeid" maxlength="15" value="<?php echo $arrDistrictList->dist01code;//echo et_setFormVal('fis02dist01codeid', $objOldRec); ?>"  />
                        <input readonly="readonly" class="form-control" type="text"  value="<?php echo $arrDistrictList->dist01name ; ?>"  />
                      
                         <?php // echo et_form_dropdown_db('fis02dist01codeid', 'dist01district', 'dist01name','dist01code', et_setFormVal('fis02dist01codeid', $objOldRec),'', 'class="form-control"') ?>
                        
                            
						</div>
					</div>
                    
                    
                    
                      <div class="form-group">
					
						<div class="col-sm-12">
                         <table style="text-align: center;">
                          
                       <thead>
                       <tr>
                          <th class="center" style="width:200px;">
                           Major Funding Agency
                          </th>
						  <th class="center">
                           YPO C/Over
                          </th>
                         <th class="center">
                           YPO New
                          </th>
						  <th class="center">
                           Anticipated Completion
                          </th>
						  <th class="center">
                           Carryover from previous FY
                          </th>
                         <!--<th class="center">
                           New Committed
                          </th>-->
                          </tr>
                          </thead>
                <?php    if(is_array($arrDataList)){
                foreach($arrDataList as $dataRow){
                 
                ?>

                          <tr>
                          <td class="center" style="width:200px;"><?php echo $dataRow->sup01sup_agency_name;?>:</td>
						  <td class="center">
                           <input id="fis02name4" class="form-control" type="text" name="fis02name3_sup<?php echo $dataRow->sup01id;?>" maxlength="100" value="<?php echo (isset($arrSupData['sup_'. $dataRow->sup01id]))?$arrSupData['sup_'. $dataRow->sup01id]->fis02name3: 0 ; ?>"  />
                            
                           </td>
                            <td class="center">
                           <input id="fis02name4" class="form-control" type="text" name="fis02name4_sup<?php echo $dataRow->sup01id;?>" maxlength="100" value="<?php echo (isset($arrSupData['sup_'. $dataRow->sup01id]))?$arrSupData['sup_'. $dataRow->sup01id]->fis02name4: 0 ; ?>"  />
                            
                           </td>
						   <td class="center">
                           <input id="fis02name4" class="form-control" type="text" name="fis02name2_sup<?php echo $dataRow->sup01id;?>" maxlength="100" value="<?php echo (isset($arrSupData['sup_'. $dataRow->sup01id]))?$arrSupData['sup_'. $dataRow->sup01id]->fis02name2: 0 ; ?>"  />
                            
                           </td>  
                           <td class="center" style="display:none">
                           <input id="fis02name4" class="form-control" type="text" name="fis02name1_sup<?php echo $dataRow->sup01id;?>" maxlength="100" value="<?php echo (isset($arrSupData['sup_'. $dataRow->sup01id]))?$arrSupData['sup_'. $dataRow->sup01id]->fis02name1: 0 ; ?>"  />
                            
                           </td>
						    <td class="center">
                           <input id="fis02carryover" class="form-control" type="text" name="fis02carryover_sup<?php echo $dataRow->sup01id;?>" maxlength="100" value="<?php echo (isset($arrSupData['sup_'. $dataRow->sup01id]))?$arrSupData['sup_'. $dataRow->sup01id]->fis02carryover: 0 ; ?>"  />
                            
                           </td>
                          </tr>
                        
                    <?php }}?>
					
					 </table>
                           
					</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
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
                        <?php echo form_hidden('fis02id', et_setFormVal('fis02id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php //echo anchor('bridge', 'Cancel', array('class' => 'btn btn-default')); ?>
                        <button type="submit" name="submit" class="btn btn-success" value="Cancel">Cancel</button>
						</div>
					</div>
                    <?php echo form_close();?>

			</div>
		</div>
    </div>
    <?= $this->endSection() ?>