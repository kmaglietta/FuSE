$(document).ready(function(){
    
    var $toolbar = $('#toolbar');   //declaring variables for ease of use
    var $todolist = $('#list');
    var toDo=[];                    //creating an array to store items 
                                    //this make local storage easier

    
    $('#newItemForm').hide();       //hides the new item form
    $toolbar.hide();                //hides the toolbar
    
    
    
    getLocalStorage();              //calls a function that retreives local storage
    
    function updateLocalStorage(){     //this function sets the local storage with the array toDo
        localStorage.setItem('toDo',JSON.stringify(toDo));
    }
    
    function getLocalStorage(){     //the function that retrives the local storage
        
        var ls = JSON.parse(localStorage.getItem('toDo'));              //create a variable that holds the local storage
        
        if(ls == null){                                                 //if the local sorage is empty (first time user)
            for(var i = 0; i <= $todolist.last().index()+1; i++){       //fill the list with the default list items
                var itemLi = new Object();
                itemLi.des = $todolist.find('li').eq(i).text();         //finds the text of the dafult 'li' at index i and sets the description
                itemLi.com = false;                                     //set com to false
                toDo.push(itemLi);                                      //adds the new item to the back of the toDo array
                updateLocalStorage();                                   //updates local storage
            }
        }
        else{                                                           //if returning user
            $todolist.empty();                                          //empty the dafault list
            for(var i = 0; i <= ls.length-1; i++){                      //going through each element in the local storage
                var itemLi = new Object();                              //creating a new object to work with
                itemLi.des = ls[i].des;                                 //set the description to that from local storage
                itemLi.com = ls[i].com;                                 //set the complete flag to that from local storage
                $todolist.append('<li class="pend">'+ ls[i].des +' </li>'); //adds the new item to the list
                if(ls[i].com == true){                                  //check if local storage item is completed
                    $todolist.find('li').eq(i).addClass('done');        //if so add the done class to it
                } 
                toDo.push(itemLi);                                      //add the item to the array
            }
        }
    }
    
    
    
    function addItem(text){                                             //this function adds an item to the list and to the array
        $('#list').append('<li class="pend">'+ text +' </li>');         //add to the list
        var itemLi = new Object();                                      //new object to work with
        itemLi.des = text;                                              //set the variables
        itemLi.com = false;
        
        toDo.push(itemLi);                                              //add to the array
        updateLocalStorage();                                           //update local storage
    }
    
    function toggleEdit(){                                              //enables or disables edit
        var $this = $todolist.find('.selected'), isEditable=$this.is('.editable'); //adds the class editable to the selected item
        $this.prop('contenteditable',!isEditable).toggleClass('editable'); // enables the item to be edited
        $this.focus();                                                             //puts the focus on the item
        $this.keypress(function(x){                                             //listens for a key to be pressed
            if(x.which == 13){                                                  //checks if it was 'enter'
                $this.prop('contenteditable',false).toggleClass('editable');    //disables editability
                x.preventDefault();                                             //prevents 'eneter' default
                
                var str = $this.text();                                         //create a string var from new item
                var indx = $this.index();                                       //gets the index of item
                toDo[indx].des = str;                                           //sets the description of item in the array to the updated one
                
                updateLocalStorage();                                          //update local storage
            }
        })
        
    }
    
    function compItem(){                                    //completes the item
        var $item = $('ul').find('.selected');              //looks for the selected item
        if($item.hasClass('done')){                         //if it has the 'done' class
            $item.removeClass('done');                      //removes the class
            toDo[$item.index()].com = false;                //sets the flag to false
        }
        else{                                               //if not
            $item.addClass('done');                         //add the class
            toDo[$item.index()].com = true;                 //sets the flag to true
        }
        updateLocalStorage();                               //update local storage
    }
    
    function delItem(){                                     //deletes the selsected item
        var $item = $('ul').find('.selected')               //creates a variable of the selected item
        $item.fadeOut(400,function(){ $item.remove();});    //fades out the item then removes it
        $toolbar.hide();                                    //hide the toolbar
        toDo.splice($item.index(),1);                       //removes the item from the array
        updateLocalStorage();                               //update local storage
    }   
    
    
    
    
    $('.del').on('click',function(){    //listen for click on class '.del'
        delItem();
    });
    
    $('.com').on('click',function(){    //listen for click on class '.com'
        compItem();
    });
    
    $('.edit').on('click',function(){    //listen for click on class '.edit'
        toggleEdit();
        
    });
    
    $('ul').on('click','li', function(){        //listen for click on a 'li'
        if($todolist.find('.selected')){        //if there is an item already selected
            $todolist.find('.selected').removeClass('selected'); //deselect it
        } 
    
        $toolbar.show();                //show the tool bar
        if($(this).hasClass('pend')){   //if its not completed show that its selected
            $(this).toggleClass('selected');   //just add the selected class
        }
        else if($(this).hasClass('done')){  //if its done
            $(this).removeClass('done').addClass('selected done') //remove the 'done' class and replace with 'selected done' givig css precedence to selected
        }
        console.log($(this).index());       //update local storage
    });
    
    $('#newItemButton').on('click',function(){  //listen for click on 'newItemButton'
        $(this).hide();                         //hide the button
        $('#newItemForm').show();               //show the 'newItemForm'
    });
    
    
    $('#newItemForm').on('submit', function(x){ //listen for click on 'add' button with type 'submit'
        x.preventDefault();                     //prevent default if enter
        var text = $('input:text').val();       //saves the user input
        addItem(text);                          //adds the item base on the input
        $('input:text').val('');                //clears the input feild
        $(this).hide();                         //hides the form
        $('#newItemButton').show();             //show the button again
        
    });
});