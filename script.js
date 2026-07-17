document.addEventListener("DOMContentLoaded", function () {

    const counters = document.querySelectorAll(".counter");

    const observer = new IntersectionObserver(entries => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {

                const counter = entry.target;
                const target = parseInt(counter.dataset.target);

                let count = 0;

                const timer = setInterval(() => {

                    count += Math.ceil(target / 100);

                    if (count >= target) {
                        counter.innerText = target;
                        clearInterval(timer);
                    } else {
                        counter.innerText = count;
                    }

                }, 20);

                observer.unobserve(counter);

            }

        });

    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));

});

function SubmitForm() {

    let isValid = true;

    // Get Values
    let name = document.getElementById("fname").value.trim();
    let email = document.getElementById("emaildt").value.trim();
    let phone = document.getElementById("phonenum").value.trim();
    let date = document.getElementById("date").value;
    let time = document.getElementById("time").value;
    let people = document.getElementById("peonumb").value;
    let message = document.querySelector("textarea").value.trim();

    // Error Elements
    document.getElementById("nameError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("phonError").innerHTML = "";
    document.getElementById("dateError").innerHTML = "";
    document.getElementById("timeError").innerHTML = "";
    document.getElementById("penumError").innerHTML = "";
    document.getElementById("msgError").innerHTML = "";

    // Name Validation
    let namePattern = /^[A-Za-z ]+$/;
    if (name == "") {
        document.getElementById("nameError").innerHTML = "Full name is required";
        isValid = false;
    } else if (!namePattern.test(name)) {
        document.getElementById("nameError").innerHTML = "Only letters are allowed";
        isValid = false;
    }

    // Email Validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email == "") {
        document.getElementById("emailError").innerHTML = "Email is required";
        isValid = false;
    } else if (!emailPattern.test(email)) {
        document.getElementById("emailError").innerHTML = "Enter a valid email";
        isValid = false;
    }

    // Phone Validation
    let phonePattern = /^[0-9]{10}$/;
    if (phone == "") {
        document.getElementById("phonError").innerHTML = "Phone number is required";
        isValid = false;
    } else if (!phonePattern.test(phone)) {
        document.getElementById("phonError").innerHTML = "Enter a valid 10-digit number";
        isValid = false;
    }

    // Date Validation
    if (date == "") {
        document.getElementById("dateError").innerHTML = "Select a date";
        isValid = false;
    }

    // Time Validation
    if (time == "") {
        document.getElementById("timeError").innerHTML = "Select a time";
        isValid = false;
    }

    // Number of People Validation
    if (people == "") {
        document.getElementById("penumError").innerHTML = "Enter number of people";
        isValid = false;
    } else if (people < 1) {
        document.getElementById("penumError").innerHTML = "Minimum 1 person required";
        isValid = false;
    }

    // Message Validation
    if (message == "") {
        document.getElementById("msgError").innerHTML = "Message is required";
        isValid = false;
    }

    return isValid;
}

document.querySelectorAll("input, textarea").forEach(function (element) {
    element.addEventListener("input", function () {
        let error = this.parentElement.querySelector(".error");

        if (!error) {
            error = document.getElementById("msgError");
        }

        if (error) {
            error.innerHTML = "";
        }
    });
});

function Submitdata() {

    let isValid = true;

    // Input Values
    let name = document.getElementById("fulName").value.trim();
    let email = document.getElementById("emaildat").value.trim();
    let subject = document.getElementById("subject").value.trim();
    let message = document.getElementById("message").value.trim();

    // Error Elements
    document.getElementById("nameError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("subjectError").innerHTML = "";
    document.getElementById("messageError").innerHTML = "";

    // Name Validation
    let namePattern = /^[A-Za-z\s]+$/;
    if (name === "") {
        document.getElementById("nameError").innerHTML = "Full name is required";
        isValid = false;
    } else if (!namePattern.test(name)) {
        document.getElementById("nameError").innerHTML = "Only letters are allowed";
        isValid = false;
    }

    // Email Validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
        document.getElementById("emailError").innerHTML = "Email is required";
        isValid = false;
    } else if (!emailPattern.test(email)) {
        document.getElementById("emailError").innerHTML = "Enter a valid email";
        isValid = false;
    }

    // Subject Validation
    if (subject === "") {
        document.getElementById("subjectError").innerHTML = "Subject is required";
        isValid = false;
    } else if (subject.length < 3) {
        document.getElementById("subjectError").innerHTML = "Subject must be at least 3 characters";
        isValid = false;
    }

    // Message Validation
    if (message === "") {
        document.getElementById("messageError").innerHTML = "Message is required";
        isValid = false;
    } else if (message.length < 10) {
        document.getElementById("messageError").innerHTML = "Message must be at least 10 characters";
        isValid = false;
    }

    return isValid;
}

// Remove error while typing
document.querySelectorAll("#fulName, #emaildat, #subject, #message").forEach(function (input) {
    input.addEventListener("input", function () {
        let errorId = this.id + "Error";

        if (this.id === "fulName") errorId = "nameError";
        if (this.id === "emaildat") errorId = "emailError";

        document.getElementById(errorId).innerHTML = "";
    });
});


function searchMenu() {

    let input = document.getElementById("searchInput").value.toLowerCase();

    let items = document.querySelectorAll(".menu-item");

    items.forEach(function (item) {

        let title = item.querySelector("h4").innerText.toLowerCase();

        if (title.includes(input)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }

    });

}

const searchInput = document.getElementById("searchInput");

if (searchInput) {
    searchInput.addEventListener("keyup", function (e) {
        if (e.key === "Enter") {
            searchMenu();
        }
    });
}


const toggleButton = document.getElementById("theme-toggle");

if (toggleButton) {

    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
        document.documentElement.setAttribute('data-theme', 'dark');
        toggleButton.textContent = '☀️ Day Mode';
    }

    toggleButton.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        let newTheme = 'light';

        if (currentTheme !== 'dark') {
            newTheme = 'dark';
            toggleButton.textContent = '☀️ Day Mode';
        } else {
            toggleButton.textContent = '🌙 Night Mode';
        }

        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
    });

}



// Disable Right Click
document.addEventListener('contextmenu', function (event) {
    event.preventDefault();
});

// Disable F12, Ctrl+Shift+I, and Ctrl+U
document.addEventListener('keydown', function (event) {
    if (event.key === 'F12' ||
        (event.ctrlKey && event.shiftKey && event.key === 'I') ||
        (event.ctrlKey && event.key === 'U')) {
        event.preventDefault();
    }
});



const images = {
    img1: {
        original: "https://themewagon.github.io/yummy-red/assets/img/gallery/gallery-1.jpg",
        hover: "https://images.unsplash.com/photo-1592861956120-e524fc739696?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fHJlc3RhdXJhbnR8ZW58MHx8MHx8fDA%3D"
    },
    img2: {
        original: "https://themewagon.github.io/yummy-red/assets/img/gallery/gallery-2.jpg",
        hover: "https://images.unsplash.com/photo-1590846406792-0adc7f938f1d?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHJlc3RhdXJhbnR8ZW58MHx8MHx8fDA%3D"
    },
    img3: {
        original: "https://themewagon.github.io/yummy-red/assets/img/gallery/gallery-3.jpg",
        hover: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9Dzij1NEobTDQz2gKiWp4FAikbpmone5iXg&s"
    },
    img4: {
        original: "https://themewagon.github.io/yummy-red/assets/img/gallery/gallery-4.jpg",
        hover: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe3bgccezXYTdEkSVg1v_KNJywZmP_csebWQ&s"
    },
    img5: {
        original: "https://themewagon.github.io/yummy-red/assets/img/gallery/gallery-5.jpg",
        hover: "https://cdn.pixabay.com/photo/2016/02/10/13/35/hotel-1191718_1280.jpg"
    }
};

function changephoto(id) {
    document.getElementById(id).src = images[id].hover;
}

function originalphoto(id) {
    document.getElementById(id).src = images[id].original;
}


// Feedback form

function Submitdata() {
    // Clear previous error messages
    const errorSpans = document.querySelectorAll('.error');
    errorSpans.forEach(span => span.textContent = '');

    // Get form field values
    const fullName = document.getElementById('fulName').value.trim();
    const email = document.getElementById('emaildat').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();

    // Track validation status
    let isValid = true;

    // 1. Full Name Validation
    if (fullName === "") {
        document.getElementById('nameError').textContent = "Full name is required.";
        isValid = false;
    } else if (fullName.length < 3) {
        document.getElementById('nameError').textContent = "Name must be at least 3 characters long.";
        isValid = false;
    }

    // 2. Email Validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
        document.getElementById('emailError').textContent = "Email address is required.";
        isValid = false;
    } else if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = "Please enter a valid email address.";
        isValid = false;
    }

    // 3. Subject Validation
    if (subject === "") {
        document.getElementById('subjectError').textContent = "Subject is required.";
        isValid = false;
    }

    // 4. Message Validation
    if (message === "") {
        document.getElementById('messageError').textContent = "Message cannot be empty.";
        isValid = false;
    } else if (message.length < 10) {
        document.getElementById('messageError').textContent = "Message must be at least 10 characters long.";
        isValid = false;
    }

    // If isValid remains true, the form will submit to "yummywebfb.php"
    // If false, it returns false and stops the submission
    return isValid;
}



// Book a Table form

function SubmitForm() {

    let name = document.getElementById("fname").value.trim();
    let email = document.getElementById("emaildt").value.trim();
    let phone = document.getElementById("phonenum").value.trim();
    let date = document.getElementById("date").value;
    let time = document.getElementById("time").value;
    let people = document.getElementById("peonumb").value;
    let message = document.getElementById("message").value.trim();

    let isValid = true;

    document.getElementById("nameError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("phonError").innerHTML = "";
    document.getElementById("dateError").innerHTML = "";
    document.getElementById("timeError").innerHTML = "";
    document.getElementById("numError").innerHTML = "";
    document.getElementById("msgError").innerHTML = "";

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let phonePattern = /^[0-9]{10}$/;

    // Name
    if (name == "") {
        document.getElementById("nameError").innerHTML = "Please enter your full name.";
        isValid = false;
    }

    // Email
    if (email == "") {
        document.getElementById("emailError").innerHTML = "Please enter your email.";
        isValid = false;
    }

    if (!emailPattern.test(email)) {
        document.getElementById("emailError").innerHTML = "Please enter a valid email.";
        isValid = false;
    }

    // Phone
    if (phone == "") {
        document.getElementById("phonError").innerHTML = "Please enter your phone number.";
        isValid = false;
    }

    if (!phonePattern.test(phone)) {
        document.getElementById("phonError").innerHTML = "Phone number must be 10 digits.";
        isValid = false;
    }

    // Date
    if (date == "") {
        document.getElementById("dateError").innerHTML = "Please select a date.";
        isValid = false;
    }

    // Time
    if (time == "") {
        document.getElementById("timeError").innerHTML = "Please select a time.";
        isValid = false;
    }

    // People
    if (people == "" || people <= 0) {
        document.getElementById("numError").innerHTML = "Please enter number of people.";
        isValid = false;
    }

    // Message
    if (message == "") {
        document.getElementById("msgError").innerHTML = "Please enter your message.";
        isValid = false;
    }

    isValid = true;
}

AOS.init();

var swiper = new Swiper(".mySwiper", {
    loop: true,

    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    slidesPerView: 1,
    spaceBetween: 30,

    breakpoints: {
        768: {
            slidesPerView: 1
        },
        992: {
            slidesPerView: 1
        }
    }
});