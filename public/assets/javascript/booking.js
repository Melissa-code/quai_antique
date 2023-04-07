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




/**
 * Display the hours of a day
 * @param noon
 * @param evening
 */
function displayHours(noon, evening) {
    noon.style.display = "inline-block";
    evening.style.display = "inline-block";
}

/**
 * Not display the hours of the others days
 * @param daysArray (array of days)
 */
function notDisplayHours(daysArray) {
    for(let i = 0; i < daysArray.length; i++) {
        daysArray[i].style.display = "none";
    }
}

/**
 * Display the hours of a day selected by the User (The hours of Monday are diplayed by default)
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
    // Convert string into Date (timestamp)
    selectedDate = Date.parse(selectedDate);
    // Convert timestamp into Date
    selectedDate = new Date (selectedDate);
    // Get the day of the selected date
    let day = selectedDate.getDay();
    getHoursOfTheDay(day);
}


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
            console.log(typeof hours[i].value);
            console.log(hours[i].value);
            return hours[i].value;
        }
    }
}



/**
 * Display the booking with the date the openinghour and the remaining seats
 */
function getBookings(event) {
    event.preventDefault();
    let selectedDate = document.querySelector(".date-input").value;
    let selectedHour = getHour();
    const noonBookings = document.querySelector(".noon-bookings");
    const eveningBookings = document.querySelector(".evening-bookings");

    axios.get(this.href).then(response => {
        const bookings = document.querySelector("div.displayBookings");

        if(this.classList.contains("btn-primary")) {
            response.data.forEach(booking => {

                dateOfBooking = booking.bookedAt;
                dateOfBooking = editDateFormat(dateOfBooking);
                hourOfBooking = booking.startAt;
                hourOfBooking = editHourFormat(hourOfBooking);

              if(dateOfBooking === selectedDate) {
                  if(selectedHour > "7:00" && selectedHour < "17:00" &&  hourOfBooking > "7:00" && hourOfBooking < "17:00") {
                      const node = document.createElement("li");
                      node.textContent = "places restantes: "+ booking.remainingSeats + ', ' + hourOfBooking;
                      bookings.appendChild(node);
                  }
              }


            });
            this.classList.replace("btn-primary", "btn-danger");
            this.textContent = "Masquer les réservations";
        } else {
            bookings.innerHTML = "";
            this.classList.replace("btn-danger", "btn-primary");
            this.textContent = "Afficher les réservations";
        }
    }).catch(error => {
        console.error(error);
        window.alert("Une erreur est survenue.")
    })

}


/**
 * When the booking page is loaded
 */
window.addEventListener("load", function(e) {
    document.querySelector('.date-input').addEventListener('change', getDay);
    document.querySelector("a.js-bookings").addEventListener("click", getBookings);

    document.querySelectorAll(".start-at").forEach(startAt => {
        startAt.addEventListener('click', getHour);
    });

});