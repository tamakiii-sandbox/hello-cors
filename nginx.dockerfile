FROM nginx:1.17.9 AS production-pseudo--base

ARG NODE_HOST=node

WORKDIR /usr/local/app/hello-cors

COPY ./docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx/conf.d/api.conf /etc/nginx/conf.d/api.conf
COPY ./docker/nginx/cors.conf /etc/nginx/cors.conf

FROM production-pseudo--base AS production-pseudo

COPY . /usr/local/app/hello-cors

# --

FROM production-pseudo--base AS development

# COPY ./docker/nginx/conf.d/default.dev.conf /etc/nginx/conf.d/default.conf
RUN sed -ie "s/%NODE_HOST%/${NODE_HOST}/" /etc/nginx/conf.d/default.conf

COPY . /usr/local/app/hello-cors