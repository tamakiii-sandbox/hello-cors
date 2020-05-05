import React, { useState, useEffect } from "react";

interface User {
  id: number;
  name: string;
}

export default function App() {
  const [users, setUsers] = useState<User[]>([]);
  useEffect(() => {
    (async() => {
      const url = new URL('http://api.localhost:8080/users');
      console.log(url);
      const response = await fetch(url.toString(), {
        method: "GET",
        mode: "cors",
        credentials: "same-origin",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json",
        }
      });

      if (!response.ok) {
        const body = await response.json();
        return {ok: false, body};
      } else {
        const body = await response.json();
        return setUsers(body.users);
      }
    })();
  }, []);

  return (
    <>
      <h1>Hello world</h1>
      {users.length === 0 ? (
        <strong>Loading...</strong>
      ) : (
        <ul>
          {users.map((v, k) => (<li key={k}>{v.name}(id: {v.id})</li>))}
        </ul>
      )}
    </>
  )
}