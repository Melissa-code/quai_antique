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
 * When the booking page is loaded
 */
window.addEventListener("load", function(e) {
    document.querySelector('.date-input').addEventListener('change', getDay);
});