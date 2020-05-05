FROM nginx:1.17.9

COPY ./docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx/conf.d/api.conf /etc/nginx/conf.d/api.conf
COPY ./docker/nginx/cors.conf /etc/nginx/cors.conf

WORKDIR /usr/local/app/hello-cors