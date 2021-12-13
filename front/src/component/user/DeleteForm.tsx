import React, { useState, useEffect, useCallback } from "react";
import { FormEvent } from 'react';
import { User, IncompleteUser, DeleteResponse }  from "../../api/user";

interface Error {
  message: string;
}

interface Props {
  remove: (user: User) => Promise<DeleteResponse>;
  users: User[];
}

export default function DeleteForm(props: Props) {
  const [errors, setErrors] = useState<Error[]>([]);
  const [user, setUser] = useState<User>(props.users[0]);
  const [loading, setLoading] = useState<boolean>(false);

  const fetch = async (user: User, props: Props) => {
    console.log(user);
    setLoading(true);
    const response = await props.remove(user);

    if (response.ok) {
      // setUser(emptyUser);
    } else {
      errors.push({message: "Failed to create user"});
    }

    setErrors(errors);
    setLoading(false);
  }

  return (
		<form onSubmit={(event) => {
      event.preventDefault();
      loading === false && fetch(user, props)
    }}>
      {errors.length !== 0 && (
        <ul>
          {errors.map((v, k) => (
            <li key={k}>{v.message}</li>
          ))}
        </ul>
      )}
			<select onChange={(event) => {
        const user = props.users.find(user => user.id === parseInt(event.currentTarget.value))
        user && setUser(user)
      }}>
        <option></option>
        {props.users.map(user => (
          <option key={user.id} value={user.id}>{user.name}(id: {user.id})</option>
        ))}
			</select>
			<input type="submit" value="delete" />
		</form>
  );
}
