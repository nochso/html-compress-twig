<?php

/*
 * This file is part of nochso/html-compress-twig.
 *
 * @copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
 * @license   https://github.com/nochso/html-compress-twig/blob/master/LICENSE ISC
 * @link      https://github.com/nochso/html-compress-twig
 */

namespace nochso\HtmlCompressTwig;

use Twig\TokenParser\AbstractTokenParser;
use Twig\Token;

class MinifyHtmlTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $lineNumber = $token->getLine();
        $stream = $this->parser->getStream();
        $stream->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideHtmlCompressEnd'), true);
        $stream->expect(Token::BLOCK_END_TYPE);
        $nodes = array('body' => $body);
        return new MinifyHtmlNode($nodes, array(), $lineNumber, $this->getTag());
    }

    public function getTag()
    {
        return 'htmlcompress';
    }

    public function decideHtmlCompressEnd(Token $token)
    {
        return $token->test('endhtmlcompress');
    }
}
