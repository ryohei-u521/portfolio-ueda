$(function () {
              
$('input[id="pc"]').on('click', function () {
var pc_value = $(this).val();
                  
$('input[id="sp"]').each(function() {
if($(this).val() == pc_value) {
  var chk_status = $(this).prop("checked");
  if(chk_status){
    $(this).prop('checked', false);
  }else {
    $(this).prop('checked', true);
  }
}
}) 
});
  
$('input[id="sp"]').on('click', function () {
var sp_value = $(this).val();
                 
$('input[id="pc"]').each(function() {
if($(this).val() == sp_value) {
  var chk_status = $(this).prop("checked");
  if(chk_status){
    $(this).prop('checked', false);
  }else {
    $(this).prop('checked', true);
  }
}
})
});  
  
});