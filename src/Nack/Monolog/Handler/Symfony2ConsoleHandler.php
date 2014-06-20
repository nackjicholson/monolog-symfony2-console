<?php


namespace Nack\Monolog\Handler;


use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\OutputInterface;

class Symfony2ConsoleHandler extends AbstractProcessingHandler
{
    /** @var OutputInterface */
    private $output;

    /**
     * @param OutputInterface $output
     * @param bool|int $level
     * @param bool $bubble
     */
    public function __construct(OutputInterface $output, $level = Logger::DEBUG, $bubble = true)
    {
        $this->output = $output;
        $this->configureOutputStyles();

        parent::__construct($level, $bubble);
    }

    private function configureOutputStyles()
    {
        $formatter = $this->output->getFormatter();

        $styles = [
            'debug' => new OutputFormatterStyle('cyan'),
            'info' => new OutputFormatterStyle('green'),
            'notice' => new OutputFormatterStyle('blue'),
            'warning' => new OutputFormatterStyle('black', 'yellow'),
            'error' => new OutputFormatterStyle('white', 'red'),
            'critical' => new OutputFormatterStyle('white', 'red', array('underscore')),
            'alert' => new OutputFormatterStyle('red', 'yellow'),
            'emergency' => new OutputFormatterStyle('red', 'yellow', array('bold', 'blink'))
        ];

        foreach ($styles as $name => $style) {
            $formatter->setStyle($name, $style);
        }
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     * @return void
     */
    protected function write(array $record)
    {
        $this->output->writeln($record['formatted']);
    }
}
