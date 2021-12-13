
export interface IncompleteUser {
  name: string;
}
export interface User {
  id: number;
  name: string;
}

export interface Response<T> {
  ok: boolean;
  body: T;
}

export type CreateResponse = Response<{users: User[]}>

export const create = async (user: IncompleteUser): Promise<CreateResponse> => {
  const url = new URL('http://api.localhost:8080/user/create');
  console.log(url);
  const response = await fetch(url.toString(), {
    method: "POST",
    mode: "cors",
    credentials: "same-origin",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json",
    },
    body: JSON.stringify(user),
  });

  if (!response.ok) {
    const body = await response.json();
    return {ok: false, body};
  } else {
    const body = await response.json();
    return {ok: true, body};
  }
}

export type DeleteResponse = Response<{users: User[]}>;

export const remove = async (user: User) : Promise<DeleteResponse> => {
  const url = new URL('http://api.localhost:8080/user/delete');
  console.log(url);
  const response = await fetch(url.toString(), {
    method: "DELETE",
    mode: "cors",
    credentials: "same-origin",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json",
    },
    body: JSON.stringify(user),
  });

  if (!response.ok) {
    const body = await response.json();
    return {ok: false, body};
  } else {
    const body = await response.json();
    return {ok: true, body};
  }
}