FROM node:14.1.0

WORKDIR /usr/local/app/hello-cors/front

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      make \
      git \
      && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/

ENTRYPOINT ["make", "build-dev"]