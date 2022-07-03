<?php

namespace App\Kulana;

use Symfony\Component\Process\Process;

class Command {

    private string $command = 'status';
    private string $url = '';
    private string $format = 'json';
    private bool $checkCertificate = false;
    private string $hostname = '';
    private int $timeout = 30;
    private int $port = 0;

    public function convertToProcess(): array {
        $process = [
            'kulana',
            $this->command,
        ];

        if ($this->command == 'status' && $this->url) {
            $process[] = '--url';
            $process[] = $this->url;
        }

        if ($this->format) {
            $process[] = '--format';
            $process[] = $this->format;
        }

        if ($this->command == 'status' && $this->checkCertificate) {
            $process[] = '--check-ssl';
        }

        if ($this->command == 'ping' && $this->hostname) {
            $process[] = '--hostname';
            $process[] = $this->hostname;
        }

        if ($this->command == 'ping' && $this->port) {
            $process[] = '--port';
            $process[] = $this->port;
        }

        if ($this->command == 'ping' && $this->timeout) {
            $process[] = '--timeout';
            $process[] = $this->timeout;
        }

        return $process;
    }

    public function run(): array {
        $process = $this->convertToProcess();
        $process = new Process($process);
        $process->run();

        $output = $process->getOutput();
        return json_decode($output, true);
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

    /**
     * @return bool
     */
    public function isCheckCertificate(): bool {
        return $this->checkCertificate;
    }

    /**
     * @param bool $checkCertificate
     *
     * @return Command
     */
    public function setCheckCertificate(bool $checkCertificate): Command {
        $this->checkCertificate = $checkCertificate;
        return $this;
    }

    /**
     * @return string
     */
    public function getHostname(): string {
        return $this->hostname;
    }

    /**
     * @param string $hostname
     *
     * @return Command
     */
    public function setHostname(string $hostname): Command {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout(): int {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     *
     * @return Command
     */
    public function setTimeout(int $timeout): Command {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort(): int {
        return $this->port;
    }

    /**
     * @param int $port
     *
     * @return Command
     */
    public function setPort(int $port): Command {
        $this->port = $port;
        return $this;
    }

}
