import { useState } from "react";
import HeaderTitle from "./HeaderTitle";
import FormInputList from "./FormInputList";
import ListAndActions from "./ListAndActions";
import Footer from "./Footer";

let groceryItems = [
  {
    id: 1,
    name: "Kopi Buuuk",
    quantity: 2,
    checked: true,
  },
  {
    id: 2,
    name: "Gula Pasir",
    quantity: 5,
    checked: false,
  },
  {
    id: 3,
    name: "Air Mineral",
    quantity: 3,
    checked: false,
  },
];

export default function App() {

  const [items, setItems] = useState(groceryItems);

  function handleAddItem(item){
    setItems([...items, item]);
  }

  function handleDeleteItem(id) {
    setItems(items.filter((item) => item.id !== id));
  }

  function handleToggleItem(id) {
    setItems((items) => items.map((item) => item.id === id ? {...item, checked: !item.checked} : item));
  }

  function handleClearItems() {
    setItems([]);
  }

  return (
    <div className="app">
      <HeaderTitle />
      <FormInputList onAddItem={handleAddItem} />
      <ListAndActions items={items} onDeleteItem={handleDeleteItem} onToggleItem={handleToggleItem} onClearItems={handleClearItems}/>
      <Footer items={items} />
    </div>
  );
}
