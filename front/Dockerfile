FROM node:14.1.0

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      make \
      git \
      && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/

WORKDIR /usr/local/app/hello-cors/front