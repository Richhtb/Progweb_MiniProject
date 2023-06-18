function validateForm() {
    var tglMulai = document.getElementById("tgl_mulai").value;
    var tglSelesai = document.getElementById("tgl_selesai").value;
    var fileInput = document.getElementById("gambar");
    var file = fileInput.files[0];
    var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/i;
    var maxSize = 1 * 1024 * 1024; 

    if (tglMulai === tglSelesai) {
        alert("Tanggal Mulai dan Tanggal Selesai tidak boleh sama.");
        return false;
    } else if (tglMulai >= tglSelesai) {
        alert("Tanggal Mulai harus lebih awal dari Tanggal Selesai.");
        return false;
    } else if (!allowedExtensions.test(file.name)) {
        alert("File hanya boleh dalam format JPG, PNG, atau JPEG.");
        return false;
    } else if (file.size > maxSize) {
        alert("Ukuran file gambar terlalu besar. Maksimum 1 MB diperbolehkan.");
        return false;
    }

    return true;
}

function setSuccessMessage() {
    var pesan = document.getElementById("textmessage");
    pesan.innerHTML = "Berhasil diupdate";
    pesan.style.backgroundColor = "#6fd649";
    pesan.style.color = "white";
    pesan.style.padding = "10px";
    pesan.style.borderRadius = "5px";  
    pesan.style.textAlign="center"; 
    pesan.style.width="500px";
    pesan.style.margin="auto";
    pesan.style.marginTop = "10px";
    pesan.style.marginBottom = "10px";
}

function setErrorMessage() {
    var pesan = document.getElementById("textmessage");
    pesan.innerHTML = "Gagal update data";
    pesan.style.backgroundColor = "red";
    pesan.style.color = "white";
    pesan.style.padding = "10px";
    pesan.style.borderRadius = "5px";
    pesan.style.textAlign="center";
}


