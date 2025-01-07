/* eslint-disable react/prop-types */
import { useState } from "react";
import Item from "./Item";

export default function ListAndActions({ items, onDeleteItem, onToggleItem, onClearItems }) {
  const [sortBy, setSortBy] = useState('input');
  let sortedItems;

  switch (sortBy) {
    case 'name':
      sortedItems = items.slice().sort((a, b) => a.name.localeCompare(b.name));
      break;
      case 'checked':
        sortedItems = items.slice().sort((a, b) => Number(a.checked) - Number(b.checked));
        break;
    case 'input':
    default:
      sortedItems = items;
      break;
  }


  return (
    <>
      <div className="list">
        <ul>
          {sortedItems.map((items) => (
            <Item item={items} key={items.id} onDeleteItem={onDeleteItem} onToggleItem={onToggleItem} />
          ))}
        </ul>
      </div>

      <div className="actions">
        <select value={sortBy} onChange={(e) => setSortBy(e.target.value)} >
          <option value="input"> Urutkan berdasarkan urutan input </option>
          <option value="name"> Urutkan berdasarkan nama barang </option>
          <option value="checked"> Urutkan berdasarkan ceklis </option>
        </select>
        <button onClick={onClearItems}> Bersihkan Daftar </button>
      </div>
    </>
  );
}