<?php


namespace Log\Formatter;


use Monolog\Formatter\FormatterInterface;

class Symfony2ConsoleFormatter implements FormatterInterface
{
    /**
     * Formats a log record.
     *
     * @param  array $record A record to format
     * @return mixed The formatted record
     */
    public function format(array $record)
    {
        return $this->template($record);
    }

    private function template(array $record)
    {
        $levelName = strtolower($record['level_name']);
        $message = $record['message'];
        return "<$levelName>$message</$levelName>";
    }

    /**
     * Formats a set of log records.
     *
     * @param  array $records A set of records to format
     * @return mixed The formatted set of records
     */
    public function formatBatch(array $records)
    {
        $message = '';
        foreach ($records as $record) {
            $message .= $this->format($record) . PHP_EOL;
        }

        return $message;
    }
}
