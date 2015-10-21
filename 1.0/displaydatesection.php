    
    <td></td>                  
    <?php 
		$weekpos = $_REQUEST["weekpos"];
		$nowdate = date("m-d-Y");
		$nowdate_temp = str_replace('-', '/', $nowdate);
	
        for($i = ($weekpos * 7); $i<=($weekpos * 7)+6 ; $i++){				
            $displaydate = date('D, d M Y',strtotime($nowdate_temp . "+". $i ." days"));
            echo "<td style='text-align:left;color: #009933;font-weight: bold;font-size:15px;'>".$displaydate."</td>";
        }
    ?>     