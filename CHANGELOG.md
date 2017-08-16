# Leo changelog

## 1.6.1 (2017-08-17)

- **[FIXED]** Support for PHP 7.2 ([#28] - thanks [@tomdxw]).

[#28]: https://github.com/peridot-php/leo/pull/28
[@tomdxw]:  https://github.com/tomdxw

## 1.6.0 (2016-09-21)

- **[NEW]** Support for PHP 7 engine exceptions in `ExceptionMatcher`
  ([#19] - thanks [@jmalloc]).
- **[NEW]** Support for traversables in `InclusionMatcher` ([#23]).
- **[FIXED]** Using both arguments of `throw()` no longer ignores the exception
  type ([#20], [#24]).
- **[MAINTENANCE]** Simplified exception stack trace trimming ([#22]).

[#19]: https://github.com/peridot-php/leo/pull/19
[#20]: https://github.com/peridot-php/leo/issues/20
[#22]: https://github.com/peridot-php/leo/pull/22
[#23]: https://github.com/peridot-php/leo/pull/23
[#24]: https://github.com/peridot-php/leo/pull/24
[@jmalloc]: https://github.com/jmalloc
