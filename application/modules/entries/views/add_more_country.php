<script type="text/javascript">
    $(document).ready(function () {
        let maxField = 10; //Input fields increment limitation
        let addButton = $('.add_button'); //Add button selector
        let wrapper = $('.field_wrapper'); //Input field wrapper
        let fieldHTML = '<div class="col-lg-6 col-md-6 col-sm-6 col-12">' +
            '<div class="form-group">' +
            '<label><?php echo $this->lang->line("lbl_country") ?></label>' +
            '<?php
                echo '<select id="country[]" name="country[]" class="form-control">';
                echo '<option value="">' . $this->lang->line('lbl_select') . '</option>';
                foreach ($countries as $country) {
                    echo '<option value="' . $country->id . '">' . $country->name . '</option>';
                }
                echo '</select>';
                ?>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6 col-md-6 col-sm-6 col-12">' +
            '<div class="form-group">' +
            '<label><?php echo $this->lang->line("lbl_location_country") ?></label>' +
            '<input type="text" name="location[]" id="location" class="form-control"/>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6 col-md-6 col-sm-6 col-12">' +
            '<div class="form-group">' +
            '<label><?php echo $this->lang->line("lbl_date") ?></label>' +
            '<input type="date" name="date[]" id="date" class="form-control"/>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6 col-md-6 col-sm-6 col-12">' +
            '<div class="form-group">' +
            '<label><?php echo $this->lang->line("lbl_no_of_days") ?></label>' +
            '<input type="number" name="days[]" id="days" class="form-control"/>' +
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
</script>