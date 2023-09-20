 <div class="reportHeader">
        <h1 class=""></h1>
    </div>
<!--- start first panel---->

<!--- end first panel---->
<!--- start second panel---->
<div class="panel panel-primary settings-panel">
    <div class="panel-heading">
        <h1 class="panel-title">Progress Status List</h1>
    </div>
    <div class="panel-body">
    <!---start div---->
    <div class="ListSubBridge">
       
            
            <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Pro_Overall_Status', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Overall Status Report
                    ');?>
                </div>
            </div>
              <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Pro_CarryOver_Status', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    CarryOver Status Report 
                    ');?>
                </div>
            </div>
              <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Pro_New_Status', '
                    <i class="fa fa-comments fa-3x"></i><br />
                     New Status Report 
                    ');?>
                </div>
            </div>
              <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Pro_Physical_Progress', '
                    <i class="fa fa-comments fa-3x"></i><br />
                     Physical Progress Report 
                    ');?>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/Pro_Cumulative_Overall', '
                    <i class="fa fa-comments fa-3x"></i><br />
                     Cumulative Overall Status <br /> Report 
                    ');?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        
       
        
        <!--- end ---->        
    </div>
</div>
<!--- end second panel---->
<!--- start second panel---->
<div class="panel panel-primary settings-panel">
    <div class="panel-heading">
        <h1 class="panel-title"> R7 Report List</h1>
    </div>
    <div class="panel-body">
    <!---start div---->
    <div class="ListSubBridge">
       
            
            <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/R_Under_Construction', '
                    <i class="fa fa-comments fa-3x"></i><br />
                    Under Construction Report
                    ');?>
                </div>
            </div>
              <div class="col-sm-2">
                <div class="panel panel-red">
                    <?php echo anchor('reports/R_Completed', '
                    <i class="fa fa-comments fa-3x"></i><br />
                     Completed Report 
                    ');?>
                </div>
            </div>
               <div class="clear"></div>
        </div>
        
       
        
        <!--- end ---->        
    </div>
</div>
