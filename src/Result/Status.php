<?php

namespace App\Result;

class Status {

    private string $url;
    private int $status;
    private float $time;
    private string $destination;
    private string $ip;
    private bool $certificateValid;
    private string $certificateExpiry;

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'status' => $this->status,
            'time' => $this->time,
            'destination' => $this->destination,
            'ip' => $this->ip,
            'certificate_valid' => $this->certificateValid,
            'certificate_expiry' => $this->certificateExpiry,
        ];
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
     * @return Status
     */
    public function setUrl(string $url): Status {
        $this->url = $url;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return Status
     */
    public function setStatus(int $status): Status {
        $this->status = $status;
        return $this;
    }

    /**
     * @return float
     */
    public function getTime(): float {
        return $this->time;
    }

    /**
     * @param float $time
     *
     * @return Status
     */
    public function setTime(float $time): Status {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestination(): string {
        return $this->destination;
    }

    /**
     * @param string $destination
     *
     * @return Status
     */
    public function setDestination(string $destination): Status {
        $this->destination = $destination;
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
     * @return Status
     */
    public function setIp(string $ip): Status {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCertificateValid(): bool {
        return $this->certificateValid;
    }

    /**
     * @param bool $certificateValid
     *
     * @return Status
     */
    public function setCertificateValid(bool $certificateValid): Status {
        $this->certificateValid = $certificateValid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCertificateExpiry(): string {
        return $this->certificateExpiry;
    }

    /**
     * @param string $certificateExpiry
     *
     * @return Status
     */
    public function setCertificateExpiry(string $certificateExpiry): Status {
        $this->certificateExpiry = $certificateExpiry;
        return $this;
    }

}