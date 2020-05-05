.PHONY: help install dependencies clean

NGINX_PORT := 8080

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
	echo "NGINX_PORT=$(NGINX_PORT)"  > $@

build:
	docker-compose build

clean:
	rm -rf .env