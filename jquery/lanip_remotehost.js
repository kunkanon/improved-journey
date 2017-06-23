##
# @Author: Ronyan Alves
# @Date: 2017-03-17 12:50
# @Project: Scriptcase
#
##


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

 Ip LAN:<h3 class='ipAdd'><h3>

<script>
$(document).ready(function()
{
  	window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;  
	var pc = new RTCPeerConnection({iceServers:[]}), 
	noop = function(){}; 
     
   	pc.createDataChannel("");  
	pc.createOffer(pc.setLocalDescription.bind(pc), noop);   
    	pc.onicecandidate = function(ice){ 
   	if(!ice || !ice.candidate || !ice.candidate.candidate)  return;

        	var myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];

        
	$('.ipAdd').text(myIP);
  
        	pc.onicecandidate = noop;
  
	 }; 
});
      
</script>
