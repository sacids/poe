let currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form ...
    let x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n === 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n === (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    let x = document.getElementsByClassName("tab");

    // Exit the function if any field in the current tab is invalid:
    if (n === 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

//format date


// Defining a function to display error message
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

// Defining a function to validate form
function validateForm() {
    // Retrieving the values of form elements
    let name = document.getElementById("name").value;
    let age = document.getElementById("age").value;
    let sex = document.getElementById("sex").value;
    let nationality = document.getElementById("nationality").value;
    let passportNo = document.getElementById("passport_number").value;
    let vessel = document.getElementById("vessel").value;
    let arrivalDate = document.getElementById("arrival_date").value;
    let pointOfEntry = document.getElementById("point_of_entry").value;
    let stayDuration = document.getElementById("duration_stay").value;
    let employment = document.getElementById("employment").value;
    let countryOrigin = document.getElementById("country_origin").value;

    //validate per current tab
    //tab 1 validation
    if (currentTab === 0) {
        let errorName = errorAge = errorSex = errorNationality = errorPassportNo = errorVessel = errorArrivalDate = errorPointOfEntry = true;

        // Validate name
        if (name === "") {
            printError("errorName", "Please enter your name");
        } else {
            let regex = /^[a-zA-Z\s]+$/;
            if (regex.test(name) === false) {
                printError("errorName", "Please enter a valid name");
            } else {
                printError("errorName", "");
                errorName = false;
            }
        }

        //validate age
        if (age === "") {
            printError("errorAge", "Please enter you age");
        } else {
            printError("errorAge", "");
            errorAge = false;
        }

        //validate sex
        if (sex === "") {
            printError("errorSex", "Please select sex");
        } else {
            printError("errorSex", "");
            errorSex = false;
        }

        //validate nationality
        if (nationality === "") {
            printError("errorNationality", "Please enter your nationality")
        } else {
            printError("errorNationality", "");
            errorNationality = false;
        }

        //validate passport
        if (passportNo === "") {
            printError("errorPassportNo", "Please enter Passport No")
        } else {
            printError("errorPassportNo", "");
            errorPassportNo = false;
        }

        //validate vessel
        if (vessel === "") {
            printError("errorVessel", "Please enter Vessel Name/No")
        } else {
            printError("errorVessel", "");
            errorVessel = false;
        }

        //validate arrivalDate
        if (arrivalDate === "") {
            printError("errorArrivalDate", "Please enter arrival Date")
        } else {
            let today = new Date();
            //date
            let day = today.getDate();
            day = (day < 10) ? '0' + day : day;

            //month
            let month = today.getMonth() + 1;
            month = (month < 10) ? '0' + month : month;

            //year
            let year = today.getFullYear();
            let currentDate = year + '-' + month + '-' + day;

            if (arrivalDate < currentDate) {
                printError("errorArrivalDate", "Arrival should be equal or greater than today")
            } else {
                printError("errorArrivalDate", "");
                errorArrivalDate = false;
            }
        }

        //validate pointOfEntry
        if (pointOfEntry === "") {
            printError("errorPointOfEntry", "Please select point of entry")
        } else {
            printError("errorPointOfEntry", "");
            errorPointOfEntry = false;
        }

        //check all data in tab one
        if ((errorName || errorAge || errorSex || errorNationality || errorPassportNo || errorVessel || errorArrivalDate || errorPointOfEntry) === true) {
            return false;
        }

        return true;

        //tab 2 validation
    } else if (currentTab === 1) {
        let errorEmployment = errorStayDuration = true;

        //validate duration stay
        if (stayDuration === "") {
            printError("errorStayDuration", "Please enter duration of stay")
        } else {
            printError("errorStayDuration", "");
            errorStayDuration = false;
        }

        //validate employment
        if (employment === "") {
            printError("errorEmployment", "Please select employment")
        } else {
            printError("errorEmployment", "");
            errorEmployment = false;
        }

        //check all data in tab one
        if ((errorStayDuration || errorEmployment) === true) {
            return false;
        }
        return true;

        //tab 3 validation
    } else if (currentTab === 2) {
        return true;

        //tab 3 validation
    } else if (currentTab === 3) {
        let errorCountryOrigin = true;

        if (countryOrigin === "") {
            printError("errorCountryOrigin", "Country where the journey started")
        } else {
            printError("errorCountryOrigin", "");
            errorCountryOrigin = false;
        }

        //check all data in tab 3
        if ((errorCountryOrigin) === true) {
            return false;
        }
        return true;
    }
    return true;
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    let i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
}