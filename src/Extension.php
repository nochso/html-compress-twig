<?php

namespace nochso\HtmlCompressTwig;

class Extension extends \Twig_Extension
{
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
        return array(new MinifyHtmlTokenParser());
    }
}
