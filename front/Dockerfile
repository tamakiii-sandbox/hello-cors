FROM node:14.1.0 AS production-pseudo-base

WORKDIR /usr/local/app/hello-cors/front

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      make \
      git \
      && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/

ENTRYPOINT ["make", "build"]

FROM production-pseudo-base AS production-pseudo

COPY . /usr/local/app/hello-cors/front

# --

FROM production-pseudo-base AS development

ENTRYPOINT ["make", "build-dev"]

COPY . /usr/local/app/hello-cors/front