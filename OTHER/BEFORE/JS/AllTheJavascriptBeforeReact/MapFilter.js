// Objects
let person = {
    name4: 'John',
    age4: 30,
    isOnHome4: true,
    sameKey // jika ada nama var yang ingin sama, tidak perlu ditulis sameKey:sameKey
}

let name3 = person.name4
let age3 = person.age4
let isOnHome3 = person.isOnHome4

let [name4, age4, isOnHome4] = person

const person2 = {...person, name: 'John'}

const cars = ["Ford", "Volvo", "BMW"]
const cars2 = [...cars, "Toyota"] // spread operator untuk menambahkan elemen baru ke array


//  .map & .filter & .reduce
let carsTest = [...cars2, "Toyota"]
carsTest.map((car) => {
    console.log(car)
    return name + '1'
})

carsTest.filter((car) => {
    return car != "Toyota"
})
