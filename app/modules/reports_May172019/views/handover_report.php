<div id="page-wrapper" class="largeRpt">
        <div class="alignRight"> 
        
       <input type="submit" target="_blank" class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print()" />
       
   </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mainBoard">      
                    <h2>हस्तान्तरन फारम</h2>
                        <p class="center">नेपाल सरकार</p>
                        <p class="center">संघिय मामिला तथा स्थानीय विकास मन्त्रालय</p>
                        <p class="center">स्थानीय पुर्वाधार बिकास तथा कृषि सडक विभाग</p>
                        <p class="center">झुलुङे पूल क्षेत्रगत कार्यक्रम </p>                                             
                    


                    <div class=" table-responsive">
                        <div class="col-lg-3"><b>संस्था को नाम :</b> <?php echo $receiptInfo->org_name;?></div>
                        <div class="col-lg-3"><b>पूल को नाम :</b> <?php echo $receiptInfo->bridge_name;?></div>
                        <div class="col-lg-3"><b>जिल्ला :</b> <?php echo $receiptInfo->dist_name;?></div>
                        <div class="col-lg-3"><b>प्रदेश  :</b> <?php echo $receiptInfo->dist_state;?></div>
                        <div class="col-lg-3"><b>हस्तान्तरन मिती :</b> <?php echo $receiptInfo->issued_date;?></div>
                        <table class="table table-bordered table-hover" style="" align="center">
                            <thead>                                
                                <tr>
                                    <th class="center c1">सि स</th>
                                    <th class="center c2">सामान को विवरण </th>
                                    <th class="center c4">इकाइ</th>
                                    <th class="center c4">परीमाण</th>
                                    <th class="center c3">प्रती इकाइ मुल्य </th>
                                    <th class="center c4">जम्मा मुल्य</th>
                                </tr>
                            </thead>
                            
        <!-- 2nd table-->

            <?php
            
                if ($arrReceiptItems)
                {
?>
                <tbody>                   
                        <?php
                        $i = 1; 
                        $tot_cost = 0;
                        foreach ($arrReceiptItems as $value) {   
                            
                            $cost_per_unit = $value->units*$value->rate;
                            $tot_cost = $tot_cost + $cost_per_unit;
                        ?>
                            <tr class="row<?php echo $i;?>">
								<td class="center" style="width:40px;"><?php echo $i;?></td>
                                <td class="center"><?php echo ($value->materialtype);?></td>
                                <td class="center"><?php echo ($value->materialunit);?></td>
								<td class="center"><?php echo $value->units;?></td>								                            
                                <td class="center"><?php echo $value->rate;?></td>
                                <td class="center"><?php echo $cost_per_unit;?></td>
							</tr>
                        <?php 
                        $i++;
                    	}                        
                        ?>  
                        <tr>
                            <td colspan="5" class="text-right"><b>कुल मुल्य :</b></td>
                            <td class="center"><?php echo $tot_cost;?></td>
                        </tr>
                        </tbody>
                        <?php } ?>                           
                        </table>
                        <p>&nbsp;</p><p>&nbsp;</p>
                        <div class="col-lg-6">
                            <p class="text-left">______________________________________</p>
                            <p class="text-left">तयार गर्ने</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-right">______________________________________</p>
                            <p class="text-right">प्रमाणित गर्ने</p>
                        </div>
                        <p>माथि उल्लेखित गरिएका सामाग्रीहरु निम्न व्यक्तीहरुको रोहवरमा उल्लेखित बुझिलिएको छ ।</p>
                    </div>
                    <div class=" table-responsive">
                        <table class="table table-bordered table-hover" style="" align="center">
                            <thead>
                            <tr>
                                <th class="text-left" colspan="4">उपोभोग्ता वा निर्माण समितीका सदस्यहरु </th>
                            </tr>
                            <tr>
                                <th class="center c1" style="width:40px;">सि न</th>
                                <th class="center c1">नाम</th>
                                <th class="center c1">पद</th>
                                <th class="center c1">हस्ताक्ष्यर</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="center" style="width:40px;">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class=" table-responsive">
                        <table class="table table-bordered table-hover" style="" align="center">
                            <thead>
                            <tr>
                                <th class="text-left" colspan="4">टि बि एस् यू/एस् बि डि का प्रतिनिधि </th>
                            </tr>
                            <tr>
                                <th class="center c1" style="width:40px;">सि न</th>
                                <th class="center c1">नाम</th>
                                <th class="center c1">पद</th>
                                <th class="center c1">हस्ताक्ष्यर</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="center" style="width:40px;">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class=" table-responsive">
                        <table class="table table-bordered table-hover" style="" align="center">
                            <thead>
                            <tr>
                                <th class="text-left" colspan="4">जि वि स,गा वि स तथा गैर स स का प्रतिनिधिहरु </th>
                            </tr>
                            <tr>
                                <th class="center c1" style="width:40px;">सि न</th>
                                <th class="center c1">नाम</th>
                                <th class="center c1">पद</th>
                                <th class="center c1">हस्ताक्ष्यर</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="center" style="width:40px;">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div><!---main board-->

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

