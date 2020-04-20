function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}


$(document).ready(function(){

    $(document).on('click','.item',function(event){

        var subMenu = $(this).attr('sid');
        $('.subMenu').css({ "margin-left" : "-250px"});
        $('#'+subMenu).animate({
            marginLeft: "88px"
        });
        return;
    });

    $(document).on('click','.closeSM',function(event){

        var subMenu = $(this).closest('.subMenu').attr('id');
        $('#'+subMenu).animate({
            marginLeft: "-250px"
        });
        return;
    });

    $(document).on('click','.subMenu .link', function(e){

        var url     = $(this).attr('u');
        $('.subMenu').animate({ 
            "margin-left" : "-250px"
        });

        e.preventDefault();
        // dim & progress
    
        var jqXHR = $.ajax({
            type:"POST",
            url:window.location.origin+'/poe/'+url,
        }).done(function (data){

            $('#content').html(data);

        }).fail(function(jqXHR, textStatus, errorThrown){

            $('#content').html('Temporary error, please try again');

            if ( console && console.log ) {
                console.log("Loading Ajax: " + textStatus + ", " + errorThrown);
            }
        }).always(function() {
        });

        // Avoid submit event to continue normal execution
        e.preventDefault();
        return false;
    });

    

});