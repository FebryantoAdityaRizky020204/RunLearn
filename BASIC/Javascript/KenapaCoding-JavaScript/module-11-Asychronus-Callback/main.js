// ?==================== Asynchronus Javascript
// *js secara default adalah single threaded dan berjalan secara synchronus, namu dalam banyak situasi kita tidak ingin
// *-> program berhenti menunggu suatu operasi selesai, seperti ketika mengambil data dari server atau membaca file besar
// *-> untuk mengatasi ini, js menyediakan cara untuk melakukan operasi asynchronus, sehingga tugas-tugas dapat
// *-> diselesaikan di latar belakang tanpa menghentikan operasi lainnya

// *Contoh
console.log("START");
for (var i = 0; i < 1000000000; i++) {}
console.log("END"); // ini akan dijalankan setelah looping selesai, dan itu memerlukan waktu yang tidak sebentar

// *asynchronus memungkinkan js menjalankan operasi di background tanpa memblokir thread utama, ini dapat dilakukan dengan
// *-> callbacks, promises, dan async/await. ketika operasi asynchronus dilakukan, js dapat mengeksekusi operasi lain terlebih
// *-> dahulu, dan setelah operasi asynchrous selesai, js akan menangani hasil dari operasi tersebut

// *Contoh
console.log("Start");
setTimeout(() => {
    console.log("Ini kode asynchronous");
}, 2000);
console.log("End");
// *pada contoh diatas, sekalipun setTimeout akan memerlukan waktu 2 detik untuk menjalankan kode didalamnya
// * console.log("End") akan tetap dijalankan tanpa perlu menunggu setTimeout selesai dijalankan

/**
 * *setTimeout dan setInterval adalah dua fungsi yang dapat melakukan asynchronous di js, meskipun keduanya berguna pada
 * *-> case sederhana, pada aplikasi yang kompleks penggunaan Promises dan Async/Await lebih disarankan untuk menangani operasi
 * *-> asynchronous dengan cara yang lebih terstruktur dan mudah dibaca
 * *->
 */

// ?==================== Contoh Asynchronous Callback
function getUserData(callback) {
    console.log("Fetching user data....");
    // Simulasi get data server 2 detik
    setTimeout(() => {
        const userData = {
            id: 1,
            nama: "Adit",
            umur: 21,
        };
        // setelah data diperoleh panggil callback
        callback(null, userData);
    }, 2000);
}

function displayUserData(error, data) {
    if (error) {
        console.log("Error fetching user data: ", error);
    } else {
        console.log("User data:", data);
    }
}

getUserData(displayUserData);

// ?==================== Callback Hell
// * callback hell terjadi ketika kita memiliki banyak operasi asynchronous yang bergantung satu sama lain, sehingga callback
// *-> dipanggil berulang kali di dalam callback sebelumnya, ini sering kali membuat kode menjadi sulit dibaca dan dipelihara,
// *-> karena indentasi yang terus bertambah, contohnya:
// *-> misalkan kita memiliki beberapa operasi berurutan:
// *-> 1. mengambil data pengguna
// *-> 2. mengambil postingan pengguna berdasarkan data pengguna
// *-> 3. mengambil komentar pada postingan tersebut

// *Contoh Callback Hell
function getUser(userId, callback) {
    setTimeout(() => {
        console.log("Fetching user...");
        callback(null, { id: userId, name: "John Doe" });
    }, 1000);
}

function getUserPosts(userId, callback) {
    setTimeout(() => {
        console.log(`Fetching posts for user ${userId}`);
        callback(null, [
            { id: 101, title: "Post 1" },
            { id: 102, title: "Post 2" },
        ]);
    }, 1000);
}

function getPostComments(postId, callback) {
    setTimeout(() => {
        console.log(`Fetching comments for post ${postId}`);
        callback(null, [
            { id: 1, comment: "Great post!" },
            { id: 2, comment: "Thanks for sharing!" },
        ]);
    }, 1000);
}

getUser(1, (userError, user) => {
    if (userError) {
        console.log("Error fetching user: ", userError);
    } else {
        console.log("User: ", user);

        // MEngambil postingan pengguna
        getUserPosts(user.id, (postError, posts) => {
            if (postError) {
                console.log("Error fetching posts: ", postError);
            } else {
                console.log("Posts: ", posts);

                // Mengambil komentar dari posting pertama
                getPostComments(posts[0].id, (commentsError, comments) => {
                    if (commentsError) {
                        console.log("Error fetching comments: ", commentsError);
                    } else {
                        console.log("Comments for posts: ", comments);
                    }
                });
            }
        });
    }
});

/**
 * * Masalah Callback Hell
 * *   #Indentasi Berulang
 * *    [1] setiap callback berada di dalam callback sebelumnya, menyebabkan banyaknya indentasi, sehingga kode tampak berantakan.
 * *   #Sulit dibaca dan dipelihara
 * *    [1] jika terdapat lebih banyak operasi yang bergantung satu sama lain, maka tingkat kedalaman callback akan semakin
 * *    -> dalam dan semakin sulit
 */

/**
 * * Mengatasi Callback Hell
 * *   #Promises
 * *    [1] kita dapat mengganti callback dengan Promise untuk membuat kode lebih bersih dan lebih mudah
 * *   #Async/Await
 * *    [1] pengguna async dan await memberikan cara yang lebih linear untuk menangani operasi asynnchronous dan membuat kode
 * *    -> ebih mudah dibaca seperti kode yang berjalan secara sinkron
 */

// ?====================
// ?====================
// ?====================
// ?====================
