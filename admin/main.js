document.getElementById('sidebarToggle').addEventListener('click', function () {
    var sidebar = document.getElementById('sidebar');
    var toggle = document.getElementById('sidebarToggle');
    sidebar.classList.toggle('active');
    toggle.classList.toggle('active');

})

function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('preview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

const input = document.getElementById('dropdownInput');
const dropdownList = document.getElementById('dropdownList');
const items = dropdownList.getElementsByClassName('dropdown-item');
const errorMessage = document.getElementById('error-message');

// Menampilkan dropdown saat input diklik
input.addEventListener('click', () => {
    dropdownList.classList.add('active');
});

// Menyembunyikan dropdown saat klik di luar
document.addEventListener('click', (e) => {
    if (!e.target.closest('.dropdown-container')) {
        dropdownList.classList.remove('active');
    }
});

// Pencarian dalam dropdown
input.addEventListener('input', () => {
    const filter = input.value.toUpperCase();
    for (let item of items) {
        const text = item.textContent || item.innerText;
        item.style.display = text.toUpperCase().includes(filter) ? '' : 'none';
    }
});

// Pilih opsi dari dropdown
for (let item of items) {
    item.addEventListener('click', () => {
        const id = item.getAttribute('data-value'); // Ambil id dari data-value
        const text = item.textContent; // Ambil teks dari opsi
        input.value = text; // Tampilkan teks pada input
        input.setAttribute('data-value', id); // Simpan id sebagai atribut tambahan
        dropdownList.classList.remove('active'); // Sembunyikan dropdown
        errorMessage.style.display = 'none'; // Sembunyikan pesan error setelah memilih opsi
    });
}

document.getElementById('book_form').addEventListener('submit', (e) => {
    const id = input.getAttribute('data-value'); // Ambil id dari data-value
    
    if (!id) {
        e.preventDefault(); // Batalkan pengiriman form jika tidak ada id yang dipilih
        errorMessage.style.display = 'block'; // Tampilkan pesan error
    } else {
        errorMessage.style.display = 'none'; // Sembunyikan pesan error jika id ada
        input.value = id; // Ganti nilai input dengan id sebelum dikirim
    }
});