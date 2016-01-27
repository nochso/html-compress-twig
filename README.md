# nochso/html-compress-twig extension

[![Latest Stable Version](https://poser.pugx.org/nochso/html-compress-twig/v/stable)](https://packagist.org/packages/nochso/html-compress-twig)
[![License](https://poser.pugx.org/nochso/html-compress-twig/license)](LICENSE)
[![Build Status](https://travis-ci.org/nochso/html-compress-twig.svg?branch=master)](https://travis-ci.org/nochso/html-compress-twig)

A [Twig](http://twig.sensiolabs.org/) extension for [WyriHaximus/HtmlCompress](https://github.com/WyriHaximus/HtmlCompress).

Currently supported Twig features are:

* Tag
    * `{% htmlcompress %} ... {% endhtmlcompress %}`
* Function
    * `{{ htmlcompress('some html') }}`
* Filter
    * `{{ content|markdown|htmlcompress }}`

Any HTML, inline CSS and Javascript will be compressed.

* [Installation](#installation)
* [Usage](#usage)
* [History](#history)
* [License](#license)

## Installation

1. Install and use [composer](https://getcomposer.org/doc/00-intro.md) in your project.
2. Require this package via composer:

    ```sh
    composer require nochso/html-compress-twig
    ```

## Usage

First register the extension with Twig:

```php
$twig = new Twig_Environment($loader);
$twig->addExtension(new \nochso\HtmlCompressTwig\Extension());
```

Then use it in your templates:

```
{% htmlcompress %}{% endhtmlcompress %}
{{ htmlcompress('<ul> <li>') }}
{{ '<ul> <li>'|htmlcompress }}
```

**Compression is disabled by Twig's `debug` setting.** This is to make development easier, however you can always
override it.

The constructor of this extension takes a boolean parameter `$forceCompression`. When true, this will force compression
 regardless of Twig's `debug` setting. It defaults to false when omitted.

```php
// Enable compression regardless of Twig's debug setting
$twig->addExtension(new \nochso\HtmlCompressTwig\Extension(true));
```

## History
See [CHANGELOG](CHANGELOG.md) for the full history of changes.

## License
This project is licensed under the ISC license which is MIT/GPL compatible and FSF/OSI approved:

```
Copyright (c) 2015, Marcel Voigt <mv@noch.so>

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
```
