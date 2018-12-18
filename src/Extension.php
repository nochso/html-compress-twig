<?php

/*
 * This file is part of nochso/html-compress-twig.
 *
 * @copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
 * @license   https://github.com/nochso/html-compress-twig/blob/master/LICENSE ISC
 * @link      https://github.com/nochso/html-compress-twig
 */

namespace nochso\HtmlCompressTwig;

use Twig_Environment;
use WyriHaximus\HtmlCompress\Factory;

/**
 * Extension.
 *
 * @author Marcel Voigt <mv@noch.so>
 * @copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
 */
class Extension extends \Twig_Extension
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
     * @param string $mode Compression mode defaults to smallest
     */
    public function __construct($forceCompression = false, $mode = 'smallest')
    {
        $this->forceCompression = $forceCompression;

        switch ($mode) {
        case 'smallest':
            $this->parser = Factory::constructSmallest();
            break;

        case 'fastest':
            $this->parser = Factory::constructFastest();
            break;

        case 'standard':
        default:
            $this->parser = Factory::construct();
        }

        $this->callable = array($this, 'compress');
    }

    public function compress(Twig_Environment $twig, $html)
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
            new \Twig_SimpleFunction('htmlcompress', $this->callable, $this->options),
        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('htmlcompress', $this->callable, $this->options),
        );
    }
}
