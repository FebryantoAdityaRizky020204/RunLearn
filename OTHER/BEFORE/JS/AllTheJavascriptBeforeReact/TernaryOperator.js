// Ternary
let age = 10
let name = age > 10 && "John"
let name2 = age > 10 ? "John" : "Doe"

export let Component = () => {
    return age > 10 ? <h1>John</h1> : <h1>Doe</h1>
}

let sameKey = true
