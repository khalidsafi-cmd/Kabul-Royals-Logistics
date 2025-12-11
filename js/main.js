(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
    
})(jQuery);



// Regex for edit-job.php & add-job.php form validation

document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");
    if (!form) return;

    form.addEventListener("submit", function (e) {

        const title = document.getElementById("title").value.trim();
        const description = document.getElementById("description").value.trim();
        const requirements = document.getElementById("requirements").value.trim();

        const titleRegex = /^[A-Za-z0-9 .,'-]{3,100}$/;
        const textRegex = /^[\s\S]{10,2000}$/;

        if (!titleRegex.test(title)) {
            alert("Job title must be 3–100 characters and contain letters and numbers only.");
            e.preventDefault();
            return false;
        }

        if (!textRegex.test(description)) {
            alert("Description must be at least 10 characters.");
            e.preventDefault();
            return false;
        }

        if (!textRegex.test(requirements)) {
            alert("Requirements must be at least 10 characters.");
            e.preventDefault();
            return false;
        }
    });
});


// Regex for contact form validation
document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contactForm");
    if (!contactForm) return;

    contactForm.addEventListener("submit", function (e) {
        // Get form field values
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const subject = document.getElementById("subject").value.trim();
        const message = document.getElementById("message").value.trim();

        // Define regex patterns
        const nameRegex = /^[A-Za-z\s]{3,50}$/;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const subjectRegex = /^[A-Za-z0-9 .,'-]{3,100}$/;
        const messageRegex = /^[\s\S]{10,1000}$/;

        // Validate Name
        if (!nameRegex.test(name)) {
            alert("Name must be 3–50 characters and contain only letters and spaces.");
            e.preventDefault();
            return false;
        }

        // Validate Email
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            e.preventDefault();
            return false;
        }

        // Validate Subject
        if (!subjectRegex.test(subject)) {
            alert("Subject must be 3–100 characters and can include letters, numbers, and punctuation.");
            e.preventDefault();
            return false;
        }

        // Validate Message
        if (!messageRegex.test(message)) {
            alert("Message must be 10–1000 characters.");
            e.preventDefault();
            return false;
        }
    });
});


// Regex for apply.php form validation
document.addEventListener("DOMContentLoaded", function () {
    const applyForm = document.querySelector("form[action*='apply.php']");
    if (!applyForm) return;

    applyForm.addEventListener("submit", function (e) {
        // Get form field values
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const resume = document.getElementById("resume").value.trim();

        // Define regex patterns
        const nameRegex = /^[A-Za-z\s]{3,50}$/;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const resumeRegex = /^[\s\S]{10,2000}$/;

        // Validate Name
        if (!nameRegex.test(name)) {
            alert("Name must be 3–50 characters and contain only letters and spaces.");
            e.preventDefault();
            return false;
        }

        // Validate Email
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            e.preventDefault();
            return false;
        }

        // Validate Resume
        if (!resumeRegex.test(resume)) {
            alert("Resume must be 10–2000 characters.");
            e.preventDefault();
            return false;
        }
    });
});