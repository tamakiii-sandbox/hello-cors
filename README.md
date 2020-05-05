# hello-cors

## How to use
```sh
make -f docker.mk install-dev
make -f docker.mk build && docker-compose up
```

## Running webpack-dev-server on host-OS
`docker-compose.override.yml`
```yml
version: "3.7"
services:
  node:
    entrypoint: "false"
```
```sh
make -f docker.mk clean install-dev NODE_HOST=host.docker.internal
make -C front build-dev
make -f docker.mk build && docker-compose up
```
```sh
docker-compose run --rm nginx cat /etc/nginx/conf.d/default.conf | grep proxy_pass
```