<div id="page-wrapper" class="largeRpt">
        <div class="alignRight"> 
        
       <input type="submit" target="_blank" class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print()" />
       
   </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mainBoard">                        
                        <div class="col-lg-12 alignRight">म. ले. प. फा. न. ४६ </div>
                        <p class="center">नेपाल सरकार</p>
                        <p class="center">संघिय मामिला तथा सामान्य प्रशासन मन्त्रालय</p>
                        <p class="center"> स्थानीय पूर्वाधार विकास</p>
                        <p class="center">झोलुङ्गे पुल क्षेत्रगत कार्यक्रम </p>
                        <p class="center">सस्पेन्सन  वृज डिभिजन</p>
                        <h4 class="center">दाखिला प्रतिवेदन फाराम</h4>                        
                    
                                    
                    <div class=" table-responsive">
                        <p>दाखिला प्रतिवेदन नम्बर: <?php echo $receipt_num;?></p>
                        <table class="table table-bordered table-hover" style="" align="center">
                            <thead>                                
                                <tr>
                                    <th class="center c1" rowspan="2">क्र स</th>
                                    <th class="center c2"  rowspan="2"> जिन्सी खाता पाना नम्बर </th>
                                    <th class="center c3" rowspan="2"> जिन्सी वर्गिकरण संकेत नम्बर</th>
                                    <th class="center c4" rowspan="2" style="width:150px;">सामानको नाम</th>
                                    <th class="center c4" rowspan="2">स्पेसीफिकेसन </th>
                                    <th class="center c4" rowspan="2">इकाइ</th>
                                    <th class="center c4" rowspan="2">परीमान</th>
                                    <th class="center c4" colspan="5">मुल्य (इन्भोईस अनुसार)</th>                                    
                                    <th class="center c4" rowspan="2" style="width:150px">कैफियत</th>                                   
                                </tr>
                                <tr>                                    
                                    <th class="center c4">प्रती इकाइ</th>
                                    <th class="center c4">मु अ कर </th>
                                    <th class="center c4">इकाइ मुल्य</th>
                                    <th class="center c4">अन्य खर्च</th>
                                    <th class="center c4">जम्मा</th> 
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
                            $vat = ($value->rate * 13)/100;
                            $cost =$value->rate+$vat;
                        ?>
                            <tr class="row<?php echo $i;?>">
								<td class="center" style="width:40px;"><?php echo $i;?></td>
                                <td class="center">&nbsp;</td>
                                <td class="center">&nbsp;</td>
                                <td class="center"><?php echo $value->typename; //$arrReceiptInfo->diameter."mm ".$arrReceiptInfo->typename;?></td>
								<td class="center"><?php echo $value->diameter."mm";?></td>
                                <td class="center"><?php echo ($value->type=="Bulldog"?"Units":"Length");?></td>
								<td class="center"><?php echo $value->units;?></td>								                            
                                <td class="center"><?php echo $value->rate;?></td> 
                                <td class="center"><?php echo $vat;?></td> 
                                <td class="center"><?php echo $value->rate+$vat;?></td> 
                                <td class="center">&nbsp;</td> 
                                <td class="center"><?php echo ($cost*$value->units);?></td> 
                                <td class="center">&nbsp;</td> 
							</tr>
                        <?php 
                    	}
                        $i++;
                        
                        ?>  
                        </tbody>
                        <?php } ?>                           
                        </table>
                        <p>&nbsp;</p><p>&nbsp;</p>
                        <p>माथि उल्लेखित माल समान हरु खरिद आदेश नम्बर हसतानतरन फरम नम्बर ............... मिती <u><?php echo $arrReceiptInfo[0]->receipt_date;?></u> अनुसार श्री <u><?php echo $arrReceiptInfo[0]->s_name;?></u> बाट प्राप्त हुन आएको हुँदा जाची गन्ती गरी हेरी ठीक दुरुस्त भएकोले खातामा आम्दानी बाधेको प्रमाणित गर्छु ।</p>     
                        <p>&nbsp;</p>          
                    </div>                    
                    <div class="col-lg-4">
                        <p>फाटवाला को दस्तखत </p>
                        <p>नाम</p>
                        <p>पद</p>
                        <p>मिती</p>
                    </div>
                    <div class="col-lg-4">
                        <p>प्रमाणित गर्ने साखा प्रमुख को दस्थकत</p>
                        <p>नाम</p>
                        <p>पद</p>
                        <p>मिती</p>
                    </div>
                    <div class="col-lg-4">
                        <p>प्रमाणित गर्ने साखा प्रमुख को दस्थकत</p>
                        <p>नाम</p>
                        <p>पद</p>
                        <p>मिती</p>
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

