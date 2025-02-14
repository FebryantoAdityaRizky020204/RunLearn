void main() {
  /**
   * ? Recursive Function
   * * function yang memanggil dirinya sendiri
   */

  /**
   * ? Masalah dengan recursive
   * * walaupun recursive sangat menarik, kita harus berhati"
   * * jika recursive terlalu dalam, ada kemungkinan error StackOVerlfow, yaitu
   * * -> error dimana stack pemanggil function terlalu banyak
   * * ini terjadi karena ketika kita memanggil function, dart akan menyimpannya ke dalam stack
   * * -> jika function tersebut memanggil func lain, maka stack akan menumpuk terus, 
   * * -> dan jika terlalu dalam, dapat menyebabkan error
   */

  print(factorialLoop(5));
  print(factorialRecursive(5));
  loopError(100);
}

// ? Tanpa Recursice
int factorialLoop(int value) {
  var result = 1;
  for (var i = 1; i <= value; i++) {
    result *= i;
  }
  return result;
}

// ? Dengan Recursive
int factorialRecursive(int value) {
  if (value == 1) {
    return 1;
  } else {
    return value * factorialRecursive(value - 1);
  }
}

// ? Contoh kode dengan error stackOverflow
void loopError(int value) {
  if (value == 0) {
    print('selesai');
  } else {
    print('Loop-$value');
    loopError(value - 1);
  }
}
