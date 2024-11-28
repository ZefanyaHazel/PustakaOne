document.getElementById('sidebarToggle').addEventListener('click', function () {
    var sidebar = document.getElementById('sidebar');
    var toggle = document.getElementById('sidebarToggle');
    sidebar.classList.toggle('active');
    toggle.classList.toggle('active');

})
document.getElementById('review-form').addEventListener('submit', function (event) {
    var rating = document.querySelector('input[name="rating"]:checked');
    if (!rating) {
        alert('Silakan pilih rating sebelum mengirim ulasan!');
        event.preventDefault(); // Cegah pengiriman form jika tidak ada rating
    }
});

let originalRating = document.querySelector('input[name="rating"]:checked') ? document.querySelector('input[name="rating"]:checked').value : '';
let originalReview = document.getElementById('review-text').value;

// Ambil tombol submit
const submitButton = document.getElementById('submit-button');

// Function untuk mengecek apakah ada perubahan
function checkForChanges() {
    let currentRating = document.querySelector('input[name="rating"]:checked') ? document.querySelector('input[name="rating"]:checked').value : '';
    let currentReview = document.getElementById('review-text').value;

    // Jika rating atau ulasan berubah dari nilai asli, enable button
    if (currentRating !== originalRating || currentReview !== originalReview) {
        submitButton.disabled = false;
        submitButton.classList.remove('non-aktif');
    } else {
        submitButton.disabled = true;
        submitButton.classList.add('non-aktif');
    }
}

// Event listener untuk setiap perubahan pada rating dan ulasan
document.querySelectorAll('input[name="rating"]').forEach(radio => {
    radio.addEventListener('change', checkForChanges);
});
document.getElementById('review-text').addEventListener('input', checkForChanges);

// Jalankan checkForChanges pertama kali untuk memastikan tombol submit disabled pada load
checkForChanges();