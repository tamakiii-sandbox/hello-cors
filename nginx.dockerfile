FROM nginx:1.17.9

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /usr/local/app/hello-cors