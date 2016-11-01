$(document).ready(function() {
    
    
    
    //ALLOW EDITING OF TUTOR PROFILE
    $('#editBtn').on('click', function() {
        $(this).closest('body').find('.info').each(function() {
            
            if(!$(this).parent().hasClass('edit')) {    
               $(this).parent().addClass('edit'); 
            
                var oldText = $(this).closest('body').find($(this)).text();
                
                $(this).find('span').remove();
                
                if(!$(this).is('#name')) {
                     

                     $(this).append('<form><span><textarea rows="3" cols="50" contenteditable="true">' + oldText + '</textarea></span></form>');


                    
                }
                else {
                    $(this).append('<form><span><textarea rows="1" cols="20" contenteditable="true">' + oldText + '</textarea></span></form>')
                }
                
               $(this).closest('body').find('#editBtn').text('Save');

            }
            
            else {
                var newText = $(this).parent().find('textarea').val();
                $(this).find('span').text(newText);
                $(this).closest('body').find('#editBtn').text('Edit');
                newText = '';
                $(this).parent().removeClass('edit');
            }
            
            
            
        });
        
    });
    
    
    //DISPLAY MESSAGES 
    $('.star').on('click', function () {
      $(this).toggleClass('star-checked');
    });

    $('.ckbox label').on('click', function () {
      $(this).parents('tr').toggleClass('selected');
    });

    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });
    
});