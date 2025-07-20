// ? ========================= Function
function perkalian(a,b){
    return a * b
}
console.log(perkalian(3,3));

// ? ========================= Function Expressions
// * fungsi yang disimpan di dalam variabel
let kali = function(a,b) {return a* b}
console.log(kali(2,2));

// ? ========================= Arrow Function
let kali3 = (a) => {return a *3}
console.log("kali3: ", kali3(4));

// * NOTE: jika function hanya memiliki 1 pernyataan, bisa dihilangkan kur-kurawal dan returnnya
let kali4 = (a) => a * 4;
console.log(kali4(2));


// ? ========================= IIFE (Immediatly Invoked Function Expression)
// * IIFE adalah function yang dipanggil langsung setelah dibuat, ini berguna untuk mengisolasi variabel dan mencegahnya
// *    -> mengganggu kode lain
(function(){
    console.log("IIFE Dipanggil");
})()

const appConfig = (function() {
    const apiKey = "1234"
    const apiUrl = "https://api.example.com"

    return {
        getApiKey: function(){
            return apiKey;
        },
        getApiUrl: function(){
            return apiUrl;
        }
    }
})();

console.log(appConfig.getApiKey());
console.log(appConfig.getApiUrl());



// ? ========================= High Order Function
// * fungsi yang menerima fungsi lain sebagai argumen atau mengembalikan function lain sebagai hasil

// ? ========================= Callback function
// * function yang dikirim sebagai argumen ke function lain dan dipanggil di dalam function tersebut


function manipulasiArray(arr, callback){ // *High order function, menerima function sebagai argumen
    let hasil = []
    for(let i = 0; i < arr.length; i++){
        hasil.push(callback(arr[i]))
    }
    return hasil
}

function kaliDua(x){ // *akan menjadi callback function, kerena dikirm sebagai argumen
    return x * 2;
}

let angka = [1,2,3,4,5]
let hasil = manipulasiArray(angka, kaliDua) // *kali dua dikirm sebagai argumen
console.log(hasil);

// ? ========================= Recursion
// *recursion terjadi ketika fungsi memanggil dirinya sendiri secara langsung atau tidak langusng
// *-> setiap panggilan membawa permasalahan lebih dekat ke kondisi dasar (base case) yaitu dimana recursion berhenti
/**
 * *recursion biasanya terdiri dari 2 bagian penting, yaitu:
 * *1, Base Case: bagian dari function yang mengehentikan recursion
 * *2, Recursive case: bagian dari function yang memecah masalah menjadi sub-masalah yang lbeih kecildan memanggil dirinya sendiri
 */
function faktorial(n){
    // ? Base Case
    if(n === 0){
        return 1
    }
    // ? Recursive Case
    return n * faktorial(n-1)
}
console.log(faktorial(5));


// ? ========================= 
// ? ========================= 




