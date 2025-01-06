// ignore_for_file: prefer_function_declarations_over_variables

void main() {
  /**
   * ? Anonymous Function
   * * kebanyakan function memiliki nama,
   * * tetapi bisa juga membuat function tanpa nama, pembuatanya mirip seperti function biasa
   * * -> hanya saja tidak perlu memberikan nama function
   * * anonymous function biasanya digunakan ketika memanggil function yang memerlukan
   * * -> parameter berupa function
   */

  var upperFunction = (String name) {
    return name.toUpperCase();
  };

  var lowerFunction = (String name) => name.toLowerCase();

  print('upper: ${upperFunction('Aditya Rizky Febryanto')}');
  print('lower: ${lowerFunction('Aditya Rizky Febryanto')}');

// ? anonymous function sebagai params
  sayHello('Aditya Rizky', (nama) {
    return nama.toUpperCase();
  });
  sayHello('Aditya Rizky', (nama) => nama.toLowerCase());
}

void sayHello(String nama, String Function(String) filter) {
  var filteredName = filter(nama);
  print('Hi $filteredName');
}
