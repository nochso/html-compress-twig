<?php

$header = <<<'TAG'
This file is part of nochso/html-compress-twig.

@copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
@license   https://github.com/nochso/html-compress-twig/blob/master/LICENSE ISC
@link      https://github.com/nochso/html-compress-twig
TAG;

$gitIgnoreLines = array_map(function ($line) {
    return rtrim($line, "\r\n\\/");
}, file('.gitignore'));

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__)
    ->exclude($gitIgnoreLines);

\Symfony\CS\Fixer\Contrib\HeaderCommentFixer::setHeader($header);
return \Symfony\CS\Config\Config::create()
    ->level(\Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers([
        '-psr0', // Does not play well with PSR-4
        'concat_with_spaces',
        '-concat_without_spaces',
        '-empty_return',
        '-phpdoc_no_empty_return',
        '-return',
        '-pre_increment',
        'header_comment',
    ])
    ->finder($finder);
