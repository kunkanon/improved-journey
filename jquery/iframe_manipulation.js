/**
* @Author: Ronyan Alves
* @Date: 2018-05-22 20:19
* @Project: JQuery
*
**/

/* with count */
$(document).ready(function(){
	$("#iframe_treemenu").on("load",function(){
		$("#iframe_treemenu").contents().find("div#id-div-iframe-0").css("background-color","red");
		$("#iframe_treemenu").contents().find("div#id-div-iframe-1").css("background-color","green");
		$("#iframe_treemenu").contents().find("div#id-div-iframe-2").css("background-color","yellow");
		$("#iframe_treemenu").contents().find("div#id-div-iframe-3").css("background-color","orange");
	})
});

/* with period */
$(document).ready(function(){
	var percent = "";
	$("#iframe_treemenu_60").on("load",function(){
		$("#iframe_treemenu_60").contents().find("div#id-div-iframe-4").find("span").each(function(){
		   if($(this).text().includes("%") == true){
			  percent = $(this).text().replace("%","");
			  percent = parseInt(percent);
		   }
		});
		if(percent<50){
			$("#iframe_treemenu_60").contents().find("div#id-div-iframe-4").css("background-color","@ff7575");
		}else{
			$("#iframe_treemenu_60").contents().find("div#id-div-iframe-4").css("background-color","#77fdac");	
		}
	})
});
