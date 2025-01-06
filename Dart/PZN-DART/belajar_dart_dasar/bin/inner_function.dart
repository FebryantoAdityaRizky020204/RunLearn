// ignore_for_file: slash_for_doc_comments

void main() {
  /**
   * ? inner function
   * * inner function adalah function didalam sebuah function
   * * namun perlu diperhatikan function yg dibuat di outer function, hanya bisa diakses dari 
   * * -> outer function saja, tidak bisa diluar outer function
   */

  void sayHello(String name) {
    print('Halo $name');
  }

  sayHello('Aditya');
}

// sayHello tidak bisa dipanggil disini
void contoh() {
  // sayHello('Aditya'); // ini akan error
}
