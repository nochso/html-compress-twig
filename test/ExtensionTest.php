<?php

/*
 * This file is part of nochso/html-compress-twig.
 *
 * @copyright Copyright (c) 2015 Marcel Voigt <mv@noch.so>
 * @license   https://github.com/nochso/html-compress-twig/blob/master/LICENSE ISC
 * @link      https://github.com/nochso/html-compress-twig
 */

namespace nochso\HtmlCompressTwig\test;

use nochso\HtmlCompressTwig\Extension;

class ExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider htmlProvider
     *
     * @param $method
     * @param string $input
     * @param string $expected
     */
    public function testExtensionMethod($method, $input, $expected)
    {
        $template = str_replace('%s', $input, $method);
        $loader = new \Twig_Loader_Array(array('test' => $template));
        $twig = new \Twig_Environment($loader);
        $twig->addExtension(new Extension());
        $this->assertEquals($expected, $twig->render('test'));
    }

    public function htmlProvider()
    {
        return array(
            'Twig tag' => array(
                '{% htmlcompress %}%s{% endhtmlcompress %}',
                '<html> <p> x  x </p> </html>',
                '<html><p> x x </p></html>',
            ),
            'Twig function' => array(
                "{{ htmlcompress('%s') }}",
                '<html> <p> x  x </p> </html>',
                '<html><p> x x </p></html>',
            ),
            'Twig filter' => array(
                "{{ '%s'|htmlcompress }}",
                '<html> <p> x  x </p> </html>',
                '<html><p> x x </p></html>',
            ),
        );
    }

    /**
     * @dataProvider htmlProvider
     */
    public function testNoCompressionWhenDebug($method, $input, $expected)
    {
        $template = str_replace('%s', $input, $method);
        $loader = new \Twig_Loader_Array(array('test' => $template));
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new Extension());
        // Assert that input equals output
        $this->assertEquals($input, $twig->render('test'));
    }

    /**
     * @dataProvider htmlProvider
     */
    public function testForceCompressionWhenDebug($method, $input, $expected)
    {
        $template = str_replace('%s', $input, $method);
        $loader = new \Twig_Loader_Array(array('test' => $template));
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new Extension(true));
        // Assert that compression took place
        $this->assertEquals($expected, $twig->render('test'));
    }
}
