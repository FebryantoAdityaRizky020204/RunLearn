/**
 * ? Destructuring Assignment
 * 
 * ? Dua stuktur data yang paling banyak digunakan di Javascript adalah Object dan Array
 * ? Objek memungkinkan kita untuk membuat entitas tunggal yang menyimpan data item berdasarkan kunci, dan array memungkinkan 
 * ? -> kita untuk mengumpulkan data item menjadi koleksi yang terurut.
 * 
 * ? Tetapi ketika kita meneruskannya ke suatu fungsi, itu mungkin tidak perlu objek / array secara keseluruhan, melainkan 
 * ? -> potongan individual.
 * 
 * ? Destructuring assignment adalah sebuah sintaks spesial yang memungkinkan kita untuk “membongkar” array atau objek 
 * ? -> menjadi variabel yang banyak, kadang-kadang itu memang lebih nyaman. Destrukturisasi juga berfungsi baik dengan fungsi-fungsi kompleks yang mempunyai banyak parameter, nilai default, dan sebagainya.
 */


/**
 * ? Destrukturisasi Array
 */

let arr1 = ["John", "Smith"]
let [firstName, lastName] = arr1
console.log(firstName, lastName); // * John Smith

let [otherFirstName, otherLastName] = "John Smith".split(' ')
console.log(otherFirstName);
console.log(otherLastName);

// ? Hindari elemen dengan koma
// * elemen kedua tidak dibutuhkan
let [first, , title] = ["Julius", "Caesar", "Consul", "of the Roman Republic"];

console.log( title ); // ? Consul
/**
 * ? Pada kode diatas, elemen kedua dari array dilewati, yang ketiga ditetapkan untuk title, dan sisa item array 
 * ? -> juga dilewati (karena tidak ada variabel untuknya).
 */

// ? Trik Menukar Variable
let tamu = "Aditya";
let tamu2 = "Rizky";

[tamu2, tamu] = [tamu, tamu2] // ? value bertukar

// ? materi terlalu kompleks, baca lagi di [https://id.javascript.info/destructuring-assignment#destrukturisasi-array]


let [satu, dua, ...sisanya] = ["teks satu", "teks dua", "teks tiga", "teks empat", "teks lima", "teks enam"]
console.log(satu); // * teks satu
console.log(dua); // * teks dua
console.log(sisanya); // * [ 'teks tiga', 'teks empat', 'teks lima', 'teks enam' ]

// ? nilai default untuk destruktur array kosong adalah undefined
let [arraySatu, arrayDua] = [] // * arraySatu = undefined, arrayDua = undefined

// ? atau bisa diberikan nilai default
let [arrayTiga, arrayEmpat = 'Coba'] = ['arrTiga'] // * arrayTiga = 'arrTiga', arrayEmpat = 'Coba'



// TODO - DESTRUKTURISASI OBJEK

let options = {
    title2: "Menu",
    width: 100,
    height: 200
}

let {title2, width, height} = options
console.log(title2); // * Menu
console.log(width); // * 100
console.log(height); // * 200

// ? juga bisa menukar urutan, selama nama key var destrukturisasinya sama key objeknya
let options2 = {
    title3: "Menu",
    width2: 100,
    height2: 200
}
let { width2, height2, title3 } = options2 // ? kalau pakai options1 akan undefined, karena key berbeda

console.log(width2); // * 100
console.log(height2); // * 200
console.log(title3); // * Menu

// ? atau juga bisa seperti ini
let { width2: w, height2: h, title3: t } = options2
// * width2 disimpan di var w
// * height2 disimpan di var h
// * title3 disimpan di var t

// ? juga bisa menggunakan nilai default
let { width5 = 900, height2:h2 = 700 } = options2
console.log(width5); // * 900, karena tidak ada wdith5, jadi menggunakan nilai defautl
console.log(h2); // * 200, karena berdasarkan nilai height2

// ? ...sisanya
let { title3: t4, ...rest } = options2
console.log(rest); // * { width2: 100, height2: 200 }

// ? cara lain tanpa let kemudian langsung destrukturisasi
let nama, umur;
// ! {nama, umur} = {nama: 'Aditya', umur: 20} , akan error, [https://id.javascript.info/destructuring-assignment#destrukturisasi-objek]
({ nama, umur } = { nama: 'Aditya', umur: 20 }) // ? aman
console.log(nama); // * Aditya
console.log(umur); // * 20

// TODO - Destrukturisasi Bersarang
// ? agak rumit, baca disini [https://id.javascript.info/destructuring-assignment#destrukturisasi-bersarang]

let options3 = {
  size: {
    width7: 100,
    height7: 200
  },
  items: ["Cake", "Donut"],
  extra: true
};

// tugas dekstukturisasi dibagi dalam beberapa baris untuk kejelasan
let {
  size: { // letakkan ukuran di sini
    width7,
    height7
  },
  items: [item1, item2], // tetapkan item di sini
  title7 = "Menu" // tidak ada dalam objek (nilai default digunakan)
} = options3;

console.log(title);  // Menu
console.log(width);  // 100
console.log(height); // 200
console.log(item1);  // Cake
console.log(item2);  // Donut

// TODO - Smart Function Parameter (Parameter Fungsi Cerdas)
// ?agak requestAnimationFrame, baca disini [https://id.javascript.info/destructuring-assignment#parameter-fungsi-cerdas]

let options10 = {
  title: "My menu",
  items: ["Item1", "Item2"]
};

function showMenu({
  title = "Untitled",
  width: w = 100,  // width menjadi w
  height: h = 200, // height menjadi h
  items: [item1, item2] // element pertama items menjadi item1, kedua menjadi item2
}) {
  console.log( `${title} ${w} ${h}` ); // * My Menu 100 200
  console.log( item1 ); // * Item1
  console.log( item2 ); // * Item2
}

showMenu(options10);

function showMenu({ title = "Menu", width = 100, height = 200 } = {}) {
  console.log( `${title} ${width} ${height}` );
}

showMenu(); // Menu 100 200