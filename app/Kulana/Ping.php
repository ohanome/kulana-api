<?php

namespace App\Kulana;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class Ping {

    public static function getPingFromRequest(Request $request) {
        $messages = [];
        if (!$request->has('hostname')) {
            return new JsonResponse([
                'message' => 'Hostname required.',
            ], 400);
        }

        $hostname = $request->input('hostname');

        $command = new Command();
        $command->setCommand('ping')
            ->setHostname($hostname)
            ->setFormat('json');

        if ($request->has('port')) {
            $port = $request->input('port');
            if (is_numeric($port)) {
                $command->setPort((int) $port);
            } else {
                $messages[] = 'Invalid value for port.';
            }
        }

        $process = $command->convertToProcess();
        $process = new Process($process);
        $process->run();

        $output = $command->run();

        if ($request->has('debug') && $request->input('debug') == 1) {
            $response = ['input' => $request->all(), 'output' => $output, 'messages' => $messages,];
        } else {
            $response = $output;
        }

        return new JsonResponse($response, 200);
    }

}
