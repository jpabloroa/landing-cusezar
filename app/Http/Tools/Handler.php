<?php

namespace App\Http\Tools;

class Handler
{
    private $log_path = __DIR__ . '/../../../storage/logs/';
    private $log_type_output;
    private $log_syntax;
    private $server_log_file;
    private $error_log_file;

    /**
     * @param string $log_type_output
     * @param array $log_syntax
     * @param string $server_log_file
     * @param string $error_log_file
     */
    public function __construct(
        string $log_type_output = 'file',
        array  $log_syntax = [
            'message_header' => '\[D j/M/Y \- G:i:s \- e\] ',
            'server_header' => ': ',
            'error_header' => ' - New Error: '
        ],
        string $server_log_file = 'server.log',
        string $error_log_file = 'error.log'
    )
    {
        $this->log_type_output = $log_type_output;
        $this->log_syntax = $log_syntax;
        $this->server_log_file = $this->log_path . $server_log_file;
        $this->error_log_file = $this->log_path . $error_log_file;
    }

    /**
     * @param $message
     * @return void
     */
    public function log($message = null)
    {
        $composedMessage =
            date($this->log_syntax['message_header']) . config('app.name') . ' to ' . $_SERVER['REMOTE_ADDR']
            . $this->log_syntax['server_header'] . $message;
        $path = $this->log_path . $this->server_log_file;

        switch ($this->log_type_output) {
            case 'email':
                error_log($composedMessage, 1, $path);
                break;
            case 'file':
                error_log($composedMessage . PHP_EOL, 3, $path);
                break;
            default:
                error_log($composedMessage, 0, $path);
                break;
        }

    }

    public function error($message = null)
    {
        $composedMessage =
            date($this->log_syntax['message_header']) . config('app.name') . ' to ' . $_SERVER['REMOTE_ADDR']
            . $this->log_syntax['error_header'] . $message;
        $path = $this->log_path . $this->error_log_file;

        switch ($this->log_type_output) {
            case 'email':
                error_log($composedMessage, 1, $path);
                break;
            case 'file':
                error_log($composedMessage . PHP_EOL, 3, $path);
                break;
            default:
                error_log($composedMessage, 0, $path);
                break;
        }
    }
}
