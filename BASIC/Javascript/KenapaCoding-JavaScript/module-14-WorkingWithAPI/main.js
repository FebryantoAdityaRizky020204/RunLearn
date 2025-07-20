// ?==================== Working with API

/**
 * *API (Application Programming Interface) memungkinkan pengembang untuk mengakses data atau layanan dari aplikasi lain tanpa
 * *-> perlu memahami bagaimana aplikasi tersebut bekerja didalamnya. API menyediakan cara untuk melakukan hal" ini:
 *  *# mengambil data dari server
 *  *# mengirim data ke server
 *  *# mengautentikasi pengguna
 *  *# mengakses layanan pihak ketiga (misalnya Google Maps, OpenWeather, dsb)
 * *
 *  *#
 * *->
 */

/**
 * * API
 * * # REST API (Representational State Transfer) : API berbasis HTTP yang digunakan untuk berkomunikasi antar klien dan server
 * * # JSON (Javascript Object Notation): Format data yang sering digunakan dalam komunikasi API
 * *
 */

/**
 * * API biasanya bekerja melalui HTTP dengan beberapa metode standar, yaitu:
 * * # GET: Mengambil data dari server
 * * # POST: mengirim data baru ke server
 * * # PUT: mengganti atau memperbarui data di server
 * * # DELETE: menghapus data dari server
 * *
 */

/**
 * * HTTP Status Code
 * * setiap kali kita mengirimkan permintaan HTTP, kita akan menerima kode status sebagai respon, seperti
 * * # 200 OK: permintaan berhasil
 * * # 201 Created: sumber daya berhasil diinput
 * * # 400 Bad Request: Permintaan tidak valid
 * * # 404 Not Found: ssumber daya tidak ditemukan
 * * # 500 Internal Server Error: Server mengalami kesalahan
 * *
 */

// ?==================== Fetch untuk GET Data
// *fetch() adalah cara modern dan lebih sederhana untuk mengirim permintaan HTTP ke server dan bekerja dengan API.
// *-> fetch() adalah promise-based, sehingga lebih mudah dikelola

fetch("https://jsonplaceholder.typicode.com/posts/1")
    .then((response) => {
        if (!response.ok) {
            throw new Error("Network response was not ok!");
        }
        return response.json();
    })
    .then((data) => {
        console.log("Data fetched: ", data);
    })
    .catch((error) => {
        console.log(error);
    });

console.log("Halo");

// ?==================== Fetch untuk POST Data
const postData = {
    title: "New Post",
    body: "This is a new post.",
    userId: 1,
};

fetch("https://jsonplaceholder.typicode.com/posts", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
    },
    body: JSON.stringify(postData),
})
    .then((response) => response.json())
    .then((data) => console.log("Data posted: ", data))
    .catch((error) => {
        console.log(error);
    });

// ?==================== Menggunakan Async/Await dengan Fetch
// *dengan async/await, kode kita menjadi lebih mudah dibaca dan ditulis, terutama saat menangani operasi asynchronous

async function getPost() {
    try {
        const response = await fetch(
            "https://jsonplaceholder.typicode.com/posts/1"
        );
        if (!response.ok) {
            throw new Error("Network was not ok!");
        }
        const data = await response.json();
        console.log("Data Fetched using async/await: ", data);
    } catch (error) {
        console.log("Error fetching data: ", error);
    }
}

getPost();

// ?==================== Menggunakan Library seperti Axios
// *axios adalah library js yang mempermudah kerja dengan API karena lebih singkat dan mendukung fitur seperti transformasi
// *-> request/response otomatis dan pembatalan request. instalasi Axios (menggunakan npm atau cdn)

axios
    .get("https://jsonplaceholder.typicode.com/posts/1")
    .then((response) => {
        console.log("data fetchde with axios: ", response.data);
    })
    .catch((error) => {
        console.log("Error: ", error);
    });

async function getData() {
    try {
        const response = await axios.get(
            "https://jsonplaceholder.typicode.com/posts/1"
        );
        console.log("Data: ", response.data);
    } catch (error) {
        console.log("Error: ", error);
    }
}

getData();
// ?====================
