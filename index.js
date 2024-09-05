function setActive(element) {
    var links = document.querySelectorAll('.nav-link');
    links.forEach(function(link) {
        link.classList.remove('active');
    });
    element.classList.add('active');
}

document.addEventListener('DOMContentLoaded', (event) => {
    const yearSpan = document.getElementById('currentYear');
    if (yearSpan) { // Periksa apakah elemen dengan ID 'currentYear' ada
        const currentYear = new Date().getFullYear();
        yearSpan.textContent = currentYear;
    }
});

// Mengatur AJAX form submission
$(document).ready(function() {
    $('#contact-form').on('submit', function(e) {
        e.preventDefault(); // Mencegah refresh halaman

        $.ajax({
            type: 'POST',
            url: 'send.php', // URL ke skrip PHP
            data: $(this).serialize(), // Mengirim data formulir
            success: function(response) {
                if (response.trim() === 'success') {
                    alert("Email has been sent successfully!");
                    $('#contact-form')[0].reset(); // Reset form jika email berhasil dikirim
                } else {
                    alert("Failed to send email: " + response);
                }
            },
            error: function() {
                alert("An error occurred.");
            }
        });
    });
});
