const noonMonday = document.querySelector("#noon-monday");
const eveningMonday = document.querySelector("#evening-monday");
const noonTuesday = document.querySelector("#noon-tuesday");
const eveningTuesday = document.querySelector("#evening-tuesday");
const noonWednesday = document.querySelector("#noon-wednesday");
const eveningWednesday = document.querySelector("#evening-wednesday");
const noonThursday = document.querySelector("#noon-thursday");
const eveningThursday = document.querySelector("#evening-thursday");
const noonFriday = document.querySelector("#noon-friday");
const eveningFriday = document.querySelector("#evening-friday");
const noonSaturday = document.querySelector("#noon-saturday");
const eveningSaturday  = document.querySelector("#evening-saturday");
const noonSunday = document.querySelector("#noon-sunday");
const eveningSunday = document.querySelector("#evening-sunday");

/*************************************************
 *      Booking time
 *************************************************/

/**
 * Display booking hours of a day
 * @param noonHours
 * @param eveningHours
 */
function displayHours(noonHours, eveningHours) {
    noonHours.style.display = "inline-block";
    eveningHours.style.display = "inline-block";
}

/**
 * Not display the hours of the others days
 * @param arrayOfDays (array)
 */
function notDisplayHours(arrayOfDays) {
    for(let i = 0; i < arrayOfDays.length; i++) {
        arrayOfDays[i].style.display = "none";
    }
}

/**
 * Display the hours of a day selected by the User (The hours of Monday are displayed by default)
 * @param day (is an integer : Sunday is 0)
 */
function getHoursOfTheDay(day) {
    switch (day) {
        case 0:
            let notSunday = [noonMonday, eveningMonday, noonWednesday, eveningWednesday, noonThursday, eveningThursday, noonFriday, eveningFriday, noonSaturday, eveningSaturday];
            notDisplayHours(notSunday);
            displayHours(noonSunday, eveningSunday);
        break;
        case 1:
            const notMonday = [noonTuesday, eveningTuesday, noonWednesday, eveningWednesday, noonThursday, eveningThursday, noonFriday, eveningFriday, noonSaturday, eveningSaturday, noonSunday, eveningSunday];
            notDisplayHours(notMonday);
            displayHours(noonMonday, eveningMonday);
        break;
        case 2:
            let notTuesday = [noonMonday, eveningMonday, noonWednesday, eveningWednesday, noonThursday, eveningThursday, noonFriday, eveningFriday, noonSaturday, eveningSaturday, noonSunday, eveningSunday];
            notDisplayHours(notTuesday);
            displayHours(noonTuesday, eveningTuesday);
        break;
        case 3:
            let notWednesday = [noonMonday, eveningMonday, noonTuesday, eveningTuesday, noonThursday, eveningThursday, noonFriday, eveningFriday, noonSaturday, eveningSaturday, noonSunday, eveningSunday];
            notDisplayHours(notWednesday);
            displayHours(noonWednesday, eveningWednesday);
        break;
        case 4:
            let notThursday = [noonMonday, eveningMonday, noonWednesday, eveningWednesday, noonTuesday, eveningTuesday, noonFriday, eveningFriday, noonSaturday, eveningSaturday, noonSunday, eveningSunday];
            notDisplayHours(notThursday);
            displayHours(noonThursday, eveningThursday);
        break;
        case 5:
            let notFriday = [noonMonday, eveningMonday, noonTuesday, eveningTuesday, noonWednesday, eveningWednesday, noonThursday, eveningThursday, noonSaturday, eveningSaturday, noonSunday, eveningSunday];
            notDisplayHours(notFriday);
            displayHours(noonFriday, eveningFriday);
        break;
        case 6:
            let notSaturday = [noonMonday, eveningMonday, noonWednesday, eveningWednesday, noonThursday, eveningThursday, noonFriday, eveningFriday, noonSunday, eveningSunday];
            notDisplayHours(notSaturday);
            displayHours(noonSaturday, eveningSaturday);
        break;
    }
}

/**
 * Display the opening hours of the selected day from the date input
 */
function getDay() {
    let selectedDate = document.querySelector('.date-input').value;
    // Convert string into timestamp
    selectedDate = Date.parse(selectedDate);
    // Convert timestamp into Date
    selectedDate = new Date (selectedDate);
    let day = selectedDate.getDay();
    getHoursOfTheDay(day);
}

/*************************************************
 *      Remaining seats
 *************************************************/

/**
 * Get the date in a string format year-month-day
 * @param date
 * @returns {*}
 */
function editDateFormat(date) {
    let momentDate = moment(date);
    return momentDate.format("YYYY-MM-DD");
}

/**
 * Get the hour in a string format Hour:minutes
 * @param hour
 * @returns {*}
 */
function editHourFormat(hour) {
    let momentHour = moment(hour);
    return momentHour.format("H:m");
}

/**
 * Get the value (string) of the hour selected
 * @returns {*}
 */
function getHour() {
    let hours = document.querySelectorAll('.start-at');
    for(let i = 0; i < hours.length; i++) {
        if(hours[i].checked) {
            return hours[i].value;
        }
    }
}

/**
 * Get the value (int) of the number of the guests selected by the user
 * @returns {number}
 */
function getNumberOfGuestsSelected() {
    let listOfGuests, numberOfGuests;
    listOfGuests = document.querySelector('#booking_guest');
    numberOfGuests = listOfGuests.options[listOfGuests.selectedIndex].text;
    numberOfGuests = parseInt(numberOfGuests)
    return numberOfGuests;
}

/**
 * Display the remaining seats
 * @param event
 */
function getBookings(event) {
    event.preventDefault();
    let selectedDate = document.querySelector(".date-input").value;
    let selectedHour = getHour();
    let arrayOfRemainingSeats = [];
    let remainingSeats = 60;

    axios.get(this.href).then(response => {
        const bookings = document.querySelector("ul.displayBookings");

        // response.data is the array of the bookings saved in the database in a JSON format
        if(this.classList.contains("btn-displaySeats")) {
            response.data.forEach(booking => {
                // Get the values of the date and the hour of each booking saved in the database in a string
                let dateOfBooking = booking.bookedAt;
                dateOfBooking = editDateFormat(dateOfBooking);
                let hourOfBooking = booking.startAt;
                hourOfBooking = editHourFormat(hourOfBooking);

              if(dateOfBooking === selectedDate) {
                  if (hourOfBooking > "07:00" && hourOfBooking < "17:00" && selectedHour > "07:00" && selectedHour < "17:00"){
                      arrayOfRemainingSeats.push(booking.remainingSeats);
                  }
                  else if (hourOfBooking > "17:00"  && selectedHour > "17:00"){
                      arrayOfRemainingSeats.push(booking.remainingSeats);
                  }
              }
            });
            // last is the last value of the array of the remaining seats
            const last = arrayOfRemainingSeats[arrayOfRemainingSeats.length-1];
            let limitGuests = 10;

            // If the array of remaining seats has more than one value
            if(arrayOfRemainingSeats.length > 1) {
                if((last - getNumberOfGuestsSelected()) <= limitGuests) {
                    console.log(last - getNumberOfGuestsSelected());
                    alert("Réservation impossible car le restaurant est complet.")
                } else {
                    const node = document.createElement("li");
                    node.textContent = "Places disponibles : " + (last - getNumberOfGuestsSelected());
                    bookings.appendChild(node);
                }
            // If the array of remaining seats has one value
            } else if(arrayOfRemainingSeats.length === 1) {
                if((last - getNumberOfGuestsSelected()) <= limitGuests) {
                    console.log(last - getNumberOfGuestsSelected());
                    alert("Réservation impossible car le restaurant est complet.")
                } else {
                    const node = document.createElement("li");
                    node.textContent = "Places disponibles : " + (last - getNumberOfGuestsSelected());
                    bookings.appendChild(node);
                }
            // If the array of remaining seats is empty
            } else if(arrayOfRemainingSeats.length < 1){
                const node = document.createElement("li");
                node.textContent = "Places disponibles : "+ (remainingSeats - getNumberOfGuestsSelected());
                bookings.appendChild(node);
            }

            this.classList.replace("btn-displaySeats", "btn-hideSeats");
            this.textContent = "Masquer les places disponibles";
        } else {
            bookings.innerHTML = "";
            this.classList.replace("btn-hideSeats", "btn-displaySeats");
            this.textContent = "Afficher les places disponibles";
        }
    }).catch(error => {
        console.error(error);
        window.alert("Une erreur est survenue.")
    })
}

/**
 * Load the booking page
 */
window.addEventListener("load", function(e) {
    document.querySelector('#booking_guest').addEventListener('change', getNumberOfGuestsSelected);
    document.querySelector('.date-input').addEventListener('change', getDay);
    document.querySelector("a.js-bookings").addEventListener("click", getBookings);
    document.querySelectorAll(".start-at").forEach(startAt => {
        startAt.addEventListener('click', getHour);
    });
});