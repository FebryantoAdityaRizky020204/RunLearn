// ignore_for_file: prefer_collection_literals

void main() {
  /**
   * NOTE Map
   * ? tipe data key-value, key mirip index, value adalah datanya
   * ? sekilas mirip List, tetapi index list sudah diatur berupa int secara increment
   * ? -> sedangkan Map, keynya ditentukan secara manual dalam tipedata apapun
   * ? jika memasukan dengan key yang sudah ada, secara otomatis value yang lama akan diganti
   * 
   * Map<TipeKey, TipeValue> namaMap = {};
   * var namaMap = Map<TipeKey, TipeValue>();
   * var alamat = <TipeKey, TipeValue>{};
   */

  Map<String, String> person1 = {};
  var person2 = Map<String, String>();
  var person3 = <String, String>{};

  print(person1);
  print(person2);
  print(person3);

  /**
   * NOTE - Manipulasi MAp
   * * map.length -> get panjang map
   * * map[key] -> mendapatkan data map
   * * map[key] = value -> menambahkan data map
   * * map.remove(key) -> menghapus data map
   */

  person1['nama'] = 'Aditya Rizky Febryanto';
  person1['usia'] = '20';
  print(person1);

  person2['nama'] = person1['nama']!;
  print(person2);

  person1.remove('usia');
  print(person1);

  var orang = {
    'nama': 'Aditya Rizky Febryanto',
    'usia': 20,
  };

  print(orang);
}
