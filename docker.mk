.PHONY: help install dependencies clean

NGINX_PORT := 8080
NODE_PORT := 8888

export DOCKER_BUILDKIT := 1
export COMPOSE_DOCKER_CLI_BUILD := 1

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	.env \
	dependencies

dependencies:
	type docker > /dev/null
	type docker-compose > /dev/null

.env:
	echo "NGINX_PORT=$(NGINX_PORT)" > $@
	echo "NODE_PORT=$(NODE_PORT)" >> $@

build:
	docker-compose build

clean:
	rm -rf .env