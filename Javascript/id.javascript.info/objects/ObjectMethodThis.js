// ? OBJECT METHOD THIS


// NOTE - Method Examples
let user = {
    nama: 'Aditya',
    age: 20
}

user.sayHi = () => console.log('Hallo');
user.sayHi(); // console: Hallo

let user2 = {
    nama: 'Rizky',
    age: 20,
    sayHi() { // atau sayHi: function() {}, sama saja
        console.log('Hallo');
    }
}

// NOTE - "this" pada method

let user3 = {
    nama: 'Febryanto',
    age: 20,
    sayHi() {
        console.log(`Hallo ${this.nama}`);
    },
    sayHi2() {
        console.log(`Hallo ${user3.nama}`); // sama saja seperti ini, bisa juga, disini this = user3
    }
}

/**
 * * tetapi user3.nama akan dapat error, jika kita membuat variabel baru yang mereference ke 
 * * -> objek tersebut, misalnya 
 * * [let admin = user3]
 * * [user3 = null]
 * 
 * * [admin.sayHi2()] akan error karena user3.nama sudah tidak ada, 
 * * -> untuk amannya (lebih baik) gunakan saja this
 */

// NOTE - arrow functions tidak memiliki this

/**
 * * perlu diketahui, this tidak berfungsi sama jika di arrow function [() => {}]
 * * this pada arrow function, akan mereferensi kan objek di atas parent arrow functionnya
 */

let user4 = {
    nama: 'Aditya Rizky Febryanto',
    age: 20,
    sayHi() {
        let arrow = () => this.firstname
        console.log(arrow()); // ! this tidak merujuk ke sayHi, tetapi ke user4;
    }
}
