<?php

namespace App\Kulana;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class Status {

    public static function getStatusFromRequest(Request $request) {
        $messages = [];
        if (!$request->has('url')) {
            return new JsonResponse([
                'message' => 'URL required.',
            ], 400);
        }

        $url = $request->input('url');
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return new JsonResponse([
                'message' => 'Invalid URL.',
            ], 400);
        }

        $command = new Command();
        $command->setCommand('status')
            ->setUrl($url)
            ->setFormat('json');

        if ($request->has('checkCertificate')) {
            if ($request->input('checkCertificate') == 1 || $request->input('checkCertificate') == 0) {
                $command->setCheckCertificate((bool) (int) $request->input('checkCertificate'));
            } else {
                $messages[] = 'Invalid value for checkCertificate.';
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
