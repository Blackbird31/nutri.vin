<?php

namespace app\exporters\utils;

class rsvgconvert
{
    const command = 'rsvg-convert';
    protected $hasRSVGConvert = false;

    public function __construct()
    {
        $this->hasRSVGConvert = $this->check();
    }

    private function check()
    {
        $process = proc_open("command -v ".self::command, [
            0 => ["pipe", "r"], //STDIN
            1 => ["pipe", "w"], //STDOUT
            2 => ["pipe", "w"], //STDERR
        ], $pipes);

        if ($process !== false) {
            $stdout = stream_get_contents($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);

            return $stdout != '';
        }

        return false;
    }

    public function exists()
    {
        return $this->hasRSVGConvert;
    }

    public function convert($input, $format)
    {
        if ($this->exists() === false) {
            return $input;
        }

        $proc = proc_open([self::command, '-', '-f', $format], [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
        ], $pipes);

        if ($proc === false) {
            throw new \Exception('Conversion failed : '.stream_get_contents($pipes[2]));
        }

        fwrite($pipes[0], $input);
        fclose($pipes[0]);
        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        proc_close($proc);

        return $output;
    }
}
