<?php


namespace Log\Formatter;


class Symfony2ConsoleFormatterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Symfony2ConsoleFormatter */
    private $formatter;

    public function setUp()
    {
        $this->formatter = new Symfony2ConsoleFormatter();
    }

    public function testFormatShouldTemplateOutputWithLevelTag()
    {
        $record = [
            'message' => 'bagel',
            'level_name' => 'CRITICAL'
        ];

        $expected = "<critical>bagel</critical>";

        $actual = $this->formatter->format($record);

        $this->assertEquals($expected, $actual);
    }

    public function testFormatBatchDelegatesToFormatSeparatingWithPHPEOL()
    {
        $records = [
            [
                'message' => 'bagel',
                'level_name' => 'CRITICAL'
            ],
            [
                'message' => 'foo',
                'level_name' => 'ERROR'
            ]
        ];

        $expected = "<critical>bagel</critical>" . PHP_EOL;
        $expected .= "<error>foo</error>" . PHP_EOL;

        $actual = $this->formatter->formatBatch($records);

        $this->assertEquals($expected, $actual);
    }
}
