import React, { useState, useEffect, useCallback } from "react";
import { FormEvent } from 'react';
import { User, IncompleteUser, CreateResponse }  from "../../api/user";

interface Error {
  message: string;
}

interface Props {
  create: (user: IncompleteUser) => Promise<CreateResponse>;
}

const emptyUser: IncompleteUser = {
  name: ''
};

const check = (user: IncompleteUser) => {
  const errors = [];

  if (user.name === undefined) {
    errors.push({
      message: "name can't be empty"
    })
  }
  if (user.name.length < 4) {
    errors.push({
      message: "name must be longer than 4 chars"
    })
  }

  return errors;
}

export default function CreateForm(props: Props) {
  const [errors, setErrors] = useState<Error[]>([]);
  const [user, setUser] = useState<IncompleteUser>(emptyUser);
  const [loading, setLoading] = useState<boolean>(false);

  const fetch = async (user: IncompleteUser, props: Props) => {
    const errors = check(user);

    if (errors.length > 0) {
      setErrors(errors);
      return false;
    }

    setLoading(true);
    const response = await props.create(user);

    if (response.ok) {
      setUser(emptyUser);
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
			<div>
				<label htmlFor="name">name</label>
				<input type="text" name="name" value={user.name} onChange={e => setUser({...user, name: e.currentTarget.value})} />
			</div>
			<input type="submit" value="create" />
		</form>
  );
}
