<?php

namespace nochso\HtmlCompressTwig;

use Twig_Environment;
use WyriHaximus\HtmlCompress\Factory;

/**
 * Extension.
 *
 * TODO Pass parser to constructor instead
 *
 * @author Marcel Voigt <mv@noch.so>
 * @copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
 */
class Extension extends \Twig_Extension
{
    /**
     * @var array
     */
    private $safeOptions = array(
        'is_safe' => array('html'),
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
    private $debug;
    /**
     * @var bool
     */
    private $forceCompression;

    /**
     * @param bool $forceCompression Default: false. Forces compression regardless of Twig's debug setting.
     *
     */
    public function __construct($forceCompression = false)
    {
        $this->forceCompression = $forceCompression;
        $this->parser = Factory::constructSmallest();
        $this->callable = array($this, 'compress');
    }

    public function initRuntime(Twig_Environment $environment)
    {
        parent::initRuntime($environment);
        $this->debug = $environment->isDebug();
    }

    public function compress($html)
    {
        if (!$this->debug || $this->forceCompression) {
            return $this->parser->compress($html);
        }
        return $html;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'HtmlCompressTwig';
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
            new \Twig_SimpleFunction('htmlcompress', $this->callable, $this->safeOptions),
        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('htmlcompress', $this->callable, $this->safeOptions),
        );
    }
}
