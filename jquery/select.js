/**
* @Author: Ronyan Alves
* @Date: 2017-10-23 15:19
* @Project: JQuery
*
**/

function SelectComboLabel(input,output){
  $('#'+output).val($('#'+input).find(":selected").text());
	$('#'+input).change(function(){
		var sText = $(this).find(":selected").text();
		$('#'+output).val(sText);
	})
}
