<?php

/*
 * This file is part of nochso/html-compress-twig.
 *
 * @copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
 * @license   https://github.com/nochso/html-compress-twig/blob/master/LICENSE ISC
 * @link      https://github.com/nochso/html-compress-twig
 */

namespace nochso\HtmlCompressTwig;


use WyriHaximus\HtmlCompress\Factory;
use Twig\Extension\AbstractExtension;
use Twig\Environment;
use Twig\TwigFunction;
use Twig\TwigFilter;

/**
 * Extension.
 *
 * @author Marcel Voigt <mv@noch.so>
 * @copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
 */
class Extension extends AbstractExtension
{
    /**
     * @var array
     */
    private $options = array(
        'is_safe' => array('html'),
        'needs_environment' => true,
    );
    /**
     * @var callable
     */
    private $callable;
    /**
     * @var \WyriHaximus\HtmlCompress\Parser
     */
    private $parser;
    /**
     * @var bool
     */
    private $forceCompression;

    /**
     * @param bool $forceCompression Default: false. Forces compression regardless of Twig's debug setting.
     */
    public function __construct($forceCompression = false)
    {
        $this->forceCompression = $forceCompression;
        $this->parser = Factory::constructSmallest();
        $this->callable = array($this, 'compress');
    }

    public function compress(Environment $twig, $html)
    {
        if (!$twig->isDebug() || $this->forceCompression) {
            return $this->parser->compress($html);
        }
        return $html;
    }

    public function getTokenParsers()
    {
        return array(
            new MinifyHtmlTokenParser(),
        );
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('htmlcompress', $this->callable, $this->options),
        );
    }

    public function getFilters()
    {
        return array(
            new TwigFilter('htmlcompress', $this->callable, $this->options),
        );
    }
}
