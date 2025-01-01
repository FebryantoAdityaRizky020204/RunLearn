import { useState } from "react";
import Thanks from "./components/Thanks";
import ThanksDua from "./components/ThanksDua";

function App() {
  const siswa = ["Adit", "Rizky", "Febry", "Anto"];
  const [likes, setLikes] = useState(0);
  let handleClick = () => {
    setLikes(likes + 1);
  };

  return (
    <>
      <h1>
        {" "}
        Belajar React Bersama WPU, <Thanks nomor="1" />{" "}
      </h1>{" "}
      <h2>
        {" "}
        <Thanks nomor="2" />{" "}
      </h2>{" "}
      <br />
      <p>
        {" "}
        Tanpa Nomor <ThanksDua />{" "}
      </p>{" "}
      <p>
        {" "}
        Nomor angka 3 <ThanksDua nomor="3" />{" "}
      </p>
      <h4> Menampilkan data menggunakan pengulangan </h4>{" "}
      {siswa.map((ss, index) => (
        <li key={index}> {ss} </li>
      ))}
      <br />
      <h4> belajar state dan hooks </h4>{" "}
      <button onClick={handleClick}> Like({likes}) </button>{" "}
    </>
  );
}

export default App;
