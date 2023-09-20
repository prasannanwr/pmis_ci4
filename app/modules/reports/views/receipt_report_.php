<div id="page-wrapper" class="largeRpt">    
        <div class="alignRight">             
        <form method="post" target="_blank" action="<?php echo site_url();?>reports/receipt_report_print">       
            <input type="hidden" name="receipt_num" value="<?php echo $receipt_num;?>"> 
       <input type="submit" target="_blank" class="btn btn-md btn-success" name="submit" value="Print" />
       </form>
   </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 mainBoard ">
                    
                    <!--<img src="<?php echo base_url();?>images/final_tbssp.gif" class="pull-right img-responsive">-->
                    <h2 class="alignLeft">Receipt of Materials</h2>
                </div>
                <div class="col-lg-10 mainBoard">                  
                    <p class="reportHeader center" >I have received following materials from <u><?php echo $arrReceiptInfo[0]->s_name;?></u> on <u><?php echo $arrReceiptInfo[0]->receipt_date?></u> in a good condition</p>
                    <p><b>Receipt no.:</b> <?php echo $receipt_num;?></p>
					<!--<div class="alignLeft">
                            <form method="post" action="<?php echo site_url();?>reports/receipt_report/">
                                <select name="receipt_num">
                                    <option value="<?=TYPE_CABLE;?>" <?php echo ($receipt_num == TYPE_CABLE)?'selected':'';?>>Cable</option>
                                    <option value="<?=TYPE_BULLDOG;?>" <?php echo ($receipt_num == TYPE_BULLDOG)?'selected':'';?>>Bulldog grip</option>
                                </select>
                                <input type="hidden" name="receipt_number" value="<?php echo $receipt_num;?>">
                                <input type="submit" class="btn btn-md btn-success" name="submit" value="Submit" />
                            </form>
                        </div>-->
                    <div class=" table-responsive" > 



						
                        <table class="table table-bordered table-hover" style="width:700px" align="center">                            
                            <thead>
                                <tr>
                                    <th class="center c1">SN</th>

                                    <th class="center c2">Item</th>

                                    <th class="center c3">Diameter in mm</th>

                                    <th class="center c4">Length(mtr) / Quantity</th>
                                   
                                </tr>
                               
                            </thead>
                            
        <!-- 2nd table-->

            <?php
                if ($arrReceiptInfo)
                {
?>
                <tbody>                   
                        <?php
                        $i = 1; 
                        foreach ($arrReceiptInfo as $value) {
                        ?>
                            <tr class="row<?php echo $i;?>">
								<td class="center" style="width:40px;"><?php echo $i;?></td>
                                <td class="center"><?php echo $value->typename;?></td>
								<td class="center"><?php echo $value->diametername;?></td>
								<td class="center"><?php echo $value->units;?></td>
							</tr>
                        <?php 
                    	}
                        $i++;
                        
                        ?>  
                        </tbody>
                        <?php } ?>                           
                        </table>     
                                      
                    </div>
                    
                </div><!---main board-->   
                         <div class="clear"></div>        
         <div class="col-lg-10 mainBoard">
                    <div class="col-lg-6 alignLeft">________________________________<br>Store Keeper Name</div>
                    <div class="col-lg-4 alignRight">_______________________________<br>Receipt date and Signature</div>
                </div>                  
                <!---footer-->                   
                <div class="clear"></div>             
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">Store Management System</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
               </div>                           
        <!---footer-->  
            </div><!--mainBoard Ends-->

            <div class="clear"></div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

