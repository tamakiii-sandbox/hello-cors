import React from "react";

export default function App() {
  const list = [1, 2, 3, 4];
  return (
    <>
      <h1>Hello world</h1>
      <ul>
        {list.map(v => (<li>{v}</li>))}
      </ul>
    </>
  )
}