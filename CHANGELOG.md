# Leo changelog

## Next release

- **[FIXED]** Using both arguments of `throw()` no longer ignores the exception
  type ([#20], [#24]).
- **[IMPROVED]** Support for PHP 7 engine exceptions in `ExceptionMatcher`
  ([#19] - thanks [@jmalloc]).
- **[IMPROVED]** Simplified exception stack trace trimming ([#22]).
- **[IMPROVED]** Support for traversables in `InclusionMatcher` ([#23]).

[#19]: https://github.com/peridot-php/leo/pull/19
[#20]: https://github.com/peridot-php/leo/issues/20
[#22]: https://github.com/peridot-php/leo/pull/22
[#23]: https://github.com/peridot-php/leo/pull/23
[#24]: https://github.com/peridot-php/leo/pull/24
[@jmalloc]: https://github.com/jmalloc
