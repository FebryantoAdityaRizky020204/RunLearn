// ?==================== Async/Await

/**
 * *Async/Await adalah sintaks modern untuk menangani operasi asynchronous secara lebih sederhana dan terlihat seperti kode
 * *-> synchronous, namun tetap asynchronous
 *
 * *-> Async, digunakan untuk mendeklarasikan fungsi agar dapat menggunakan await
 * *-> Await, digunakan untuk menunggu penyelesaian sebuah Promise, dan kode akan berhenti sejenak hingga Promise selesai
 */

function getData() {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve("Data fetched");
        }, 2000);
    });
}

async function fetchData() {
    console.log("Fetching data.....");
    const data = await getData();
    console.log(data);
}

fetchData();

// ?====================
// ?====================
