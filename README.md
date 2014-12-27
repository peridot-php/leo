![Leo logo](https://raw.github.com/peridot-php/leo/master/leo.png "Leo logo")

#Leo
Next level assertion library for PHP 5.4+

[![Build Status](https://travis-ci.org/peridot-php/leo.svg?branch=master)](https://travis-ci.org/peridot-php/leo) 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/peridot-php/leo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/peridot-php/leo/?branch=master)
[![Coverage Status](https://coveralls.io/repos/peridot-php/leo/badge.png?branch=master)](https://coveralls.io/r/peridot-php/leo?branch=master)
[![HHVM Status](http://hhvm.h4cc.de/badge/peridot-php/leo.svg)](http://hhvm.h4cc.de/package/peridot-php/leo)

Visit the main site and documentation at [peridot-php.github.io/leo/](http://peridot-php.github.io/leo/).

##Expect Interface

Leo supports a chainable interface for writing assertions via the `expect` function.

```php
expect($obj)->to->have->property('name');
expect($value)->to->be->ok
expect($fn)->to->throw('InvalidArgumentException', 'Expected message');
expect($array)->to->be->an('array');
expect($result)->to->not->be->empty;
```

##Assert Interface

Leo supports a more object oriented, non-chainable interface via `Assert`.

```php
use Peridot\Leo\Interfaces\Assert;

$assert = new Assert();
$assert->ok(true);
$assert->doesNotThrow($fn, 'Exception');
$assert->isResource(tmpfile());
$assert->notEqual($actual, $expected);
```

##Detailed error messages

Leo matchers generate detailed error messages for failed assertions.

![Leo messages](https://raw.github.com/peridot-php/leo/master/message.png "Leo messages")

##Plugins

Leo can be easily customized. For an example see [LeoHttpFoundation](https://github.com/peridot-php/leo-http-foundation). Read more on the [plugin guide](https://github.com/peridot-php/leo-http-foundation).

##Running Tests

```
composer install
vendor/bin/peridot specs/
```

##Generating Docs

Documentation is generated via [apigen](http://apigen.org/).

```
apigen generate
```

##Thanks

Leo was inspired by several great projects:

* [chaijs](http://chaijs.com/) for JS
* [jasmine](http://jasmine.github.io/) for JS
* [esperance](https://github.com/esperance/esperance) for PHP
* [pho](https://github.com/danielstjules/pho) for PHP

And of course our work on [Peridot](http://peridot-php.github.io/) gave incentive to make a useful complement.
