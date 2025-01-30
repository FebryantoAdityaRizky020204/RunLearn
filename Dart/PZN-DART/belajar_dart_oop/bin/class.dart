class Person {
  String nama = 'Aditya';
  String? guest;
  final String negara = 'Indonesia';

  void sayHello(String params) {
    print("Hallo $params, Nama saya $nama");
  }

  String getNama() {
    return nama;
  }

  // ? Method Expression Body : tidak perlu return
  void doSomething() => print('Ini adalah Method Expression Body');
  String getSomeText() => "someText";
  void makeLine() => print("==============================");
}

// ? Extension Method
extension OtherFunction on Person {
  void runExtension() {
    print('ini dijalankan di extension otherFunction');
  }
}

void main() {
  Person person1 = Person();

  print(person1.nama);
  person1.nama = 'Rizky';

  print(person1.nama);
  person1.makeLine();

  person1.makeLine();
  var person2 = Person();
  print(person2);
  person2.sayHello("Ren");
  person2.doSomething();

  person2.makeLine();
  person2.runExtension();
}
