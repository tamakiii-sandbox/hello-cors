.PHONY: help install dependencies build-dev check clean

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	dependencies \
	node_modules

dependencies:
	type yarn > /dev/null

build-dev:
	npx --no-install webpack-dev-server --host 0.0.0.0 --port 8888 --disable-host-check

check:
	npx --no-install tsc -p . --noEmit

node_modules:
	yarn install --development

clean:
	rm -rf node_modules