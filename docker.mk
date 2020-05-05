.PHONY: help install dependencies clean

ENVIRONMENT := production-pseudo
NGINX_PORT := 8080
NODE_PORT := 8888
NODE_HOST := node

export DOCKER_BUILDKIT := 1
export COMPOSE_DOCKER_CLI_BUILD := 1

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	.env \
	dependencies

install-dev: \
	development \
	install

dependencies:
	type docker > /dev/null
	type docker-compose > /dev/null

.env:
	echo "ENVIRONMENT=$(ENVIRONMENT)" > $@
	echo "NGINX_PORT=$(NGINX_PORT)" >> $@
	echo "NODE_PORT=$(NODE_PORT)" >> $@
	echo "NODE_HOST=$(NODE_HOST)" >> $@

build:
	docker-compose build

clean:
	rm -rf .env

.PHONY: development
development:
	$(eval ENVIRONMENT := $@)