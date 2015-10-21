<script>
	if (localStorage["user_email"]) {
		userid = localStorage.getItem("user_id");
		var user_email = localStorage.getItem("user_email");		  
		$("#loggedinuser").html("You logged in as : " + user_email + ", <a href='#' id='logout'>Logout</a>");
	}	
	else{
		window.location.href = 'login.php';
	}
</script>
<?php 
	date_default_timezone_set("Asia/Jakarta");
	include("config.php");
	
	$user_email = "ferdinand_pradana@yahoo.com";
	
	$sql_check = "SELECT * FROM user where user_email = '". $user_email."'";
	$result_check = $conn->query($sql_check);
	
	$result = "not registered";
	
	if (@$result_check->num_rows > 0) {
		$result = "registered";
	}			
			
	$conn->close();
	
	$nowdate = date("m-d-Y");
	$nowdate_temp = str_replace('-', '/', $nowdate);
	
	
?>
<input type="hidden" id="weekpos" value="0" />
<div style="text-align:center;padding: 20px;font-weight: bold;color: #003366;font-size: 16px;">
	<span id="loggedinuser"></span>
</div>

<div style="text-align:center;padding: 20px;font-weight: bold;color: #003366;font-size: 21px;">
	Soccer Stadium Online Reservation
</div>

<div style="text-align:center;padding:30px;color: #0033CC">
	<table style="text-align:center;width:100%;">
    	<tr >
        	<td style="text-align:center;padding-bottom:20px;">Select date : </td>
        	<td colspan="2" style="text-align:left;padding-bottom:20px;"><select id="weekselector" style="cursor:pointer;">           
            <?php 
				for($i = 0; $i<=51 ; $i++){		
							
					$beginweek = date('D, d M Y',strtotime($nowdate_temp . "+". (($i*7) + 0) ." days"));
					$endweek = date('D, d M Y',strtotime($nowdate_temp . "+". (($i*7) + 6) ." days"));
				
					echo '<option id="week-'.$i.'" value="'.$i.'">'.$beginweek.' - '.$endweek.'</option>';
				}
			?>   
            </select></td> 
            
             <td style="text-align:center;padding-bottom:20px;">BookSlot Info : </td>
             <td style="text-align:center;padding-bottom:20px;"><div style="height:20px;width:120px;border:1px #333333 solid;border-radius:3px;cursor:pointer;padding-top:5px;background-color:#FFFFCC;font-size:14px;color:#000066;">Available to book</div></td>
             <td style="text-align:center;padding-bottom:20px;"><div style="height:20px;width:120px;border:1px #333333 solid;border-radius:3px;cursor:pointer;padding-top:5px;background-color:green;font-size:14px;color:#FFFFFF;">Booked by You</div></td>
             <td style="text-align:center;padding-bottom:20px;"><div style="height:20px;width:120px;border:1px #333333 solid;border-radius:3px;cursor:pointer;padding-top:5px;background-color:red;font-size:14px;color:#FFFFFF;">Booked by Others</div></td>
             
        </tr>
    	<tr class="displaydatesection">
        	<td></td>                  
        	<?php 
				for($i = 0; $i<=6 ; $i++){				
					$displaydate = date('D, d M Y',strtotime($nowdate_temp . "+". $i ." days"));
					echo "<td style='text-align:left;color: #009933;font-weight: bold;font-size:15px;'>".$displaydate."</td>";
				}
			?>           
        </tr>
        <?php 
			$initial_time=6;
            for($j = 1; $j<=15 ; $j++){	
				
				$begin_time = $initial_time + $j;
				$end_time = $initial_time + $j + 1;
				
				if ($begin_time < 10){  $begin_time_str = "0".$begin_time.":00"; }
				else{ $begin_time_str = $begin_time.":00"; }
				
				if ($end_time < 10){ $end_time_str = "0".$end_time.":00"; }
				else{ $end_time_str = $end_time.":00"; }
			
            	echo "<tr>";
				
				echo "<td style='color: #003399;font-weight: bold;font-size:14px;'>";
                	echo $begin_time_str."-".$end_time_str;
				echo "</td>";
               
				for($i = 0; $i<=6 ; $i++){				
					echo '<td><div class="bookslot" id="bookslot-'.$i.'-'.$j.'" style="height:25px;width:120px;border:1px #333333 solid;border-radius:3px;cursor:pointer;"></div></td>';
				}
				
				echo "</tr>";
			}
         ?>
    </table>
</div>

<script type="text/javascript" src="jquery-2.1.1.js"></script>
<script>
	
	var userid = 0;	
	if (localStorage["user_email"]) {
		userid = localStorage.getItem("user_id");
		var user_email = localStorage.getItem("user_email");		  
		$("#loggedinuser").html("You logged in as : " + user_email + ", <a href='#' id='logout'>Logout</a>");
	}	
	else{
		window.location.href = 'login.php';
	}
	
	$('.bookslot').css('background-color','#FFFFCC');
	$(".bookslot").css('cursor','pointer');
	
	var weekpos = $("#weekpos").val();
	$.post("bookslotcheck.php?weekpos="+weekpos, function(response) {
				
		var bookslot = JSON.parse(response);
		
		for (var i = 0; i < bookslot.length; i++) {
			var bookdate=new Date(bookslot[i].book_date);
			var nowdate=new Date();
			
			var dateid = DateDiff(bookdate,nowdate);
			
			var initialtime = 6;
			var timeid = bookslot[i].book_time - initialtime;
			
			if (userid == bookslot[i].book_userid){
				$("#bookslot-"+dateid+"-"+timeid).css('background-color','green');
				$("#bookslot-"+dateid+"-"+timeid).css('cursor','pointer');
			}
			else{
				$("#bookslot-"+dateid+"-"+timeid).css('background-color','red');
				$("#bookslot-"+dateid+"-"+timeid).css('cursor','default');
			}
		}
		
	});
	
	$('#logout').click(function(){
		localStorage.removeItem("user_id");
		localStorage.removeItem("user_email");
		window.location.href = 'login.php';
	});
	
	$('.bookslot').click(function(){
		
		var weekpos = $("#weekpos").val();
		var slot = $(this).attr("id").replace("bookslot-","").split("-");
		
		var dateid = slot[0];
		var timeid = slot[1];
		
		if ($(this).css('background-color') != "rgb(255, 0, 0)"){
			if ($(this).css('background-color') == "rgb(0, 128, 0)"){
				var confirmcancel = confirm("Cancel this booking slot ?");
				if (confirmcancel == true) {
					$.post("bookslotcancel.php?dateid="+dateid+"&timeid="+timeid+"&weekpos="+weekpos+"&userid="+userid, function(response) {
						
						if (response == "book cancel"){
							$("#bookslot-"+dateid+"-"+timeid).css('background-color','#FFFFCC');
						}
						else{
							alert(response);
						}
					});
				} 
			}
			else{
				var confirmbook = confirm("Book this slot ?");
				if (confirmbook == true) {
					$.post("bookslotadd.php?dateid="+dateid+"&timeid="+timeid+"&weekpos="+weekpos+"&userid="+userid, function(response) {
						
						if (response == "book success"){
							$("#bookslot-"+dateid+"-"+timeid).css('background-color','green');
						}
						else{
							alert(response);
						}
					});
				} 
			}
		}
		
	});
	
	$('#weekselector').change(function(){
		$('#weekpos').val($(this).val());
		
		var weekpos = $(this).val();
		
		$.post("displaydatesection.php?weekpos="+weekpos, function(response) {
			$('.displaydatesection').html(response);
			
			$('.bookslot').css('background-color','#FFFFCC');
			$(".bookslot").css('cursor','pointer');
			
			$.post("bookslotcheck.php?weekpos="+weekpos, function(response2) {
							
				var bookslot = JSON.parse(response2);
				
				for (var i = 0; i < bookslot.length; i++) {
					var bookdate=new Date(bookslot[i].book_date);
					var nowdate=new Date();
					
					var dateid = DateDiff(bookdate,nowdate)-(weekpos*7);
					
					var initialtime = 6;
					var timeid = bookslot[i].book_time - initialtime;
					
					if (userid == bookslot[i].book_userid){
						$("#bookslot-"+dateid+"-"+timeid).css('background-color','green');
						$("#bookslot-"+dateid+"-"+timeid).css('cursor','pointer');
					}
					else{
						$("#bookslot-"+dateid+"-"+timeid).css('background-color','red');
						$("#bookslot-"+dateid+"-"+timeid).css('cursor','default');
					}
				}
				
			});
		});
	});
	
	function DateDiff(date1, date2) {
		date1.setHours(0);
		date1.setMinutes(0, 0, 0);
		date2.setHours(0);
		date2.setMinutes(0, 0, 0);
		var datediff = Math.abs(date1.getTime() - date2.getTime()); // difference 
		return parseInt(datediff / (24 * 60 * 60 * 1000), 10); //Convert values days and return value      
	}
</script>