.PHONY: help install dependencies clean

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	dependencies \
	node_modules

dependencies:
	type yarn > /dev/null

node_modules:
	yarn install --development

clean:
	rm -rf node_modules