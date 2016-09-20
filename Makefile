test: install
	php --version
	vendor/bin/peridot --version
	vendor/bin/peridot

coverage: install
	php --version
	vendor/bin/peridot --version
	phpdbg -qrr vendor/bin/peridot specs -r html-code-coverage --code-coverage-path "coverage"

ci-coverage: install
	php --version
	vendor/bin/peridot --version
	phpdbg -qrr vendor/bin/peridot specs -r clover-code-coverage --code-coverage-path "coverage/clover.xml"
	vendor/bin/peridot specs

install: vendor/autoload.php

docs: install
	vendor/bin/apigen generate

.PHONY: test coverage ci-coverage install

vendor/autoload.php: composer.lock
	composer install

composer.lock: composer.json
	composer update
