import React, { useState, useEffect } from "react";
import CreateForm from "./component/user/CreateForm";
import DeleteForm from "./component/user/DeleteForm";
import * as api from "./api/user";

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
  console.log(users.map);

  return (
    <>
      <h1>Hello users</h1>
      {users.length === 0 ? (
        <strong>Loading...</strong>
      ) : (
        <ul>
          {Array.from(users, (v, k) => (<li key={k}>{v.name}(id: {v.id})</li>))}
        </ul>
      )}
      <hr />
      <h2>Create new User</h2>
      <CreateForm create={api.create} />
      <hr />
      <h2>Delete User</h2>
      <DeleteForm remove={api.remove} users={users} />
    </>
  )
}