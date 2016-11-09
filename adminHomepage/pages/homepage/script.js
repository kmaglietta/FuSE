$(document).ready(function() {
   $('#formDropDownBtn').on('mouseenter', function() {
       $(this).addClass('selected');
   });
   $('#formDropDownBtn').on('mouseleave', function() {
       $(this).removeClass('selected'); 
   });
    $('#tableDropDownBtn').on('mouseenter', function() {
       $(this).addClass('selected');
   });
   $('#tableDropDownBtn').on('mouseleave', function() {
       $(this).removeClass('selected'); 
   });
});