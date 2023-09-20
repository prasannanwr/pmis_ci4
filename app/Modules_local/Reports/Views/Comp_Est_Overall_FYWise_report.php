<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mainBoard">
                        
                            <div class="col-lg-12">
                                <span class="reportHeader center">General bridge list</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:55px;" rowspan="2" class="center">SN</th>
                                                <th colspan="4" class="center">Government of Nepal</th>
                                                <th style="width:150px;" rowspan="2" class="center">River Name</th>
                                                <th colspan="2" class="center">Walk Way Deck</th>
                                                <th rowspan="2">Topo Map sheet Number</th>
                                                <th colspan="2" class="center">Coordinate</th>
                                                <th colspan="2" class="center">VCD/Municipality</th>
                                                <th rowspan="2">Completion Date</th>
                                            </tr>
                                            <tr>
                                                <th style="width:120px;" class="center">Number</th>
                                                <th style="width:120px;" class="center">Name</th>
                                                <th style="width: 60px;" class="center">Type*</th>
                                                <th style="width:75px;" class="center">Span(m)</th> 
                                                <th style="width:120px;" class="center">Type</th>
                                                <th style="width:100px;" class="center">Width(cm)</th>
                                                <th style="width: 120px;" class="center">North</th>
                                                <th style="width: 120px;" class="center">East</th>
                                                <th style="width: 120px;" class="center">Left Bank</th>
                                                <th style="width: 120px;" class="center">Right Bank</th>    
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            
                                <div class="col-lg-12"><b><span>District:Achham</span></b></div>
                                <div class="col-lg-6"><b><span>TBSU Region:</span></b></div><div class="col-lg-6"><b><span style="float:right;">Development Region</span></b></div>
                                <div class="table-responsive col-lg-12">
                                    <table class="table table-bordered table-hover">    
                                        <tbody>
                                            <tr>
                                                <td style="width:55px;">1</td>
                                                <td style="width:120px;">61.69.01.01</td>
                                                <td style="width:120px;">Hadesera</td>
                                                <td style="width:60px;">SD</td>
                                                <td style="width:75px;">86</td>
                                                <td style="width:150px;">Lungreli Gaad</td>
                                                <td style="width:120px;">Steel Deck</td>
                                                <td style="width:100px;">70</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="width: 120px;">Lungra</td>
                                                <td style="width: 120px;">Lungra</td>
                                                <td>24-september-2010</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
         <!---footer-->                                    
<div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span><span> SN=Steel Truss RCC=Rainforced Cement Concrete</span></div>
    <div class="col-lg-4 right"><span >Reporting Period(Fiscal Year): 20102011 To 20142015</span></div>                                 
        <div class="col-lg-3">2-September-2014</div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><span>Page 1 of 3<span></div>
        <!---footer-->                                     
                                
                            
                        
                        <div class="clear"></div>
                    </div>
                            
                </div>
                <!-- /.row -->       
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <?=$this->endSection();?>