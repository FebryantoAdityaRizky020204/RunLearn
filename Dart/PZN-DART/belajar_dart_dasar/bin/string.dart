void main() {
  // String, tipe data untuk menyimpan teks
  String firstName = 'Aditya';
  String lastName = 'Rizky Febryanto';
  // ignore: prefer_interpolation_to_compose_strings
  print(firstName + ' ' + lastName);

  // menggunakan interpolation
  print('$firstName $lastName');

  String fullName = '$firstName $lastName';
  print(fullName);

  // karakter backslash
  // untuk menekankan bahwa karakter yang digunakan benar,
  // contohnya jika kita benar ingin menggunakan $ tadi, gunakan \$ agar tidak ddianggap interpolation
  print('ini dijalankan dalam bahasa \'dart\'');
  print('menggabungkan ' 'string');

  var gabung = 'menggabungkan ' 'string';
  print(gabung);

  String anotherFullName = firstName + lastName;
  print(anotherFullName);

  // Multiline String
  var longString = '''
ini
adalah
multiline
string
    ''';
  print(longString);
}
