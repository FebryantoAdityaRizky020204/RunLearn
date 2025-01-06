void main(List<String>? args) {
  /**
   * ? Main Function
   * * main function adalah func yg digunakan sebagai gerbang masuk dart
   * * -> yang akan dijalankan pertama kali oleh dart
   */

  /**
   * ? Main Function Parameter
   * * main function memiliki parameter optional, yaitu sebuah arguments,
   * * -> datanya dalam bentuk List<String>
   * * data list string tersebut diambil secara otomatis ketika kita menjalankan file dart
   * * -> menggunakan perintah 
   * * => dart nama_file.dart args1 args2
   * * => dart nama_file.dart "Argumen 1" "Argumen 2"
   * 
   */

  for (var a in args!) {
    print('args: $a');
  }

  // NOTE - command: dart "f:\RunLearn\Dart\PZN-DART\belajar_dart_dasar\bin\main_function.dart" "halo" "semua"
}
