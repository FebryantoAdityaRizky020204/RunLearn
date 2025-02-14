class Orange {
  int q = 0;

  Orange operator +(Orange other) {
    var result = Orange();
    result.q = q + other.q;
    return result;
  }
}

void main() {
  var orange1 = Orange();
  orange1.q = 10;

  var orange2 = Orange();
  orange2.q = 20;

  // langsung gunakan + saja
  var orange3 = orange1 + orange2;
  print(orange3.q);
}
