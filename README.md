![Leo logo][logo-image]

[logo-image]: https://raw.github.com/peridot-php/leo/master/leo.png "Leo logo"

# Leo

Next level assertion library for PHP

[![Current version image][version-image]][current version]
[![Current build status image][build-image]][current build status]
[![Current Scrutinizer code quality image][scrutinizer-image]][current scrutinizer code quality]
[![Current coverage status image][coverage-image]][current coverage status]

[build-image]: https://img.shields.io/travis/peridot-php/leo/master.svg?style=flat-square "Current build status for the master branch"
[coverage-image]: https://img.shields.io/codecov/c/github/peridot-php/leo/master.svg?style=flat-square "Current test coverage for the master branch"
[current build status]: https://travis-ci.org/peridot-php/leo
[current coverage status]: https://codecov.io/github/peridot-php/leo
[current scrutinizer code quality]: https://scrutinizer-ci.com/g/peridot-php/leo/?branch=master
[current version]: https://packagist.org/packages/peridot-php/leo
[scrutinizer-image]: https://img.shields.io/scrutinizer/g/peridot-php/leo/master.svg?style=flat-square "Current Scrutinizer code quality for the master branch"
[version-image]: https://img.shields.io/packagist/v/peridot-php/leo.svg?style=flat-square "This project uses semantic versioning"

Visit the main site and documentation at [peridot-php.github.io/leo/](http://peridot-php.github.io/leo/).

## Expect Interface

Leo supports a chainable interface for writing assertions via the `expect`
function:

```php
expect($obj)->to->have->property('name');
expect($value)->to->be->ok
expect($fn)->to->throw('InvalidArgumentException', 'Expected message');
expect($array)->to->be->an('array');
expect($result)->to->not->be->empty;
```

## Assert Interface

Leo supports a more object oriented, non-chainable interface via `Assert`:

```php
use Peridot\Leo\Interfaces\Assert;

$assert = new Assert();
$assert->ok(true);
$assert->doesNotThrow($fn, 'Exception');
$assert->isResource(tmpfile());
$assert->notEqual($actual, $expected);
```

## Detailed error messages

Leo matchers generate detailed error messages for failed assertions:

![Leo messages][error-message-image]

[error-message-image]: https://raw.github.com/peridot-php/leo/master/message.png "Leo messages"

## Plugins

Leo can be easily customized. For an example see [LeoHttpFoundation]. Read more
on the [plugin guide].

[leohttpfoundation]: https://github.com/peridot-php/leo-http-foundation
[plugin guide]: http://peridot-php.github.io/leo/plugins.html

## Running Tests

    make test

## Generating Docs

Documentation is generated via [ApiGen]. Simply run:

    make docs

[apigen]: http://apigen.org/

## Thanks

Leo was inspired by several great projects:

- [Chai] for JS
- [Jasmine] for JS
- [Espérance] for PHP
- [Pho] for PHP

And of course our work on [Peridot] gave incentive to make a useful complement.

[chai]: http://chaijs.com/
[espérance]: https://github.com/esperance/esperance
[jasmine]: http://jasmine.github.io/
[peridot]: http://peridot-php.github.io/
[pho]: https://github.com/danielstjules/pho
