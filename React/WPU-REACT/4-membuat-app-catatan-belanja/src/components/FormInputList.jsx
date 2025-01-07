import { useState } from "react";

// eslint-disable-next-line react/prop-types
export default function FormInputList({ onAddItem }) {
  const quantityNum = [...Array(15)].map((_, index) => (
    <option value={index + 1} key={index + 1}>
      {index + 1}
    </option>
  ));

  const [name, setName] = useState("");
  const [quantity, setQuantity] = useState(1);

  function handleSubmit(e) {
    e.preventDefault();
    if (!name) return;

    const newItem = { name, quantity, checked: false, id: Date.now() };
    onAddItem(newItem);

    setName("");
    setQuantity(1);
  }

  return (
    <form className="add-form" onSubmit={handleSubmit}>
      <h3> Hari ini belanja apa kita ? </h3>
      <div>
        <select
          value={quantity}
          onChange={(e) => setQuantity(Number(e.target.value))}
        >
          {quantityNum}
        </select>
        <input
          type="text"
          placeholder="nama barang..."
          value={name}
          onChange={(e) => setName(e.target.value)}
        />
        <button>Tambah</button>
      </div>
    </form>
  );
}
