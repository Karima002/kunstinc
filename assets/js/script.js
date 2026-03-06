const scrollHeader = document.querySelector("header");
const nav = document.querySelector("nav");
const menu = document.getElementById("mobileMenu");
const menuUl = document.querySelector("#mobileMenu ul");
const hamburger = document.querySelector(".hamburger");
const logo = document.querySelector(".logo svg");
const darkmodeLamp = document.getElementById("lamp-svgrepo-com");
const darkmodeLampLine = document.querySelector("#Group_6 #Path_79");
const inputDMLamp = document.getElementById("darkmode");
const lampMain = document.getElementById("lamp");
const labelLamp = document.querySelector("label.darkmode");

// Apply dark mode if saved in localStorage
if (localStorage.getItem("darkMode") === "true") {
    enableDarkMode();
    inputDMLamp.checked = true;
} else {
    disableDarkMode();
    inputDMLamp.checked = false;
}

function checkWindowSize() {
    if (window.innerWidth > 900) {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}

function toggleMenu() {
    menu.classList.toggle("show");
    hamburger.classList.toggle("active");
    logo.classList.toggle("active-color");
}

hamburger.addEventListener("click", () => {
    if (hamburger.classList.contains("active")) {
        menu.style.display = "none";
    } else {
        menu.style.display = "flex";
    }

    logo.classList.toggle("active-color");

    toggleMenu();
});

window.addEventListener("scroll", () => {
    if (window.scrollY > 1) {
        // Adjust this value based on when you want the color to change
        logo.classList.add("active");
        scrollHeader.classList.add("active");
        menuUl.classList.add("active");
        darkmodeLamp.classList.add("active");
        darkmodeLampLine.classList.add("active");
        inputDMLamp.classList.add("active");
        lampMain.classList.add("active");
        labelLamp.classList.add("active");
    } else {
        logo.classList.remove("active");
        scrollHeader.classList.remove("active");
        menuUl.classList.remove("active");
        darkmodeLamp.classList.remove("active");
        darkmodeLampLine.classList.remove("active");
        inputDMLamp.classList.remove("active");
        lampMain.classList.remove("active");
        labelLamp.classList.remove("active");
    }
});

if (hamburger.classList.contains("active")) {
    console.log("active");
    logo.classList.add("active");
} else {
    logo.classList.remove("active");
}

console.log('het werkt');

// if inputDMLamp is :checked then set the tekst "darkmode" to localstorage
inputDMLamp.addEventListener("change", () => {
    if (inputDMLamp.checked) {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
});

function enableDarkMode() {
    logo.classList.add("active-color");
    localStorage.setItem("darkMode", "true");
}

function disableDarkMode() {
    logo.classList.remove("active-color");
    localStorage.setItem("darkMode", "false");
}


// Initial check
checkWindowSize();

// Add event listener to check window size on resize
window.addEventListener('resize', checkWindowSize);


