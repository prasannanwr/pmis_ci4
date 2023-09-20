function setVal( $sel, $val ){
	
    $($sel).val($val);
    $($sel).text($val);
    //console.log( $val );    
}
function getVal($sel){
    $val = $( $sel ).val();
    if( $val == ''){
        $val = $( $sel ).html().trim();
    }
    return $val;
}
function sumCalc(){
    $src = $(this).data('sum');
    //console.log($src);
    $sum = 0;
    $($src).each(function(){
        $val = getVal( this );
        //console.log('sss');
        //console.log( $val );
        if( !isNaN( $val )){
            $sum += parseFloat( $val );
        }
    });
   // console.log($sum);
    setVal( this, $sum.toFixed(2));
}
function SameVal(){
    $src = $(this).data('out');
    //console.log($src);
    $sum = 0;
    $($src).each(function(){
        $val = getVal( this );
        //console.log('sss');
        //console.log( $val );
        if( !isNaN( $val )){
            $sum = parseFloat( $val );
        }
    });
    setVal( this, $sum.toFixed(2));
}
function sumCalc_dig(){
    $src = $(this).data('sum');
    //console.log($src);
    $sum = 0;
    $($src).each(function(){
        $val = getVal( this );
        //console.log('sss');
        //console.log( $val );
        if( !isNaN( $val )){
            $sum += parseFloat( $val );
        }
    });
    setVal( this, $sum.toFixed());
}
function subStraCalc_dig(){
   
    $src = parseFloat( getVal( $(this).data('subt_first') ) );
    $dem = parseFloat( getVal( $(this).data('subt_second') ) );

    $v = ($src - $dem).toFixed(0);
   
}


function cntAvg(){
    $src = $(this).data('cnt');
    setVal( this, $($src).length);
}
function calcAvg(){
    $src = $(this).data('agv');
    $sum = 0;
    $cnt = 0;
    $($src).each(function(){
        $val = getVal( this );
        $sum += parseFloat( $val );
        $cnt ++;
    });
    setVal( this, ($sum / $cnt).toFixed(2));    
}
function calcDiv(){
    $src = parseFloat( getVal( $(this).data('numerator') ) );
    $dem = parseFloat( getVal( $(this).data('denominator') ) );
    if( $dem <= 0 ){
        setVal( this, 0 );
    }else{
        $v = ($src / $dem).toFixed(2);
        setVal( this, $v);
    }
}
function calcPerc(){
    $src = parseFloat( getVal( $(this).data('numerator') ) );
    $dem = parseFloat( getVal( $(this).data('denominator') ) );
    if( $dem <= 0 ){
        setVal( this, 0 );
    }else{
        $v = (($src / $dem) * 100).toFixed(2);
        setVal( this, $v);
    }
}
function reCalc(){
    //for(i=1;i<=2;i++){
    $('.sumCalc_dig').each(sumCalc_dig);
    $('.subStraCalc_dig').each(subStraCalc_dig);
    $('.sumCalc').each(sumCalc);
    $('.cntCalc').each(cntAvg);
    $('.avgCalc').each(calcAvg);
    $('.divCalc').each(calcDiv);
    $('.calcPerc').each(calcPerc);
    $('.SameVal').each(SameVal);	
	$('.sc24').each(sumCalc1)
	
    //}
}

function sumCalc1(){
    var srcid = $(this).attr('id');    
    var $sum = 0;
    $sum = $(".st"+srcid).html().trim()/$(".ss"+srcid).html().trim();    
    setVal( this, $sum.toFixed(2));
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatNumberCommas(x) {
	return parseFloat(x.replace(/,/g, ''));
}

$(document).ready(function(){
    reCalc();
	
	$val = 0;
	$val13 = 0;
	$val14 = 0;
	$val15 = 0;
	$val16 = 0;
	$val17 = 0;
	$val18 = 0;
	$val19 = 0;
	$val20 = 0;
	$val21 = 0;
	$val22 = 0;
	$val23 = 0;
	$val24 = 0;
	
	if($("#actype").val() == "ac") {
	$(".summeryspan").each(function() {		
		var vale = $( this ).html().trim();
		$val += parseFloat(vale);
	});
	$(".gsummeryspan").html($val.toFixed(2));
	
	$val = 0;
	$gsummeryspan = $(".gsummeryspan").html().trim();
	$totalbridges = $("#totbridges").val();
	
	$val = $gsummeryspan/$totalbridges;
	$(".g_grsspan").html($val.toFixed(2));
	
	/*for(var i=13;i<25;i++) {
		$(".ts"+i).each(function() {		
			var vale13 = $( this ).html().trim();		
			$val += parseFloat(vale13);
		});
		$(".gcol"+i).html($val.toFixed(2));
	}
	*/
	
	$(".ts13").each(function() {		
		var vale13 = $( this ).html().trim();
		$val13 += parseFloat(vale13);
	});
	$(".gcol13").html($val13.toFixed(2));
	
	$(".ts14").each(function() {		
		var vale14 = $( this ).html().trim();
		$val14 += parseFloat(vale14);
	});
	$(".gcol14").html($val14.toFixed(2));
	
	$(".ts15").each(function() {		
		var vale15 = $( this ).html().trim();
		$val15 += parseFloat(vale15);
	});
	$(".gcol15").html($val15.toFixed(2));
		
	
	$(".ts16").each(function() {		
		var vale16 = $( this ).html().trim();
		$val16 += parseFloat(vale16);
	});
	$(".gcol16").html($val16.toFixed(2));
	
	$(".ts17").each(function() {		
		var vale17 = $( this ).html().trim();
		$val17 += parseFloat(vale17);
	});
	$(".gcol17").html($val17.toFixed(2));
	
	$(".ts18").each(function() {		
		var vale18 = $( this ).html().trim();
		$val18 += parseFloat(vale18);
	});
	$(".gcol18").html($val18.toFixed(2));
	
	$(".ts19").each(function() {		
		var vale19 = $( this ).html().trim();
		$val19 += parseFloat(vale19);
	});
	$(".gcol19").html($val19.toFixed(2));
	$(".ts20").each(function() {		
		var vale20 = $( this ).html().trim();
		$val20 += parseFloat(vale20);
	});
	$(".gcol20").html($val20.toFixed(2));
	$(".ts21").each(function() {		
		var vale21 = $( this ).html().trim();
		$val21 += parseFloat(vale21);
	});
	$(".gcol21").html($val21.toFixed(2));
	$(".ts22").each(function() {		
		var vale22 = $( this ).html().trim();
		$val22 += parseFloat(vale22);
	});
	$(".gcol22").html($val22.toFixed(2));
	
	$(".ts23").each(function() {		
		var vale23 = $( this ).html().trim();
		$val23 += parseFloat(vale23);
	});
	$(".gcol23").html($val23.toFixed(2));
	
	$(".ts24").each(function() {		
		var vale = $( this ).html().trim();
		$val24 += parseFloat(vale);
	});
	$(".gcol24").html($val24.toFixed(2));
	
	
	$(".summerytotal").each(function() {		
		var vale = $( this ).html().trim();
		$val += parseFloat(vale);
	});
	$(".gsummerytotal").html("<b>"+$val.toFixed(2)+"</b>");	
	$gsc = $val/$gsummeryspan;
	$(".gsc").html("<b>"+$gsc.toFixed(2)+"</b>");
	
	/*for(var i=13;i<25;i++) {
		$val = 0;
		$gtotal = $(".gcol"+i).html().trim();
		$val = $gtotal/$gsummeryspan;
		
		$(".ggrstotal"+i).html($val.toFixed(2));
	}*/
	
	$val = 0;
	$gtotal = $(".gcol13").html().trim();	;
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	
	$(".ggrstotal13").html($val.toFixed(2));
	
	$val = 0;
	$gtotal = $(".gcol14").html().trim();	
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal14").html($val.toFixed(2));
	
	$val = 0;
	$gtotal = $(".gcol15").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal15").html($val.toFixed(2));
	
	$val = 0;
	$gtotal = $(".gcol16").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal16").html($val.toFixed(2));
	
	$val = 0;
	$gtotal = $(".gcol17").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal17").html($val.toFixed(2));
	
	$val = 0;
	$gtotal = $(".gcol18").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal18").html($val.toFixed(2));
	
	$val = 0;
	$gtotal = $(".gcol19").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal19").html($val.toFixed(2));

	$val = 0;
	$gtotal = $(".gcol20").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal20").html($val.toFixed(2));

	$val = 0;
	$gtotal = $(".gcol21").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal21").html($val.toFixed(2));

	$val = 0;
	$gtotal = $(".gcol22").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal22").html($val.toFixed(2));
	
	$val = 0;
	$gtotal = $(".gcol23").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal23").html($val.toFixed(2));
	
	$val = 0;
	$gtotal = $(".gcol24").html().trim();
	if($gsummeryspan == 0)
	$val = 0;
	else
	$val = $gtotal/$gsummeryspan;	
	$(".ggrstotal24").html($val.toFixed(2));
	
	
	/*$(".sc24").each(function() {		
		var vale = $( this ).html().trim();
		$val += parseFloat(vale);
	});
	$(".gsc").html($val.toFixed(2));*/
	$gst = $(".gsummerytotal").html().trim();
	
	//var gsc = $(".gsummarytotal").html().trim()/$(".gsummaryspan").html().trim();
	//$(".gsc").html(gsc.toFixed(2));
	
	}
	
	
	/* cost contribution */
	if($("#actype").val() == "acc") {
		$val = 0;
		$(".summerytotal").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		var gsummarytotal = $val.toFixed(2);
		$(".gsummerytotal").html("<b>"+$val.toFixed(2)+"</b>");
		
		$val = 0;		
		var ggpercent =0;
		$(".Total_14").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});			
		$(".gcol14").html("<b>"+$val.toFixed(2)+"</b>");			
		
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal14").html("<b>"+$gpercent.toFixed(2)+"</b>");		
		
		$val = 0;
		$(".Total_15").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol15").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal15").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_16").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol16").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal16").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_17").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol17").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal17").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_18").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol18").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal18").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_19").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol19").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal19").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_20").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol20").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal20").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_21").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol21").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal21").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_22").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol22").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal22").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_23").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol23").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal23").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_26").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol26").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal26").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_28").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol28").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal28").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$val = 0;
		$(".Total_25").each(function() {		
			var vale = $( this ).html().trim();
			$val += parseFloat(vale);
		});
		$(".gcol25").html("<b>"+$val.toFixed(2)+"</b>");
		$gpercent = ($val.toFixed(2)/gsummarytotal)*100;
		ggpercent += $gpercent;
		$(".gptotal25").html("<b>"+$gpercent.toFixed(2)+"</b>");
		
		$(".gtotalpercent").html("<b>"+ggpercent.toFixed(2)+"</b>");
		
		/*$val = 0;
		$("tbody").each(function() {		
			$(".grstotal").each(function() {
				var vale = $( this ).html().trim();
				$val += parseFloat(vale);
			});
			$(".summerytotal").html($val.toFixed(2));
		});*/
		
		
		
		
	}
	
	
	
	
    //reCalc();
   
});

