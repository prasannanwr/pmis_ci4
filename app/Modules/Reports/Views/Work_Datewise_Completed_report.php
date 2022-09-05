<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Work_Datewise_Completed_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_date" value="<?php echo $startdate; ?>" />
       <input type="hidden" name="end_date" value="<?php echo $enddate; ?>" />
       <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
       </form>
   </div>
            <div class="container-fluid">
                <div class="row">
					<div class="col-lg-12">
						<p class="reportHeader center" >Work Progress</p>
                        <p class="reportHeader center" >Project Status:Commited Bridges</p>
						<div class=" table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:36px;" class="center" rowspan="2" >SN</th>
                                        <th style="width:288px;" class="center" colspan="4">Bridge</th>
                                        <th style="width:288px;" class="center" colspan="2">VDC</th>                                                
                                        <th style="width:72px;" class="center" rowspan="2" >River Name</th>
                                        <th style="width:108px;" class="center" colspan="2">Walk Way Deck</th>
                                        <th style="width:432px;" class="center" colspan="11">ComponentWise Cost in NRs.</th>
                                        <th style="width:72px;" class="center" rowspan="2" >Remarks</th>
                                        
                                    </tr>
                                    <tr>
                                        <th  class="center">Number</th>
                                        <th  class="center">Name</th>
                                        <th  class="center">Type</th>
                                        <th  class="center">Span(m)</th>	
                                        <th  class="center">Left Bank</th>
                                        <th  class="center">Right Bank</th>
                                        <th  class="center">Type**</th>
                                        <th  class="center">Width(cm)</th>	
                                        <th  class="center">Site Assessment And Survey</th>
                                        <th  class="center"> Community Agrement</th>
                                        <th  class="center"> DMBT</th>
                                        <th  class="center"> 1st Phase of construction</th>
                                        <th  class="center"> Materil Supplied to UC</th>
                                        <th  class="center"> 2nd Phase of construction</th>
                                        <th  class="center"> Anchorage Conreating</th>
                                        <th  class="center"> Cable Pulling</th>
                                        <th  class="center"> Bridge Completion</th>
                                        <th  class="center"> BMC Formation</th>
                                        <th  class="center"> Target Completion</th>
                                                                                                                                                                                           	
                                    </tr>
                                </thead>
                                <tbody>
                          <tr class=" backColor">
                            <td colspan="22">
                            	<div class="center boldP lht" >Completed Bridges During Date: <?php  echo $startdate; ?> To <?php  echo $enddate; ?></div>
                                <div class="center boldP lht">Work Category: Completed</div>                            
                            </td>  

                           
                           </tr> 
                           
                    <?php if(is_array($arrPrintList)){  
                    foreach($arrPrintList as $dataRow){
                    reset($dataRow);$first_key = key($dataRow);
                       ?>
                       
                        <!-- 2nd table--> 
                        <?php foreach($dataRow as $dataRow1){ //var_dump($dataRow1); ?>  
                        <tr style="border-bottom:1px solid #fff;">
                        <td colspan="30">
                        <div class="col-lg-6"><b><span>District:<?php echo $dataRow1[0]->dist01name ;?></span></b></div>
                        <div class="col-lg-6"><b><span style="float:right;" >TBSU Regional Office:<?php echo $dataRow1[0]->tbis01name ;?></span></b></div>                        
                        </td>

                        </tr>
                      
						<tr style="border-top:1px solid #fff;">
                        <td colspan="30">
                        <b><span>Development Region:&nbsp;</span><span class="bold "> <?php echo $dataRow[$first_key][0]->dev01name ;?></span></b>
                        </td>                       
                        </tr>                                   
				
                    
                         <?php $i=1; foreach($dataRow1 as $dataRow2){ //var_dump($dataRow); ?>
                    	<tr>
                        	<td><?php echo $i;?></td>
                            <td><?php echo $dataRow2->bri03bridge_no; ?></td>
                            <td><?php echo $dataRow2->bri03bridge_name; ?></td>
                            <td><?php echo $dataRow2->bri01bridge_type_code; ?></td>
                            <td><?php echo $dataRow2->bri03design; ?></td>
                            <td><?php echo $dataRow2->left_muni01name; ?></td>
                            <td><?php echo $dataRow2->right_muni01name; ?></td>
                        	<td><?php echo $dataRow2->bri03river_name; ?></td>
                            <td><?php echo $dataRow2->wad01walkway_deck_type_name; ?></td>
                            <td><?php echo $dataRow2->wal01walkway_width; ?></td>
                            <td><?php echo $dataRow2->bri05site_assessment; ?></td>
                            <td><?php echo $dataRow2->bri05community_agreement; ?></td>
                            <td><?php echo $dataRow2->bri05dmbt; ?></td>
                            <td><?php echo $dataRow2->bri05first_phase_constrution; ?></td>
                        	<td><?php echo $dataRow2->bri05material_supply_uc; ?></td>
                            <td><?php echo $dataRow2->bri05second_phase_construction; ?></td>
                            <td><?php echo $dataRow2->bri05anchorage_concreting; ?></td>
                            <td><?php echo $dataRow2->bri05cable_pulling; ?></td>
                            <td><?php echo $dataRow2->bri05bridge_completion_target; ?></td>
                            <td><?php echo $dataRow2->bri05bmc_formation; ?></td>
                            <td><?php echo $dataRow2->bri05third_phase_construction; ?></td>
                            <td></td>                                                                                                        
                        </tr>
                    	 <?php  $i++;} ?>                                                
                        									 
                       
                          
                         <?php } } }else{  ?>  
                         Data not avaliable
                         <?php } ?>  
                         </tbody>

         
                              
		
                    	
                    	                                                
        
                 
 
                        	

                   

                        	
                        </table>
</div>                                    
                        <!---footer-->                                    
                        <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span><span> SN=Steel Truss RCC=Rainforced Cement Concrete</span></div>
                        <div class="col-lg-4 right"><span>Bridge Completion During:2/9/2010 To 2/9/2014</span></div>                                 
                        <div class="col-lg-3">2-September-2014</div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><span>Page 1 of 3</span></div>
                        <!---footer-->                                     
					</div>							
				    <div class="clear"></div>
		        </div>
                <!-- /.row -->               
            </div>
            <!-- /.container-fluid -->
        </div>
        <?=$this->endSection();?>