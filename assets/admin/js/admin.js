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
        $('#content').html('<div class="d-flex justify-content-center">'+
                '<div class="spinner-border" role="status">'+
                    '<span class="sr-only">Loading...</span>'+
                '</div>'+
            '</div>');
    
        var jqXHR = $.ajax({
            type:"POST",
            url:window.location.origin+'/'+url,
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


    $(document).on('click','.item_manage .tab-item', function(e){

        $('.item_manage .tab-item').removeClass('active');
        $(this).addClass('active');

        var method  = $(this).attr('act');
        var data    = $(this).attr('args');
        alert(method + ' ' + data);

        $('#item_content').html('<div class="d-flex justify-content-center">'+
                '<div class="spinner-border" role="status">'+
                    '<span class="sr-only">Loading...</span>'+
                '</div>'+
            '</div>');
    
        var jqXHR = $.ajax({
            type:"POST",
            url:window.location.origin+'/'+method,
            data:data,
        }).done(function (data){

            $('#item_content').html(data);

        }).fail(function(jqXHR, textStatus, errorThrown){

            $('#item_content').html('Temporary error, please try again');

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