# Change log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## [2.0.1] - 2017-02-06
### Changed
- Allow both Twig `^1.26` and the newer Twig `^2.0`.

## [2.0.0] - 2016-12-03
### Changed
- Bumped minimum requirement for Twig from `1.12` to `1.26`

### Removed
- `Extension::NAME` and `Extension::getName()` as they are no longer required by the minimum required Twig version.

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

[Unreleased]: https://github.com/nochso/html-compress-twig/compare/2.0.1...HEAD
[2.0.1]: https://github.com/nochso/html-compress-twig/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/nochso/html-compress-twig/compare/1.0.1...2.0.0
[1.0.1]: https://github.com/nochso/html-compress-twig/compare/1.0.0...1.0.1
[1.0.0]: https://github.com/nochso/html-compress-twig/compare/0.1...1.0.0
