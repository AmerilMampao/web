document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // Smooth scroll function
    function scrollToTarget(target) {
        const element = document.querySelector(target);
        if (element) {
            window.scrollTo({
                top: element.offsetTop,
                behavior: 'smooth'
            });
        }
    }

    // Smooth scroll for navbar links
    document.querySelectorAll('.navbar a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('href');
            scrollToTarget(target);
        });
    });

    // Smooth scroll for footer links
    document.querySelectorAll('.footer a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            scrollToTarget(targetId);
        });
    });

    // Smooth scroll for "More About Me" button
    const moreAboutMeBtn = document.querySelector('.btn-box');
    if (moreAboutMeBtn) {
        moreAboutMeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('href');
            scrollToTarget(target);
        });
    }

    // Show/hide scroll-to-top button based on scroll position
    window.onscroll = function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    };

    // Scroll to top button functionality
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
