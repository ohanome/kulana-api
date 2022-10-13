<?php

namespace App\Result;

class Ping {

    private float $time;
    private string $ip;
    private bool $successful;
    private string $hostname;
    private string $port;

    /**
     * @return float
     */
    public function getTime(): float {
        return $this->time;
    }

    /**
     * @param float $time
     *
     * @return Ping
     */
    public function setTime(float $time): Ping {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp(): string {
        return $this->ip;
    }

    /**
     * @param string $ip
     *
     * @return Ping
     */
    public function setIp(string $ip): Ping {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool {
        return $this->successful;
    }

    /**
     * @param bool $successful
     *
     * @return Ping
     */
    public function setSuccessful(bool $successful): Ping {
        $this->successful = $successful;
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
     * @return Ping
     */
    public function setHostname(string $hostname): Ping {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * @return string
     */
    public function getPort(): string {
        return $this->port;
    }

    /**
     * @param string $port
     *
     * @return Ping
     */
    public function setPort(string $port): Ping {
        $this->port = $port;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'time' => $this->time,
            'ip' => $this->ip,
            'successful' => $this->successful,
            'hostname' => $this->hostname,
            'port' => $this->port,
        ];
    }

}