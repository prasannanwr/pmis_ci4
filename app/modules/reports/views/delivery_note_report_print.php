<div id="page-wrapper" class="largeRpt">        

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mainBoard">      
                    <h2>Delivery Note चलानी </h2>
                        <p class="center">नेपाल सरकार</p>
                        <p class="center">संघिय मामिला तथा स्थानीय विकास मन्त्रालय</p>
                        <p class="center">स्थानीय पुर्वाधार बिकास तथा कृषि सडक विभाग</p>
                        <p class="center">झुलुङे पूल क्षेत्रगत कार्यक्रम </p>  
						<div class="col-lg-12 alignRight">  <p class="right">Issue no.:<?php echo $receiptInfo->req_id;?></p></div>
                    


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
                                    <th class="center c3">प्रती इकाइ भार </th>
                                    <th class="center c4">जम्मा भार [के जी ]</th>
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
                        $tot_weight = 0;
                        foreach ($arrReceiptItems as $value) {   
                            if($value->type == 1) {
                                $weight_in_unit = WEIGHT_PER_UNIT_GRIP;
                            } else {
                                $weight_in_unit = WEIGHT_PER_UNIT_CABLE;
                            }
                            $weight = $weight_in_unit*$value->units;
                            $tot_weight = $tot_weight + $weight;
                        ?>
                            <tr class="row<?php echo $i;?>">
								<td class="center" style="width:40px;"><?php echo $i;?></td>
                                <td class="center"><?php echo ($value->materialtype);?></td>
                                <td class="center"><?php echo ($value->materialunit);?></td>
								<td class="center"><?php echo $value->units;?></td>								                            
                                <td class="center"><?php echo $weight_in_unit;?></td>
                                <td class="center"><?php echo $weight;?></td>
							</tr>
                        <?php 
                        $i++;
                    	}                        
                        ?>  
                        <tr>
                            <td colspan="5" class="text-right"><b>कुल भार :</b></td>
                            <td class="center"><?php echo $tot_weight;?></td>
                        </tr>
                        </tbody>
                        <?php } ?>                           
                        </table>
                        <p>&nbsp;</p><p>&nbsp;</p>
                        <p>माथि उल्लेखित समानहरु बुझीलिएको प्रमाणित गरिन्छ ।</p>
                        <p>&nbsp;</p>          
                    </div>                    
                    <div class="col-lg-6">
                        <p class="center">______________________________________</p>
                        <p class="center">फस्टोर इन्चार्ज (नाम र हस्ताक्ष्यर)</p>
                    </div>
                    <div class="col-lg-6">
                        <p class="center">______________________________________</p>
                        <p class="center">ड्राइभरको (नाम र हस्ताक्ष्यर)</p>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-6">
                        <p class="center">______________________________________</p>
                        <p class="center">बुझिलिनेको (नाम र हस्ताक्ष्यर)</p>
                    </div>
                    <div class="col-lg-6">
                        <p class="center">_______________________________________</p>
                        <p class="center">गाडी नम्बर</p>
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

