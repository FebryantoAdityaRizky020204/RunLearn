// ?==================== Promises
/**
 * *promises adalah cara untuk menangani operasi asynchronous secara lebih bersih daripada callback, promise adalah objek
 * *-> yang mewakili keberhasilan atau kegagalan suatu operasi asynchronous
 *
 * *#States of promises
 * *1. Pending: promise sedang berjalan
 * *2. Fullfilled: Promise berhasil diselesaikan
 * *3. Rejected: Promise mengalami kegagalan
 */

/** @format */

// ?Contoh membuat promises
function checkStock(product) {
    return new Promise((resolve, reject) => {
        console.log(`Checking stock for ${product}`);

        // simulasi waktu untuk mengecek stock (misalnya 2 detik)
        setTimeout(() => {
            const stockAvailable = true; // ganti menjadi false untuk melihat hasil reject
            if (stockAvailable) {
                resolve(`${product} is available in stock`);
            } else {
                reject(`${product} is out of stock`);
            }
        }, 2000);
    });
}

// *Memanggil fungsi checkstock
checkStock("Laptop")
    .then((message) => {
        console.log(message);
    })
    .catch((error) => {
        console.log(error);
    });

// ?====================
// ?====================
// ?====================
// ?====================
// ?====================
