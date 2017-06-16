<?php
/**
* @Author: Ronyan Alves
* @Date: 11/10/2016 14:10
* @Projet: Scriptcase
*
**/
?>
<script language="javascript">
function showTimer() { 
	var time=new Date();
	var hour=time.getHours();
	var minute=time.getMinutes();
	var second=time.getSeconds();		
	var dd = time.getDate();
	var mm = time.getMonth()+1; //January is 0!
	var yyyy = time.getFullYear();
	if(hour<10) hour ="0"+hour;
	if(minute<10) minute="0"+minute;
	if(second<10) second="0"+second;
	if(dd<10) dd='0'+dd;
	if(mm<10) mm='0'+mm;
	var today = dd+'/'+mm+'/'+yyyy;				
	var st=today+' '+hour+":"+minute+":"+second;
	document.getElementById("timer").innerHTML=st;
} 
function initTimer() {
	setInterval(showTimer,1000);
}
</script>
<?php

/**
* call function:
**/

<script>initTimer();</script><div id=timer></div>
