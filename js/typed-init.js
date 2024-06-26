document.addEventListener('DOMContentLoaded', function() {
    fetch('fetch_typing_texts.php?home_id=1')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }
            if (Array.isArray(data.typing_texts)) {
                // Assuming you want to initialize Typed.js with the fetched texts
                new Typed('.element', {
                    strings: data.typing_texts,
                    typeSpeed: 50,
                    backSpeed: 50,
                    loop: true
                });
            } else {
                console.error("Typing texts are not in the expected format.");
            }
        })
        .catch(error => {
            console.error("Error fetching data: ", error.message);
        });
});
