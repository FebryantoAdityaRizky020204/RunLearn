// ?======================== Function di TS
/**
 * *fungsi dalam ts bisa didefinisikan dengan tipe data pada parameter dan nilai kembali (return value), berikut contohnya
 * *
 * *->
 */

function greet(nama: string) : string {
    return "Hello " + nama
}
console.log(greet("Aditya"));


// *Parameter Opsional
/**
 * *anda dapat mendefinisikan parameter oprional dengan menambahkan tanda tanya setelah nama parameter
 */
function greet2(nama: string, umur?: number): string{
    if(umur) {
        return `Halo nama saya ${nama}, umur saya ${umur} tahun`
    }
    return `Halo nama saya ${nama}`
}

console.log(greet2("Rizky"));
console.log(greet2("Aditya", 21));


// *Parameter Default
function greet3(nama: string = "Guest", umur?: number): string{
    if(umur) {
        return `Halo nama saya ${nama}, umur saya ${umur} tahun`
    }
    return "Halo " + nama
}

console.log(greet3());
console.log(greet3(undefined, 26));

// ?======================== Void dan Never
// *void, tipe return void digunakan ketika fungsi tidak mengembalikan nilai
function logMessage(mesage: string) : void {
    console.log(mesage);
}

// *Never, digunakan untuk fungsi yang tidak pernah kembali atau berakhir, seperti fungsi yang melempar error atau infinity loop
function throwError(message: string): never{
    throw new Error(message)
}


// ?======================== Arrow Function
let multiply = (x: number, y: number): number => x * y
console.log("Multiply: ", multiply(2,2));

// ?======================== Overloading Function
/**
 * *overloading memungkinkan kita mendefinisikan beberapa fungsi dengan nama yang sama tetapi tipe parameter yang berbeda,
 * *-> dalam ts kita bisamencapai ini dengan mendefinisikan beberapa signature fungsi
 */

/**
 * *misalnya kita ingin membuat fungsi yang dapat menambah dua angka atau menggabungkan dua string
 * *-> 
 */
function combine(a: number, b: number): number;
function combine(a: string, b: string): string;
function combine(a: any, b: any){
    if(typeof a === "number" && typeof b === "number"){
        return a + b
    } 
    if(typeof a === "string" && typeof b === "string"){
        return a + b
    }
}
console.log(combine(1,2));
console.log(combine("halo ", "semua"));


// ?======================== Fungsi callback dengan Type Safety
/**
 * *callback adalah fungsi yang dilewatkan sebagai argumen ke fungsi lain dan dipanggil pada waktu tertentu, dengan ts, kita bisa
 * *-> menambahkan type safety pada callback untuk memastikan bahwa tipe data yang digunakan sesuai dengan yang diharapkan
 * *
 * *-> 
 */

/**
 * *dalam contoh berikut, ita memiliki fungsi processData yang menerima callback untuk memproses data:
 * *->
 */
function processData(data: number[], callback: (item: number) => void): void {
    data.forEach(callback)
}

processData([1,2,3,4], (item: number)=> {
    console.log(item * 2);
})

//* dengan menambahkan tipe data pada params callback, kita memastikan func callback menerima nilai bertipe number
