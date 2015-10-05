<?php

namespace nochso\HtmlCompressTwig\test;

use nochso\HtmlCompressTwig\Extension;

class ExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider htmlProvider
     *
     * @param string $input
     * @param string $expected
     */
    public function testExtension($input, $expected)
    {
        $loader = new \Twig_Loader_Array(array('test' => $input));
        $twig = new \Twig_Environment($loader);
        $twig->addExtension(new Extension());
        $this->assertEquals($expected, $twig->render('test'));
    }

    public function htmlProvider()
    {
        return array(
            'Twig tag' => array(
                '{% htmlcompress %}<html> <p> x  x </p> </html>{% endhtmlcompress %}',
                '<html><p> x x </p></html>',
            ),
            'Twig function' => array(
                "{{ htmlcompress('<html> <p> x  x </p> </html>') }}",
                '<html><p> x x </p></html>',
            ),
            'Twig filter' => array(
                "{{ '<html> <p> x  x </p> </html>'|htmlcompress }}",
                '<html><p> x x </p></html>',
            ),
        );
    }

    public function testNoCompressionWhenDebug()
    {
        $loader = new \Twig_Loader_Array(array('test' => "{{ '<ul> <ol>'|htmlcompress }}"));
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new Extension());
        $this->assertEquals('<ul> <ol>', $twig->render('test'));
    }

    public function testForceCompressionWhenDebug()
    {
        $loader = new \Twig_Loader_Array(array('test' => "{{ '<ul> <ol>'|htmlcompress }}"));
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new Extension(true));
        $this->assertEquals('<ul><ol>', $twig->render('test'));
    }
}
