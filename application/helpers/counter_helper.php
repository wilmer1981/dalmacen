<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('count_visitor'))
{
    function count_visitor()
    {

    	// ip-protection in seconds
		$counter_expire = 600;
		// ignore agent list
		$counter_ignore_agents = array('bot', 'bot1', 'bot3');
		// ignore ip list
		$counter_ignore_ips = array('127.0.0.2', '127.0.0.3');

		// get basic information
		$counter_agent = $_SERVER['HTTP_USER_AGENT'];
		$counter_ip    = $_SERVER['REMOTE_ADDR']; 
		$counter_time  = time();

		$ignore = false; 
   
   // get counter information
   //$sql = "SELECT * FROM counter_values LIMIT 1";
   //$res = mysqli_query($sql);
		$ci =& get_instance();
/*
        $ci->db->select('*');
        $ci->db->from('counter_values'); 
        $ci->db->limit(1);		
        $res = $ci->db->get()->row();	
          // var_dump($res->num_rows);
*/
        $sql = "SELECT * FROM counter_values LIMIT 1";
        $res = $ci->db->query($sql);
       //$total = $res->num_rows();




  // echo "HOLA: ".$total;
   // fill when empty
   if ($res->num_rows() == 0)

   {
   	 /*$sql = "INSERT INTO `counter_values` (`id`, `day_id`, `day_value`, `yesterday_id`, `yesterday_value`, `week_id`, `week_value`, `month_id`, `month_value`, `year_id`, `year_value`, `all_value`, `record_date`, `record_value`) VALUES ('1', '" . date("z") . "',  '1', '" . (date("z")-1) . "',  '0', '" . date("W") . "', '1', '" . date("n") . "', '1', '" . date("Y") . "',  '1',  '1',  NOW(),  '1')";
	  mysqli_query($link, $sql);
	  */
	    $sql = "INSERT INTO `counter_values` (`id`, `day_id`, `day_value`, `yesterday_id`, `yesterday_value`, `week_id`, `week_value`, `month_id`, `month_value`, `year_id`, `year_value`, `all_value`, `record_date`, `record_value`) VALUES ('1', '" . date("z") . "',  '1', '" . (date("z")-1) . "',  '0', '" . date("W") . "', '1', '" . date("n") . "', '1', '" . date("Y") . "',  '1',  '1',  NOW(),  '1')";
        $ci->db->query($sql);


	   	/*$data = array(
				'id'    => '1',
				'day_id' => date("z"),
				'day_value'      => '1',
				'yesterday_id'     => (date("z")-1),
				'yesterday_value'    => '0',
				'week_id'     => date("W"),
				'week_value'   => '1',
				'month_id' => date("n"),
				'month_value'  => '1',
				'year_id'  => date("Y"),
				'year_value'  => '1',
				'all_value'  => '1',
				'record_date'  => date("Y-m-d H:i:s"),
				'record_value'   => '1'
		);
		
	 	$ci->db->insert('counter_values', $data);*/



	  // reload with settings
	//$sql = "SELECT * FROM counter_values LIMIT 1";
    //$res = mysqli_query($sql);
	    $sql = "SELECT * FROM counter_values LIMIT 1";
        $res = $ci->db->query($sql);
/*
        $ci->db->select('*');
        $ci->db->from('counter_values'); 
        $ci->db->limit(1);		
        $res = $ci->db->get();	
        */
	  
	  $ignore = true;
   }   
   /***hasta aqki ok**/


   // if(count($res) > 0){
   		//var_dump($res->result_array() );
           	foreach($res->result_array() as $row){
    		 	$day_id 		= $row['day_id'];
			   $day_value 		= $row['day_value'];
			   $yesterday_id 	= $row['yesterday_id'];
			   $yesterday_value = $row['yesterday_value'];
			   $week_id 		= $row['week_id'];
			   $week_value 		= $row['week_value'];
			   $month_id 		= $row['month_id'];
			   $month_value 	= $row['month_value'];
			   $year_id 		= $row['year_id'];
			   $year_value 		= $row['year_value'];
			   $all_value 		= $row['all_value'];
			   $record_date 	= $row['record_date'];
			   $record_value 	= $row['record_value'];
		}                       
  //  }


  
	   // check ignore lists
	   $length = sizeof($counter_ignore_agents);
	   for ($i = 0; $i < $length; $i++)
	   {
		  if (substr_count($counter_agent, strtolower($counter_ignore_agents[$i])))
		  {
		     $ignore = true;
			 break;
		  }
	   }
	   
	   $length = sizeof($counter_ignore_ips);
	   for ($i = 0; $i < $length; $i++)
	   {
		  if ($counter_ip == $counter_ignore_ips[$i])
		  {
		     $ignore = true;
			 break;
		  }
	   }
   
      
	   // delete free ips
	   if ($ignore == false)
	   {
	      	//$sql = "DELETE FROM counter_ips WHERE unix_timestamp(NOW())-unix_timestamp(visit) >= $counter_expire"; 
	      	//mysqli_query($link, $sql);
        	
        	//$ci->db->where('unix_timestamp(NOW())-unix_timestamp(visit) >=', $counter_expire);
        	//$ci->db->delete('counter_ips');

        	$sql = "DELETE FROM counter_ips WHERE unix_timestamp(NOW())-unix_timestamp(visit) >= $counter_expire";
        	$ci->db->query($sql);

	   }
      
	   // check for entry
	   if ($ignore == false)
	   {
	      //$sql = "UPDATE counter_ips SET visit = NOW() WHERE ip = '$counter_ip'";
		 // mysqli_query($link, $sql);

	   	  	$sql = "UPDATE counter_ips SET visit = NOW() WHERE ip = '$counter_ip'";
        	$ci->db->query($sql);

		  /* $data = array(
            'visit' => date("Y-m-d H:i:s")     
        	);
        	$ci->db->where('ip', $counter_ip);
        	$ci->db->update('counter_ips', $data);*/

			if ($ci->db->affected_rows() > 0) {
				 $ignore = true;						   		 
			}else{
				 // insert ip
			     //$sql = "INSERT INTO counter_ips (ip, visit) VALUES ('$counter_ip', NOW())";
		   	     //mysqli_query($link, $sql); 
				$sql = "INSERT INTO counter_ips (ip, visit) VALUES ('$counter_ip', NOW())";
        		$ci->db->query($sql);

				/*$data = array(
						'ip'    => $counter_ip,
						'visit' => date("Y-m-d H:i:s") 			
				);*/
					
				//$ci->db->insert('counter_ips', $data);
			}	  	  
	   }
   
	   // online?
	  // $sql = "SELECT * FROM counter_ips";
	   //$res = mysqli_query($link, $sql);
	  // $online = mysqli_num_rows($res);

        $sql    = "SELECT * FROM counter_ips";
        $res    = $ci->db->query($sql);
        $online = $res->num_rows();	

      
		   // add counter
		if ($ignore == false) {     	  
		      // yesterday
			  if ($day_id == (date("z")-1))  {
			     $yesterday_value = $day_value; 
			  } else {
			     if ($yesterday_id != (date("z")-1)) {
				    $yesterday_value = 0; 
				 }
			  }
			  $yesterday_id = (date("z")-1);
			  
			  // day
			  if ($day_id == date("z"))  {
			     $day_value++; 
			  }  else  {
			     $day_value = 1;
				 $day_id = date("z");
			  }
			  
			  // week
			  if ($week_id == date("W"))  {
			     $week_value++; 
			  }  else  { 
			     $week_value = 1;
				 $week_id = date("W");
		      }
			  
		      // month
			  if ($month_id == date("n"))  {
			     $month_value++; 
			  }  else  {
			     $month_value = 1;
				 $month_id = date("n");
		      }
			  
			  // year
			  if ($year_id == date("Y"))  {
			     $year_value++; 
			  } else {
			     $year_value = 1;
				 $year_id = date("Y");
		      }
			  
			  // all
			  $all_value++;
				 
			  // neuer record?
			  if ($day_value > $record_value) {
			     $record_value = $day_value;
			     $record_date = date("Y-m-d H:i:s");
			  }
				 
			  // speichern und aufräumen
			 // $sql = "UPDATE counter_values SET day_id = '$day_id', day_value = '$day_value', yesterday_id = '$yesterday_id', yesterday_value = '$yesterday_value', week_id = '$week_id', week_value = '$week_value', month_id = '$month_id', month_value = '$month_value', year_id = '$year_id', year_value = '$year_value', all_value = '$all_value', record_date = '$record_date', record_value = '$record_value' 
			 // WHERE id = 1";
			  //mysqli_query($link, $sql); 

			$sql = "UPDATE counter_values SET day_id = '$day_id', day_value = '$day_value', yesterday_id = '$yesterday_id', yesterday_value = '$yesterday_value', week_id = '$week_id', week_value = '$week_value', month_id = '$month_id', month_value = '$month_value', year_id = '$year_id', year_value = '$year_value', all_value = '$all_value', record_date = '$record_date', record_value = '$record_value' WHERE id = 1";
        	$ci->db->query($sql);

		 		/*$data = array(			
					'day_id' => $day_id,
					'day_value'      => $day_value,
					'yesterday_id'     => $yesterday_id,
					'yesterday_value'    => $yesterday_value,
					'week_id'     => $week_id,
					'week_value'   => $week_value,
					'month_id' => $month_id,
					'month_value'  => $month_value,
					'year_id'  => $year_id,
					'year_value'  => $year_value,
					'all_value'  => $all_value,
					'record_date'  => $record_date,
					'record_value'   => $record_value
				);
		        $ci->db->where('id', 1);
		        $ci->db->update('counter_values', $data);*/

		}


/*
        $filecounter=(APPPATH . 'logs/counter.txt');
        $kunjungan=file($filecounter);
        $kunjungan[0]++;
        $file=fopen($filecounter, 'w');
        fputs($file, $kunjungan[0]);
        fclose($file);
        return $kunjungan[0];*/
    }
}


//si no existe la función invierte_date_time la creamos
if(!function_exists('invierte_date_time'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
	function invierte_date_time($fecha)
	{

		$day=substr($fecha,8,2);
		$month=substr($fecha,5,2);
		$year=substr($fecha,0,4);
		$hour = substr($fecha,11,5);
		$datetime_format=$day."-".$month."-".$year.' '.$hour;
		return $datetime_format;

	}
}

if(!function_exists('get_counter'))
{
	function get_counter()
	{
        //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$query = $ci->db->get('counter_values');
		return $query->result();

	}
}
//end application/helpers/counter_helper.php