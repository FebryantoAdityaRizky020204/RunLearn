"use strict";
// ?======================== Struktur Control di TS
/**
 * *struktur kontrol (control flow) di javascript dan typescript sama karena typescript pada dasarnya adalah superset dari
 * *-> javascript, ini berarti bahwa semua fitur dan sintaks javascript dapat digunakan dalam typescript tanpa perubahan,
 * *-> struktur kontrol seperti if-else, switch, for, while, do-while, dan try-catch diimplementasikan dengan cara yang identik
 * *-> di kedua bahasa.
 * *
 * *->
 */
let age = 18;
if (age >= 18) {
    console.log("you're an adult");
}
else {
    console.log("you are'nt an adult");
}
let day = "Senin";
switch (day) {
    case "Senin":
        console.log("ini hari senin");
        break;
    case "Selasa":
        console.log("ini hari Selasa");
        break;
    default:
        console.log("Entahlah");
}
for (let i = 0; i < 5; i++) {
    console.log("n: ", i);
}
let count1 = 0;
while (count1 < 5) {
    console.log("count1: ", count1);
    count1++;
}
try {
    throw new Error("nggak bisa");
}
catch (error) {
    console.log("Error: ", error.message);
}
// ?========================
// ?========================
