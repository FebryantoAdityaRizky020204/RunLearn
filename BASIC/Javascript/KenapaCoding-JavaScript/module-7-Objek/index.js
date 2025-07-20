// ! Objek yang dimaksud dalam konteks OOP

// ? ========================= Objek
// *objek adalah pasangan kunci-nilai (key-value-pairs) yang dapat mewakili data dan prilaku, 

// *contoh objek sederhana
let mobil = {
    merk: "Toyota",
    model: "Avanza",
    tahun: 2021,
    start: function() {
        console.log("Mobil Dimulai");
    },
    info: function(){
        console.log(`Mobil: ${this.merk} ${this.model}, Tahun ${this.tahun}`);
    }
}

mobil.start()
mobil.info()



// ? ========================= Constructor Function 
// *cara lain membuat objek 
function Mobil(merk, model, tahun){
    this.merk = merk
    this.model = model
    this.tahun = tahun

    this.start = function(){
        console.log(`${this.merk} Dimulai`);
    }

    this.info = function(){
        console.log(`Mobil: ${this.merk} ${this.model}, Tahun ${this.tahun}`);
    }
}

let mobil1 = new Mobil("Toyota", "Avanza", 2025)
let mobil2 = new Mobil("Honda", "Civic", 2026)

mobil1.start()
mobil2.info()


// ? ========================= Konsep Prototypal Inheritance
// *objek dapat mewarisi properti dan method objek lain

function Hewan(nama, jenis){
    this.nama = nama
    this.jenis = jenis
}

Hewan.prototype.makan = function(){ // ? prototype inheritance
    console.log(`${this.nama} sedang makan.`);
}

let kucing  = new Hewan("Kitty", "Kucing")
kucing.makan()


// ? ========================= 