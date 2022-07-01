<?php

namespace App\Kulana;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class Status {

    public static function getStatusFromRequest(Request $request) {
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
        $process = $command->convertToProcess();

        $process = new Process($process);
        $process->run();

        $output = json_decode($process->getOutput(), true);


        return new JsonResponse($output, 200);
    }

}
