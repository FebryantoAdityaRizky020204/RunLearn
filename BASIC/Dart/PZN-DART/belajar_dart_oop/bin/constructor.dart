class Person {
  String nama = 'Aditya';
  String? alamat;
  String negara = 'Indonesia';

  // Person(this.nama, String this.alamat, this.negara);

  Person(String paramNama, String paramAlamat,
      {String paramNegara = 'Indonesia'}) {
    nama = paramNama;
    alamat = paramAlamat;
    negara = paramNegara;
  }

  void printData() {
    print("Halo nama saya $nama, alamat saya $alamat, negara saya $negara");
  }
}

void main() {
  var person1 = Person('Aditya', 'Jl. Satu Dua');
  person1.printData();
}
