// ? ERROR HANDLING
// *error handling adalah proses menangani kesalahan dalam kode agar aplikasi tidak crash atau berhenti secara tiba tiba
// *js menyediakan beberapa cara seperti try...catch, finally, membuat error custom, serta menangani error dalam kode async

/**
 * *try...catch...finally adalah cara paling umum untuk menangani error di javascript, bagian try digunakan untuk menjalankan kode
 * *-> dan jika terjadi error catch akan menangkap error dan memungkinkan kita menanganinya, kita juga bisa menggunakan finally
 * *-> untuk menjalankan kode yang perlu dieksekusi terlepas dari error terjadi atau tidak, dan finally bersifat opsional
 */

try {
    console.log("Mencoba menjalankan kode....");
    let number = parseInt("XYZ"); // ?tidak bisa di konfersi ke angka karena string
    if (isNaN(number)) {
        throw new Error("Nilai bukan angka yang valid");
    }
} catch (error) {
    console.log(`Terjadi kesalahan: ${error.message}`);
} finally {
    // *dinalankan setelah try...catch, terlepas ada error atau tidak, ini opsional
    console.log("Blok ini akan selalu dijalankan");
}

// ?Throwing custom error
// *throw digunakan untuk membuat error custom, yang bisa ditentukan sendiri kapan harus dilempar
function divide(a, b) {
    if (b === 0) {
        // ?custom error
        throw new Error("pembagian dengan nol tidak bisa");
    }
    return a / b;
}

try {
    let result = divide(10, 0);
    console.log(result);
} catch (error) {
    console.log("Error: ", error.message);
}

// ?Beberapa jenis error di javascript, (beberapa tidak semua)
// *SyntaxError, jika ada kesalahan syntax
// *TypeError, jika menggunakan nilai atau tipedata yang tidak sesuai
// *ReferenceError, jika mencoba mengakses variabel yang belum did deklarasikan

// ?==================== Class Custom Errors
// *kita dapat membuat error sendiri dengan mendefinisikan kelas yang Mewarisi Error, ini berguna untuk embuat pesan error khusus

class CustomError extends Error {
    constructor(message) {
        super(message);
        this.name = "CustomError";
    }
}

try {
    throw new CustomError("this is a custom error");
} catch (error) {
    console.error(`${error.name}: ${error.message}`);
}
