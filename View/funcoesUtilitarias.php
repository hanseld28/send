<?php 

	function calculaDiaSemana($data)
    { 
      	$dia =  substr($data,0,2);

      	$mes =  substr($data,3,2);

      	$ano =  substr($data,6,9);

      	$diaSemana = date("w", mktime(0, 0, 0, $mes, $dia, $ano));
      
      	switch ($diaSemana)
      	{         
        	case "0": 
          		$diaSemana = "Domingo";
          		break;         

        	case "1": 
          		$diaSemana = "Segunda-Feira"; 
          		break;         

        	case "2": 
          		$diaSemana = "Terça-Feira";   
          		break;         

        	case "3": 
          		$diaSemana = "Quarta-Feira"; 
         	 	break;         
	        
	        case "4": 
   		        $diaSemana = "Quinta-Feira";  
  		        break;

  	        case "5": 
   		        $diaSemana = "Sexta-Feira";   
                break;

        	case "6": 
            	$diaSemana = "Sábado";   
          		break;         
      	}
        
        return $diaSemana;

    }



?>