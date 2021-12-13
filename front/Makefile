.PHONY: help install dependencies build-dev check clean

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	dependencies \
	node_modules

dependencies:
	type yarn > /dev/null

build: \
	dist

dist:
	npx --no-install webpack --mode production

build-dev:
	npx --no-install webpack-dev-server

check:
	npx --no-install tsc -p . --noEmit

node_modules:
	yarn install --development

clean:
	rm -rf node_modules
	rm -rf dist