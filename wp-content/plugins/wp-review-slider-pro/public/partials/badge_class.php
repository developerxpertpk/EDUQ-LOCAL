<?php
class badgetools
{
	private $badgeid;	 
	
	function __construct($bid) {
		$this->badgeid = $bid;
	 }
		 
	public function gettotalsaverages($template_misc_array='',$currentform='') {
		$bid = $this->badgeid;

		//if template_misc_array and currentform are not set then we could pull from db based on bid
		if($template_misc_array=='' && $currentform=='' && $bid>0){
			global $wpdb;
			$table_name = $wpdb->prefix . 'wpfb_badges';
			$currentform = $wpdb->get_results("SELECT * FROM $table_name WHERE id = ".$bid);
			$template_misc_array = json_decode($currentform[0]->badge_misc, true);
		}
		
		//find the total reviews and the average rating based on what kind of badge this is
		$wppro_total_avg_reviews_array = get_option('wppro_total_avg_reviews');
		if(isset($wppro_total_avg_reviews_array)){
			$wppro_total_avg_reviews_array = json_decode($wppro_total_avg_reviews_array, true);
		} else {
			$wppro_total_avg_reviews_array = array();
		}
		//print_r($wppro_total_avg_reviews_array);
		
		$badgeorgin = $currentform[0]->badge_orgin;
		$finaltotal=0;
		$finalavg=0;
		$temprating[1][0]=0;
		$temprating[2][0]=0;
		$temprating[3][0]=0;
		$temprating[4][0]=0;
		$temprating[5][0]=0;
				

		if(isset($template_misc_array['ratingsfrom'])){
			$ratingsfrom = $template_misc_array['ratingsfrom'];
		} else {
			$ratingsfrom = 'table';
		}

		//print_r($wppro_total_avg_reviews_array );

		if($ratingsfrom=='input'){
			$finaltotal =esc_html($template_misc_array['ratingstot'])." ";
			$finalavg = esc_html($template_misc_array['ratingsavg']);

		} else {
			//if this is all or manual treat differently, need to find totals, only doing this is ratingsfrom not set or set to table not input
			if($badgeorgin=='manual'){
				$x=0;
				foreach ($wppro_total_avg_reviews_array as $key => $valuearray) {
					//echo $key."<br>";
					//search pageid array to see if these values should be included
					if ($key=="manually_added"){
						//found it, add to total and avg arrays
						$totalreviewsarray[$x]=$valuearray['total'];
						$avgreviewsarray[$x]=$valuearray['avg'];
						$temprating[1][$x]=$valuearray['numr1'];
						$temprating[2][$x]=$valuearray['numr2'];
						$temprating[3][$x]=$valuearray['numr3'];
						$temprating[4][$x]=$valuearray['numr4'];
						$temprating[5][$x]=$valuearray['numr5'];
						$x++;
					}		
				}
				if(count($totalreviewsarray)>0){
				$finaltotal = array_sum($totalreviewsarray)." ";
				}
				if(count($avgreviewsarray)>0){
				$finalavg = round(array_sum($avgreviewsarray)/count($avgreviewsarray),1);
				}
			} else {
				//if this is not all or manual find pageids
				//find the pageid array
				if(isset($currentform[0]->rpage)){
					$rpagearray = json_decode($currentform[0]->rpage);
				} else {
					$rpagearray=[''];
				}
				if(!$rpagearray){$rpagearray=[''];}
				$rpagearray = array_filter($rpagearray);
				
				//if type is submitted and rpage isn't set or is blank then try to use pageid of the currentpage
				if($badgeorgin=='submitted' && count($rpagearray)==0){
					//find current pageid
					$id = get_the_ID();
					$rpagearray[]=$id;
				}
				
				//loop pageidarray and get new total and avg if needed
				
				//print_r($rpagearray);

				//stripslashes from pageids
				$rpagearray2=[''];
				foreach ($rpagearray as $key=>$value) {
					$rpagearray[$key] = stripslashes(htmlentities($value));
					//also check non htmlentities
					$rpagearray2[$key] = stripslashes(($value));
				}
				//print_r($rpagearray);

				$x=0;
				foreach ($wppro_total_avg_reviews_array as $key => $valuearray) {
					//search pageid array to see if these values should be included
					if (in_array($key, $rpagearray) || in_array($key, $rpagearray2)){
						
						//force to use db values if set
						if($ratingsfrom=='db' || $currentform[0]->style=='2'){
							//found it, add to total and avg arrays
							if(isset($valuearray['total_indb'])){
								$totalreviewsarray[$x]=$valuearray['total_indb'];
							} else {
								$totalreviewsarray[$x]='';
							}
							if(isset($valuearray['avg_indb'])){
								$avgreviewsarray[$x]=$valuearray['avg_indb'];
							} else {
								$avgreviewsarray[$x]='';
							}
							
						} else {
						
							//found it, add to total and avg arrays
							$usedbavg =false;
							if(isset($valuearray['total']) && $valuearray['total']>$valuearray['total_indb']){
								$totalreviewsarray[$x]=$valuearray['total'];
								$usedbavg = true;
							} else if(isset($valuearray['total_indb'])){
								$totalreviewsarray[$x]=$valuearray['total_indb'];
							} else {
								$totalreviewsarray[$x]='';
							}
							if(isset($valuearray['avg']) && $valuearray['avg']>0 && $usedbavg=false){
								$avgreviewsarray[$x]=$valuearray['avg'];
							} else {
								if(isset($valuearray['avg_indb'])){
								$avgreviewsarray[$x]=$valuearray['avg_indb'];
								}
							}
						}
						
						if(isset($valuearray['numr1'])){
							$temprating[1][$x]=$valuearray['numr1'];
							$temprating[2][$x]=$valuearray['numr2'];
							$temprating[3][$x]=$valuearray['numr3'];
							$temprating[4][$x]=$valuearray['numr4'];
							$temprating[5][$x]=$valuearray['numr5'];
						} else {
							$temprating[1][$x]=0;
							$temprating[2][$x]=0;
							$temprating[3][$x]=0;
							$temprating[4][$x]=0;
							$temprating[5][$x]=0;
							
						}
				
						//we need to normalize in case we have a lot of reviews from one source then only a couple from another.
						$avgtimestotal[$x]=$avgreviewsarray[$x]*$totalreviewsarray[$x];
						$x++;
					}		
					//print_r($valuearray);
				}

				//print_r($totalreviewsarray);
				//print_r($avgreviewsarray);
				if(!isset($totalreviewsarray)){
					$totalreviewsarray=[''];
				}
				if(!isset($avgreviewsarray)){
					$avgreviewsarray=[''];
				}
				$avgreviewsarray = array_filter($avgreviewsarray);
				if(count($totalreviewsarray)>0){
					$finaltotal = array_sum($totalreviewsarray);
					//$finalavg = round(array_sum($avgreviewsarray)/count($avgreviewsarray),1);
					$finalavg = round(array_sum($avgtimestotal)/array_sum($totalreviewsarray),1);
				}
			}
		}
		
		$resultarray['finaltotal']=$finaltotal;
		$resultarray['finalavg']=$finalavg;
		$resultarray['temprating']=$temprating;

		return $resultarray;
	}
	
}

?>