<?php 
	$mdoorthickness  = $_POST['doorthickness'];
	$mplytype 	 = $_POST['plytype'];
	$mpaint 	 = $_POST['paint'];
	$mteakoption 	 = $_POST['teakoption'];
	$mplythickness   = $_POST['plythickness'];
	$mbaton 	 = $_POST['baton'];
	$mbatonoption    = $_POST['batonoption'];
	$mmica 		 = $_POST['mica'];
	$mmicaoption 	 = $_POST['micaoption'];
	$mwidth 	 = $_POST['width'];
	$mheight 	 = $_POST['height'];
	$mdoorsize 	 = $_POST['doorsize'];

	$mplyrate     = 0;
	$mplyrate1    = 0;
	$mbatonrate   = 0;
	$mbatonlabour = 0;
	$mfillerCost  = 0;
	$motherCost   = 0;
	$wages 		= 0;
	$mglueCost	= 0;
	$dealerCost   = 0;
	$micaRate 	 = 0;
	$pastingRate  = 0;



$mplytypenew =  strtoupper($mplythickness).strtoupper($mplytype);

$xml=simplexml_load_file("itemrate.xml");

foreach ($xml->itemrates as $lmas){
	$mitemtype = $lmas->itemtype;
	
	if($mitemtype == $mplytypenew){
		$mplyrate = $lmas->rate;
		}

	if(strtolower($mplytype)=='teak'){
		if($mteakoption == 1)
			$mplytype1  = strtoupper($mplythickness)+"PLAIN";
			if($mitemtype == $mplytype1){
				$mplyrate1 = $lmas->rate;
			}else{
					$mplyrate1 =0;						
				}
			$mplycost = $mplyrate + $mplyrate1;
	}else{
			
		$mplycost = $mplyrate *2;		
		
		}

	if(strtolower($mbaton)=='yes'){
		if($mitemtype=='BATON'){
			$mbatonrate = $lmas->rate;			
			}

		if($mbatonoption==1){
			$mbatonrate = 0;						
			}
			
		if($mitemtype=='BATONLABOUR'){
			$mbatonlabour = $lmas->rate;			
			}
	}
	
	
	
	if ($mitemtype =="FILLERCOST"){
		$mfillerCost = $lmas->rate;	
		}
	
	if ($mitemtype =="LABOUR"){
			$wages= $lmas->rate;	
		}

	if ($mitemtype =="FEVICOLCOST"){
			$mglueCost= $lmas->rate;	
		}
		
	if ($mitemtype =="OTHERS"){
			$motherCost= floatval($lmas->rate);	
		}
		
	if ($mitemtype =="DEALERS"){
			$dealerCost= floatval($lmas->rate);	
		}


	if(strtoupper($mmica)=="MPASTING"){
			if ($mitemtype =="MICA"){
					$micaRate= $lmas->rate;	
				}
			if ($mitemtype =="PASTING"){
					$pastingRate= $lmas->rate;	
				}
		}

	if(strtoupper($mmica)=="PASTING"){
			if ($mitemtype =="PASTING"){
				$pastingRate= $lmas->rate;	
				}
		}

		if($mmicaoption=="oneside"){
			$micaCost = $micaRate + $pastingRate;		
			}else{
			$micaCost = ($micaRate + $pastingRate)*2;
				}

}

	$mdoorsizenew = getDoorSize($mdoorsize,$mheight,$mwidth) ;

		$mfillerthickness  = $mdoorsizenew *  (($mdoorthickness - $mplythickness*2)+6) ;
		$plyCost 		   = $mdoorsizenew * $mplycost; 
		$mbatonCost 		= $mdoorsizenew * ($mbatonrate + $mbatonlabour);

		$fillerCost = $mfillerthickness  * floatval($mfillerCost);
		$labourCost = $mdoorthickness 	* ($wages * $mdoorsizenew);
		$mMicaCost  = $mdoorsizenew 	  * $micaCost;
		$glueClost  = $mdoorsizenew 	  * $mglueCost;
	
	 	$mateCost  = $plyCost  + $mbatonCost + $fillerCost + $labourCost + $mMicaCost + $glueClost;
		$otherexp  = $mateCost * $motherCost;
		$dealerexp = $mateCost * $dealerCost;
   
	echo $totalCost = round($mateCost + $otherexp + $dealerexp,2) .' ('.round(($mateCost + $otherexp + $dealerexp)/$mdoorsizenew,2)." /Sqft.)";

function getDoorSize($mwhat,$heights,$widths){
	if(strtoupper($mwhat)=='INCH'){
		$doorsizen = ($heights * $widths ) /144;		
		} else {
		$doorsizen = (($heights/25.4) * ($widths/25.4 )) /144;						
		}
	return $doorsizen;
}

?>