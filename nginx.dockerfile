FROM nginx:1.17.9

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx/api.conf /etc/nginx/conf.d/api.conf

WORKDIR /usr/local/app/hello-cors