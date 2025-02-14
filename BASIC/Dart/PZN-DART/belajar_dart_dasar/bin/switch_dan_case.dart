void main() {
  /**
   * ? mirip if else, switch-case hanya digunakan dalam kondisi ==
   */
  String halo = 'halo';
  switch (halo) {
    case 'halo':
      print('mengucapkan halo');
      break;
    case 'entahlah':
      print("entahlah");
      break;
    case 'coba':
    case 'coba2':
      print('jika coba dan coba2 maka ini dirun');
      break;
    default:
      print('kurang tau');
  }
}
