/**
* @Author: Ronyan Alves
* @Date: 2018-05-22 20:19
* @Project: JQuery
*
**/


$(document).ready(function(){
	$("#iframe_treemenu").on("load",function(){
		$("#iframe_treemenu").contents().find("div#id-div-iframe-0").css("background-color","red");
		$("#iframe_treemenu").contents().find("div#id-div-iframe-1").css("background-color","green");
		$("#iframe_treemenu").contents().find("div#id-div-iframe-2").css("background-color","yellow");
		$("#iframe_treemenu").contents().find("div#id-div-iframe-3").css("background-color","orange");
	})
})
