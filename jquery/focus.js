function TextAreaFocus(input){
  var Txt = $('#'+input).text();
  $('#'+input).text('');
  $('#'+input).focus();
  $('#'+input).text(Txt);
}
