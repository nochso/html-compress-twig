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
     */
    public function testExtensionMethod($template, $original, $compressed)
    {
        $loader = new \Twig_Loader_Array(array('test' => $template));
        $twig = new \Twig_Environment($loader);
        $twig->addExtension(new Extension());
        $this->assertEquals($compressed, $twig->render('test'));
    }

    public function htmlProvider()
    {
        $original = '<html> <p> x  x </p> </html>';
        $compressed = '<html><p> x x </p></html>';

        $testData = [];
        $testMethods = [
            'Twig tag' => '{% htmlcompress %}%s{% endhtmlcompress %}',
            'Twig function' => "{{ htmlcompress('%s') }}",
            'Twig filter' => "{{ '%s'|htmlcompress }}",
        ];

        foreach ($testMethods as $testMethod => $testTemplate) {
            $testData[$testMethod] = [
                str_replace('%s', $original, $testTemplate),
                $original,
                $compressed,
            ];
        }
        return $testData;
    }

    /**
     * @dataProvider htmlProvider
     */
    public function testNoCompressionWhenDebug($template, $original, $compressed)
    {
        $loader = new \Twig_Loader_Array(array('test' => $template));
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new Extension());

        // Assert no compression took place
        $this->assertEquals($original, $twig->render('test'));
    }

    /**
     * @dataProvider htmlProvider
     */
    public function testForceCompressionWhenDebug($template, $original, $compressed)
    {
        $loader = new \Twig_Loader_Array(array('test' => $template));
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new Extension(true));

        // Assert that compression took place
        $this->assertEquals($compressed, $twig->render('test'));
    }
}
