import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import HelloWorld from "./HelloWorld.jsx";

createRoot(document.getElementById("root")).render(
    <StrictMode>
        <HelloWorld />
    </StrictMode>
);

// LINK : http://localhost:5173/hello-world.html