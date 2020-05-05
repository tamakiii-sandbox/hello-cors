.PHONY: help install dependencies dumpautoload clean

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	dependencies \
	vendor

dependencies:
	type php > /dev/null
	type composer > /dev/null

vendor:
	composer install

dumpautoload:
	composer $@

clean:
	rm -rf vendor