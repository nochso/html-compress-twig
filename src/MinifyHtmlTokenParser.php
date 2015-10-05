<?php

/*
 * This file is part of nochso/html-compress-twig.
 *
 * @copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
 * @license   https://github.com/nochso/html-compress-twig/blob/master/LICENSE ISC
 * @link      https://github.com/nochso/html-compress-twig
 */

namespace nochso\HtmlCompressTwig;

use Twig_Token;
use Twig_TokenParser;

class MinifyHtmlTokenParser extends Twig_TokenParser
{
    public function parse(Twig_Token $token)
    {
        $lineNumber = $token->getLine();
        $stream = $this->parser->getStream();
        $stream->expect(Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideHtmlCompressEnd'), true);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);
        $nodes = array('body' => $body);
        return new MinifyHtmlNode($nodes, array(), $lineNumber, $this->getTag());
    }

    public function getTag()
    {
        return 'htmlcompress';
    }

    public function decideHtmlCompressEnd(Twig_Token $token)
    {
        return $token->test('endhtmlcompress');
    }
}
