<?php 
	//$message is the input from any other phps

	$list = file_get_contents("list/profan.txt");         
	$list2 = file_get_contents("list/three.txt");	 
    	$exem2 = explode("\n",$list2);		  
	
	$me=explode(" ",$message);				  
    	$length = count($me);				
	$censored='';					 
	$check=0;
	for ($i = 0; $i < $length; $i++)					 	     
	{
	$me2[$i] = preg_replace('/[^A-Za-z0-9\-]/', '', $me[$i]);	 	            
	    if(strlen($me2[$i]) >= 4){	                                                     			
	    	$me3[$i] = "/$me2[$i]/";                                                       
	    		if(preg_match($me3[$i], $list)==1){                              	    
            			if(!in_array($me2[$i], $exem)){				 	     						
	    					$me[$i]="<strike><d style = opacity:20%>".$me[$i]."</d></strike>";
	    				    //$me[$i] = str_repeat("*", strlen($me[$i])); 
	    				    $check .= $check++;     
	    				}
	    			}
	    } else if(in_array($me2[$i], $exem2)){                                           
	    		  $me[$i]="<strike><d style = opacity:20%>".$me[$i]."</d></strike>";             
	    		  $censored .= "$me[$i]"." ";
	    		  $check .= $check++;                                                      
	    } 
	$censored .= "$me[$i]"." ";  
	}
	//failure cases
    	$exem = array("whole", "will", "other","mother","long","fell","best","face","star","ones","horn","chin","lock","full","test","phone","head"); 
?>
