// ? ========================= ES6 Classes
// *dengan ES6 JavaScript memperkenalkan sintaks class yang lebih mudah dipahami dan digunakan

class Mobil {
    constructor(merk, model, tahun){
        this.merk = merk
        this.model = model
        this.tahun = tahun
    }

    start(){
        console.log(`${this.merk} dimulai`);
    }

    info(){
        console.log(`Mobil ${this.merk} ${this.model}, Tahun: ${this.tahun}`);
    }
}

let mobil1 = new Mobil("Toyota", "Avanza", 2026)
let mobil2 = new Mobil("Honda", "Civic", 2028)

mobil1.start()
mobil2.info()

// ? ========================= Inheritance dengan class
// *inheritance memungkinkan anda membuat class baru yang mewarisi properti dan method dari class lain
class Hewan {
    constructor(nama, jenis){
        this.nama = nama
        this.jenis = jenis
    }

    makan() {
        console.log(`${this.nama} sedang makan.`);
    }
}

class Kucing extends Hewan {
    constructor(nama, warna){
        super(nama, "Kucing") // untuk class Hewan (nama, jenis) {disini jenis spesifik `Kucing`}
        this.warna = warna
    }

    bersuara(){
        console.log("Meongg~");
    }
}

let kucing = new Kucing("Kitty", "Putih")
kucing.makan()
kucing.bersuara()

// ? ========================= Encapsulation
// *adalah konsep membatasi akses ke properti dan method objek, js menimplementasikan ini dengan penggunaan simbol underscroe (_)
// *-> atau menggunakan closures

class BankAccount {
    #anotherBalance
    constructor(owner, balance){
        this.owner = owner
        this._balance = balance
        this.#anotherBalance = balance // ?ini private
    }

    deposit(amount){
        this._balance += amount
        console.log(`Deposit: ${amount}`);
    }
    // *penggunaan _balance mengindikasikan properti itu pribadi, walaupun masih bisa diakses,
    // *-> js tidak mendukung encapsulation private secara ketat di ES6

    // *solusinya dapat menggunakan private fields ES2022, lihat #... diatas 

    withdraw(amount){
        if(amount > this._balance){
            console.log("Saldo tidak mencukupi");
        } else {
            this._balance -= amount
            console.log(`Withdraw: ${amount}`);
        }
    }

    getBalance(){
        console.log(`Saldo: ${this._balance}`);
    }
}


let akun1 = new BankAccount("John Doe", 1000000000)
akun1.deposit(500000000)
akun1.withdraw(100000000)
akun1.getBalance()





// ? ========================= Polymorphism
// *ini memungkinkan anda untuk menggunakan method dengan nama yang sama pada objek yang berbeda (method overriding)

class Hewan {
    bersuara(){
        console.log("Hewan Bersuara!!");
    }
}

class Kucing extends Hewan {
    // @override
    bersuara(){
        console.log("Meong");
    }
}

class Anjing extends Hewan {
    // @override
    bersuara(){ 
        console.log("Guk guk!!");
    }
}


let hewan5 = new Hewan()
let kucing5 = new Kucing()
let anjing5 = new Anjing()


hewan5.bersuara()
kucing5.bersuara()
anjing5.bersuara()


// ? ========================= Abstraction (Abstraksi)
// *abstraksi adalah proses menyembunyikan detail implementasi dari pengguna dan hanya menampilkan esensi atau fitur utama.
// *-> ini dilakukan dengan menggunakan abstract atau interface (tidak didukung sepenuhnya di js, tapi bisa disimulasikan)

// ?class shape adalah abstraksi yang tidak dapat diinstansiasi secara langsung
class Shape {
    constructor(name){
        if(this.constructor == Shape){
            throw new Error("Cannot instantiate abstract class")
        }
        this.name = name
    }

    calculateArea(){
        throw new Error("Abstract method must be implemented")
    }
}

class Rectangle extends Shape {
    constructor(width, height){
        super("Rectangle")
        this.width = width
        this.height = height
    }

    // *subclass ini harus mengimplementasikan method calculateArea
    calculateArea(){
        return this.width * this.height
    }
}


let myRectangle1 = new Rectangle(10,20)
console.log(myRectangle1.calculateArea()); //? output: 200




// ? ========================= 
// ? ========================= 