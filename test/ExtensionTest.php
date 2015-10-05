<?php

namespace nochso\HtmlCompressTwig\test;

use nochso\HtmlCompressTwig\Extension;

class ExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testTag()
    {
        $templates = array('test' => '{% htmlcompress %}<html> <p> x  x </p> </html>{% endhtmlcompress %}');
        $loader = new \Twig_Loader_Array($templates);
        $twig = new \Twig_Environment($loader);
        $twig->addExtension(new Extension());
        $this->assertEquals('<html><p> x x </p></html>' , $twig->render('test'));
    }

    public function testFunction()
    {
        $templates = array('test' => "{{ htmlcompress('<html> <p> x  x </p> </html>') }}");
        $loader = new \Twig_Loader_Array($templates);
        $twig = new \Twig_Environment($loader);
        $twig->addExtension(new Extension());
        $this->assertEquals('<html><p> x x </p></html>' , $twig->render('test'));
    }

    public function testFilter()
    {
        $templates = array('test' => "{{ '<html> <p> x  x </p> </html>'|htmlcompress }}");
        $loader = new \Twig_Loader_Array($templates);
        $twig = new \Twig_Environment($loader);
        $twig->addExtension(new Extension());
        $this->assertEquals('<html><p> x x </p></html>' , $twig->render('test'));
    }

}
