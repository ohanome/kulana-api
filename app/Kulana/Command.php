<?php

namespace App\Kulana;

use Symfony\Component\Process\Process;

class Command {

    private string $command;
    private string $url;
    private string $format;

    public function convertToProcess(): array {
        $process = [
            'kulana',
            $this->command,
        ];

        if ($this->url) {
            $process[] = '-u';
            $process[] = $this->url;
        }

        if ($this->format) {
            $process[] = '--format';
            $process[] = $this->format;
        }

        return $process;
    }

    /**
     * @return string
     */
    public function getCommand(): string {
        return $this->command;
    }

    /**
     * @param string $command
     *
     * @return Command
     */
    public function setCommand(string $command): Command {
        $this->command = $command;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Command
     */
    public function setUrl(string $url): Command {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat(): string {
        return $this->format;
    }

    /**
     * @param string $format
     *
     * @return Command
     */
    public function setFormat(string $format): Command {
        $this->format = $format;
        return $this;
    }

}
