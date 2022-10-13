<?php

namespace App\Service;

use App\Result\Ping;
use App\Result\Status;
use Symfony\Component\Process\Process;

class Kulana
{
    public function status(string $url): Status
    {
        $process = new Process(['./kulana', 'status', '--json', '-s', '--url', $url]);
        $process->run();

        $output = json_decode($process->getOutput());

        $status = new Status();
        $status->setUrl($output->url);
        $status->setStatus($output->status);
        $status->setTime($output->time);
        $status->setDestination($output->destination);
        $status->setIp($output->ip_address);
        $status->setCertificateValid($output->certificate->valid);
        $status->setCertificateExpiry($output->certificate->valid_until);

        return $status;
    }

    public function ping(string $host, string $port): Ping
    {
        $process = new Process(['./kulana', 'ping', '--json', '--hostname', $host, '-p', $port]);
        $process->run();

        $output = json_decode($process->getOutput());

        if (!empty($output->ping_successful)) {
            $successful = $output->ping_successful == 1;
        } else {
            $successful = false;
        }

        $ping = new Ping();
        $ping->setTime($output->time);
        $ping->setIp($output->ip_address);
        $ping->setSuccessful($successful);
        $ping->setHostname($output->hostname);
        $ping->setPort($output->port);

        return $ping;
    }
}