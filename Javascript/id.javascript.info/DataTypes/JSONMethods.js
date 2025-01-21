// TODO - JSON Methods, toJSON

// ? JSON Stringify
/**
 * ? JavaScript menyediakan metode-metode seperti:
 * * JSON.stringify untuk mengoversi objek menjadi JSON.
 * * JSON.parse untuk mengonversi balik JSON menjadi sebuah objek.
 */

let student = {
    nama: 'Aditya',
    age: 20,
    isAdmin: false,
    skill: ["PHP", "Javascript"]
}

let jsonStringify = JSON.stringify(student)
console.log(typeof jsonStringify); // ? String
console.log(jsonStringify)
// ? => {"nama":"Aditya","age":20,"isAdmin":false,"skill":["PHP","Javascript"]}


// ? ini agak ribet [https://id.javascript.info/json#mengecualikan-dan-mengubah-replacer]

// TODO - toJSON

/**
 * ? Seperti toString untuk konversi string, sebuah objek dapat menyediakan metode toJSON 
 * ? -> untuk konversi ke JSON. JSON.stringify secara otomatis akan memanggil metode tersebut jika tersedia.
 */

let room = {
    number: 23
};

let meetup = {
    title: "Conference",
    date: new Date(Date.UTC(2017, 0, 1)),
    room
};

console.log(JSON.stringify(meetup));

/**
 * ? Di sini kita bisa lihat bahwa date (1) menjadi sebuah string. Itu karena semua tanggal memiliki 
 * ? -> sebuah metode toJSON yang sudah built-in yang mana mengembalikan string seperti itu.
 * 
 * ? Kini mari menambahkan sebuah toJSON khusus untuk objek kita room (2):
 */

let room2 = {
    number: 23,
    toJSON() {
        return this.number
    }
}

let meetup2 = {
    title: "Conference",
    room: room2
}

console.log(JSON.stringify(meetup2));

// TODO - JSON.parse
/**
 * ? Untuk men-decode sebuah string JSON, kita memerlukan sebuah metode lain bernama JSON.parse.
 * ? Sintaksnya:
 * 
 * * let value = JSON.parse(str, [reviver]);
 */

let numbers = "[1, 2, 3]";
numbers = JSON.parse(numbers)
console.log(numbers); // ? [ 1, 2, 3 ]

// ? reviver membingungkan, baca disini [https://id.javascript.info/json#menggunakan-reviver]

let str = '{"title":"Conference","date":"2017-11-30T12:00:00.000Z"}';

let meetup3 = JSON.parse(str, function (key, value) {
    if (key == 'date') return new Date(value);
    return value;
});

console.log(meetup3); // ? { title: 'Conference', date: 2017-11-30T12:00:00.000Z }

let schedule = `{
  "meetups": [
    {"title":"Conference","date":"2017-11-30T12:00:00.000Z"},
    {"title":"Birthday","date":"2017-04-18T12:00:00.000Z"}
  ]
}`;

schedule = JSON.parse(schedule, function (key, value) {
    if (key == 'date') return new Date(value);
    return value;
});

console.log(schedule);
/**
 * * {
 * *  meetups: [
 * *   { title: 'Conference', date: 2017-11-30T12:00:00.000Z },
 * *   { title: 'Birthday', date: 2017-04-18T12:00:00.000Z }
 * *  ]
 * * }
 */