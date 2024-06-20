document.addEventListener('DOMContentLoaded', function() {
    var scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    }

    // Smooth scroll to top when the button is clicked
    scrollToTopBtn.addEventListener('click', function() {
        scrollToTop();
    });

    function scrollToTop() {
        if (window.scrollY !== 0) {
            // Scroll to the top of the document smoothly
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            // Fallback for Safari
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    }
});
