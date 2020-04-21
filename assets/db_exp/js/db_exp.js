/**
 * 
 */
/**
 * Created by Eric Beda on 2/24/2016.
 */
function initComponents(){
   
   
}

function make_table(){

    columnDefs: [
        
    ],
    $('.dbx_table').DataTable({
        autoWidth: false,
        deferRender:    true,
        scrollY:        400,
        scrollCollapse: true,
        scroller:       true,
        select:         true,
        responsive: true,
        columnDefs: [
            { targets: -1, visible: false},
            { width: 20, targets: 0 },
            { width: 20, targets: 1 }
        ],
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-light'
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        },
        dom: '<"datatable-header"fB><"datatable-scroll"t><"datatable-footer">',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '→', 'previous': '←' }
        }
    });
}

$(document).ready(function() {

    $(document).on('click', '.dbx_submit', function(event) {

        //alert('submit');
        // get the form
        var form = $(this).closest("form");
        console.log( form.serializeArray() );

        var action = form.attr('action');
        var target ;

        if(!form.attr('target')){
            target = form.parent();
        }else{
            target = $('#'+form.attr('target'));
        }

        var id = form.attr('id');
        var ajax = form.attr('ajax');

        if( ajax === 'no'){
            //alert('no ajaxx');
            return true;
        }

        var data = new FormData( $("#"+id)[0] );

        var jqXHR = $.ajax({
            type:"POST",
            url:action,
            data:data,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false
        }).done(function(data){
            target.html(data);
            initComponents();
        }).fail(function(jqXHR, textStatus, errorThrown){
            target.html('Temporary error, please try again');
            if ( console && console.log ) {
                console.log("Loading Ajax dbx: " + textStatus + ", " + errorThrown);
            }
        }).always(function(){ 

        });

        // Avoid submit event to continue normal execution
        event.preventDefault();
        return false;
    });

    $(document).on('click', '.dbx_insert', function(event) {

        //alert('submit');
        // get the form
        var target = $(this).closest(".dbx_wrapper").attr('id');
        var action = $(this).attr('action');

        var jqXHR = $.ajax({
            type:"GET",
            url:action,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false
        }).done(function(data){

            $('#'+target).html(data);
            initComponents();
            //$('#'+target+' .multiselect').multiselect('refresh');
            
        }).fail(function(jqXHR, textStatus, errorThrown){

            $('#'+target).html('Temporary error, please try again');
            if ( console && console.log ) {
                console.log("Loading Ajax dbx: " + textStatus + ", " + errorThrown);
            }

        }).always(function(){ 

        });

        // Avoid submit event to continue normal execution
        event.preventDefault();
        return false;
    });


    $(document).on('click', '.dbx_arg_link', function(event) {

        // get the form
        var arg    = $(this).attr('arg');
        var target = $(this).attr('target');
        var action = $(this).attr('action');
        if(!target) target = $(this).closest(".dbx_wrapper").attr('id');;
        if(!action) action = window.location.origin+$(this).closest("table").attr('action');
        action = action+'?'+arg;

        // dim & progress
        

        var jqXHR = $.ajax({
            type:"GET",
            url:action,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false
        }).done(function(data){

            $('#'+target).html(data);
            initComponents();
            //$('#'+target+' .multiselect').multiselect('refresh');
            
        }).fail(function(jqXHR, textStatus, errorThrown){

            $('#'+target).html('Temporary error, please try again');
            if ( console && console.log ) {
                console.log("Loading Ajax dbx: " + textStatus + ", " + errorThrown);
            }

        }).always(function(){ 

        });


        // Avoid submit event to continue normal execution
        event.preventDefault();
        return false;
    });

    $(document).on('click', '.dbx_act_link', function(event) {

        // get the form
        var act    = $(this).attr('act');
        var id     = $(this).attr('id');
        var target = $(this).closest(".dbx_wrapper").attr('id');
        var action = window.location.origin+'/'+$(this).closest("table").attr('action')+'&action='+act+'&id='+id;

        var jqXHR = $.ajax({
            type:"GET",
            url:action,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false
        }).done(function(data){

            $('#'+target).html(data);
            initComponents();
            //$('#'+target+' .multiselect').multiselect('refresh');
            
        }).fail(function(jqXHR, textStatus, errorThrown){

            $('#'+target).html('Temporary error, please try again');
            if ( console && console.log ) {
                console.log("Loading Ajax dbx: " + textStatus + ", " + errorThrown);
            }

        }).always(function(){ 

        });


        // Avoid submit event to continue normal execution
        event.preventDefault();
        return false;
    });

    $(document).on('click','.db_exp_table .form-control', function(event) {

        $('.on_bc').removeClass('on_bc').css("border-color","");
        $(this).parent('.form-group').addClass('on_bc').css("border-color", "#0aa7ef");;
    });

   

    $('.dbx_table').DataTable({
        autoWidth: false,
        deferRender:    true,
        scrollY:        400,
        scrollCollapse: true,
        scroller:       true,
        select:         true,
        responsive: true,
        columnDefs: [{
            targets: -1, // Hide actions column
            visible: false
        }],
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-light'
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        },
        dom: '<"datatable-header"fB><"datatable-scroll"t><"datatable-footer">',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '→', 'previous': '←' }
        }
    });



});

