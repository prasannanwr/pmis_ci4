 <div class="reportHeader">
        <h1 class="">Reports</h1>
    </div>
<!--- start first panel---->

<!--- end first panel---->
<!--- start second panel---->
<div class="panel panel-primary settings-panel">
    <div class="panel-heading">
        <h1 class="panel-title">All BridgeList</h1>
    </div>
    <div class="panel-body">
    <!---start div---->
    <div class="ListSubBridge">
        <h4>Sample Reports List</h4>
            
            <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/districtwise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    District Wise <br /> Report
                    ');?>
                </div>
            </div>
              <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/devregionwise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Dev. Region <br />Wise Report 
                    ');?>
                </div>
            </div>
              <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/tbss_regionwise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    TBSS region <br />Wise Report 
                    ');?>
                </div>
            </div>
            
            
               
                                 
            <div class="clear"></div>
        </div>
        
       
        
        <!--- end ---->        
    </div>
</div>
<!--- end second panel---->

<!--- start third panel---->
<div class="panel panel-primary settings-panel">
    <div class="panel-heading">
        <h1 class="panel-title">BasicRecord</h1>
    </div>
    <div class="panel-body">
    <!---start div---->
    <div class="ListSubBridge">
  
 
                <div class="panel panel-red settings-panel col-sm-2 nopad margR">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bridge Wise</h3>
                    </div>
                    <div class="panel-body">
                         <div class="textcenter">
                            <div class="panel panel-green">
                            <?php echo anchor('reports/Bridgewise', '
                            <i class="fa fa-comments fa-3x"></i><br />
                            Bridge Wise <br /> Report
                            ');?>
                            </div>
                        </div>
                                    
                    
                  </div> 
                  </div>  
   
       

                <div class="panel panel-red settings-panel col-sm-4 nopad">
                    <div class="panel-heading">
                        <h3 class="panel-title">Over All</h3>
                    </div>
                    <div class="panel-body">
                    
            <div class="col-sm-6 textcenter">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Overall_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                   Overall DateWise <br /> Report
                    ');?>
                </div>
            </div>
              <div class="col-sm-6 textcenter">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Overall_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Overall FY <br />Wise Report 
                    ');?>
                </div>
            </div>
                     
                    
         </div>
         </div>   
         
               <div class="panel panel-red settings-panel col-sm-12 nopad">
                    <div class="panel-heading">
                        <h3 class="panel-title">Estimated Bridge Cost</h3>
                    </div>
                    <div class="panel-body">
         <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Overall_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Over All<br />Date Wise Report
                    ');?>
                </div>
            </div>
              <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Overall_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Over All <br />FY Wise Report 
                    ');?>
                </div>
            </div>
              <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Dist_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    District <br /> Date Wise Report 
                    ');?>
                </div>
            </div>
            
              <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Dist_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    District <br />FY Wise Report 
                    ');?>
                </div>
            </div>
            
              <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Dev_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Dev.Region<br />Date Wise Report 
                    ');?>
                </div>
            </div>
            
               <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Dev_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Dev.Region<br />FY Wise Report 
                    ');?>
                </div>
            </div>
                <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_TBSS_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                   TBSS region <br />data Wise Report 
                    ');?>
                </div>
            </div>
            
            <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_ TBSS_ FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    TBSS region <br />FY Wise Report 
                    ');?>
                </div>
            </div>

                    
               </div>     
               </div>     
            <div class="panel panel-red settings-panel col-sm-12 nopad">
            <div class="panel-heading">
            <h3 class="panel-title"> Estimated Contribution Commitment</h3>
            </div>
            <div class="panel-body">

             <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Cont_Overall_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Over All <br /> Date Wise Report 
                    ');?>
                </div>
            </div>
            
            <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Cont_Overall_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Overall Fiscal year<br />Wise Report 
                    ');?>
                </div>
            </div>
            
            <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Cont_Dist_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    District Date <br />Wise Report 
                    ');?>
                </div>
            </div>
            
            <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Cont_Dist_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    District Fiscal year <br />Wise Report 
                    ');?>
                </div>
            </div>
            
             <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Cont_Dev_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Dev. Region Date<br />Wise Report 
                    ');?>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Cont_Dev_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Dev. Region Fiscal <br /> Year Wise Report 
                    ');?>
                </div>
            </div>
             <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Cont_TBSS_DateWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    TBSS Date <br />Wise Report 
                    ');?>
                </div>
            </div>
            
              <div class="col-sm-2">
                <div class="panel panel-green">
                    <?php echo anchor('reports/Est_Cont_TBSS_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    TBSS Fiscal Year <br />Wise Report 
                    ');?>
                </div>
            </div>
            
            
       
 
              </div>
              </div>               
            
                                 
            <div class="clear"></div>
        </div>
        
       
        
        <!--- end ---->        
    </div>
</div>

<!--- end third panel---->
<!----- start work progress------>
<div class="panel panel-primary settings-panel">
    <div class="panel-heading">
        <h1 class="panel-title">Work Progress</h1>
    </div>
    <div class="panel-body">
      <div class="ListSubBridge">
      
        <div class="panel panel-red settings-panel col-sm-7 nopad">
                            <div class="panel-heading">
                                <h3 class="panel-title">Fiscal Year</h3>
                            </div>
                            <div class="panel-body">
                            
                    <div class="col-sm-4 textcenter">
                        <div class="panel panel-green">
                            <?php echo anchor('reports/Work_Carryover_Bridges', '
                            <i class="fa fa-comments fa-3x"></i><br />
                           New and Carryover<br />Bridges Report
                            ');?>
                        </div>
                    </div>
                      <div class="col-sm-4 textcenter">
                        <div class="panel panel-green">
                            <?php echo anchor('reports/Work_Cancelled_Bridges', '
                            <i class="fa fa-comments fa-3x"></i><br />
                            Cancelled Bridges <br />Report 
                            ');?>
                        </div>
                    </div>
                    <div class="col-sm-4 textcenter">
                        <div class="panel panel-green">
                            <?php echo anchor('reports/Work_Completed_Bridges', '
                            <i class="fa fa-comments fa-3x"></i><br />
                             Completed Bridges<br />Report 
                            ');?>
                        </div>
                    </div>                             
                            
                 </div>
                 </div>      
  
                 <div class="panel panel-red settings-panel col-sm-2 nopad margL">
                    <div class="panel-heading">
                        <h3 class="panel-title">Date Wise</h3>
                    </div>
                    <div class="panel-body">
                         <div class="textcenter">
                            <div class="panel panel-green">
                            <?php echo anchor('reports/Work_Datewise_Completed', '
                            <i class="fa fa-comments fa-3x"></i><br />
                            Datewise Completed<br /> Report
                            ');?>
                            </div>
                        </div>
                                    
                    
                  </div> 
                  </div>  
   
    </div>
    
</div>
</div>    
<!----- endwork progress------>


<!--- start  Engineering Works panel---->
<div class="panel panel-primary settings-panel">
    <div class="panel-heading">
        <h1 class="panel-title"> Engineering Works</h1>
    </div>
    <div class="panel-body">
 
      
        <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Eng_SiteAssesment_Survey', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Site Assesment and <br />Survey DateWise <br />Report
                    ');?>
                </div>
            </div>  
        <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Eng_Desing_Cost_Estimate', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Desing and Cost <br /> Estimate DateWise<br />Wise Report 
                    ');?>
                </div>
            </div>                       
        <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Eng_Design_Approval', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Desing and CostDesign <br /> Approval DateWise <br />Wise Report 
                    ');?>
                </div>
            </div>                       
        <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Eng_FYWise', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Fiscal Years <br />Wise<br />Report 
                    ');?>
                </div>
            </div>                       
  
                   
   
  
    
</div>
</div>


<!--- end  Engineering Works panel---->

