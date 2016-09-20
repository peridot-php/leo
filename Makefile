test: install
	php --version
	vendor/bin/peridot --version
	vendor/bin/peridot

coverage: install
	php --version
	vendor/bin/peridot --version
	phpdbg -qrr vendor/bin/peridot -r html-code-coverage --code-coverage-path "coverage"

ci-coverage: install
	php --version
	vendor/bin/peridot --version
	phpdbg -qrr vendor/bin/peridot -r clover-code-coverage --code-coverage-path "coverage/clover.xml"
	vendor/bin/peridot

hhvm-test: install
	scripts/hhvm vendor/bin/peridot

lint: install
	vendor/bin/php-cs-fixer fix

install: vendor/autoload.php

docs: install
	vendor/bin/apigen generate

.PHONY: test coverage ci-coverage hhvm-test lint install

vendor/autoload.php: composer.lock
	composer install

composer.lock: composer.json
	composer update
