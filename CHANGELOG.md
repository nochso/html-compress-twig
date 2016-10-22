# Change log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [1.0.2] - 2016-10-22
### Deprecated
- `Extension::NAME` and `Extension::getName()` as they will be no longer need by Twig eventually.  
  Use of `getName` was replaced by `::class`

## [1.0.1] - 2016-01-27
### Changed
- Minimum Twig version bumped to 1.12

## [1.0.0] - 2016-01-14
### Added
- Add Travis integration for automated tests

### Changed
- Move phpunit from require to require-dev.
- Use *needs_environment* option instead of deprecated `Twig_Extension->initRuntime()` to access `Twig_Environment`.

### Fixed
- Fix tag not using the extension and its configuration.

## 0.1.0 - 2015-10-05
First public release.

[1.0.2]: https://github.com/nochso/html-compress-twig/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/nochso/html-compress-twig/compare/1.0.0...1.0.1
[1.0.0]: https://github.com/nochso/html-compress-twig/compare/0.1...1.0.0
