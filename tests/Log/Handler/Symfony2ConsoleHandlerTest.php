<?php


namespace Log\Handler;


use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class Symfony2ConsoleHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $mockOutput;

    /** @var Symfony2ConsoleHandler */
    private $handler;

    public function setUp()
    {
        $mockFormatter = $this->getMock('Symfony\\Component\\Console\\Formatter\\OutputFormatterInterface');
        $this->mockOutput = $this->getMock('Symfony\\Component\\Console\\Output\\OutputInterface');
        $this->mockOutput->expects($this->any())->method('getFormatter')->willReturn($mockFormatter);

        $this->handler = new Symfony2ConsoleHandler($this->mockOutput);
    }

    public function testConstructorInjectOutput()
    {
        $output = $this->readAttribute($this->handler, 'output');
        $this->assertSame($this->mockOutput, $output);
    }

    public function testStyleConfiguration()
    {
        // uses nothing from the setUp function.
        $mockOutput = $this->getMock('Symfony\\Component\\Console\\Output\\OutputInterface');
        $mockFormatter = $this->getMock('Symfony\\Component\\Console\\Formatter\\OutputFormatterInterface');

        $mockOutput->expects($this->once())->method('getFormatter')->willReturn($mockFormatter);

        $expectedStyles = [
            'debug' => new OutputFormatterStyle('cyan'),
            'info' => new OutputFormatterStyle('green'),
            'notice' => new OutputFormatterStyle('blue'),
            'warning' => new OutputFormatterStyle('black', 'yellow'),
            'error' => new OutputFormatterStyle('white', 'red'),
            'critical' => new OutputFormatterStyle('white', 'red', array('underscore')),
            'alert' => new OutputFormatterStyle('red', 'yellow'),
            'emergency' => new OutputFormatterStyle('red', 'yellow', array('bold', 'blink'))
        ];

        $callNumber = 0;
        foreach ($expectedStyles as $name => $style) {
            $mockFormatter->expects($this->at($callNumber++))->method('setStyle')->with($name, $this->equalTo($style));
        }

        new Symfony2ConsoleHandler($mockOutput);
    }
}
