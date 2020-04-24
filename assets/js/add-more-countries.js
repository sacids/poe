$(document).ready(function () {
    let maxField = 10; //Input fields increment limitation
    let addButton = $('.add_button'); //Add button selector
    let wrapper = $('.field_wrapper'); //Input field wrapper
    let fieldHTML = '<div class="col-lg-3 col-md-3 col-sm-3 col-12">' +
        '<div class="form-group">' +
        '<label>Country</label>' +
        '<input type="text" name="country[]" id="country" class="form-control" placeholder="Write country..."/>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-3 col-md-3 col-sm-3 col-12">' +
        '<div class="form-group">' +
        '<label>Location visited/Province</label>' +
        '<input type="text" name="location[]" id="location" class="form-control" placeholder="Write location..."/>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-3 col-md-3 col-sm-3 col-12">' +
        '<div class="form-group">' +
        '<label>Date</label>' +
        '<input type="date" name="date[]" id="date" class="form-control"/>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-3 col-md-3 col-sm-3 col-12">' +
        '<div class="form-group">' +
        '<label>No. of days</label>' +
        '<input type="number" name="days[]" id="days" class="form-control" placeholder="Write number of days..."/>' +
        '</div>' +
        '</div>';

    let x = 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});