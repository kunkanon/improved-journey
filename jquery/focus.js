/**
* @Author: Ronyan Alves
* @Date: 2017-10-23 15:17
* @Project: JQuery
*
**/

function TextAreaFocus(input){
  var Txt = $('#'+input).text();
  $('#'+input).text('');
  $('#'+input).focus();
  $('#'+input).text(Txt);
}
