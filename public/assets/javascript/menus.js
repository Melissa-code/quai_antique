const menu = document.getElementById("menus");
const changeDaytime = document.getElementById("changeDaytime");
const noonMenus = document.getElementById("noon-menus");
const eveningMenus = document.getElementById("evening-menus");


// Event : toggle switch to select the noon menus or the evening menus
changeDaytime.addEventListener('click', e => {

    if(getComputedStyle(noonMenus).display != "none"){
        noonMenus.style.display = "none";
        eveningMenus.style.display = "block";
    } else if (getComputedStyle(eveningMenus).display != "none") {
        eveningMenus.style.display = "none";
        noonMenus.style.display = "block";
    }
});

// Event : when loading menus page display the noon menus by default
document.addEventListener('DOMContentLoaded', function() {
    eveningMenus.style.display = "none";
    noonMenus.style.display = "block";
});