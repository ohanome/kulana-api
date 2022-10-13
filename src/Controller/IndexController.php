<?php

namespace App\Controller;

use App\Form\PingType;
use App\Form\StatusType;
use App\Service\Kulana;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/status', name: 'app_status')]
    public function status(Request $request, Kulana $kulana): Response
    {
        $form = $this->createForm(StatusType::class);

        $url = null;

        if (isset($request->query->all()['url']) && $url == null) {
            $url = $request->query->all()['url'];
        }

        if (!empty($request->request->all())) {
            $url = $request->request->all()['status']['url'];
        }

        if ($url != null) {
            $form->setData(['url' => $url]);
        }

        $response = [
            'form' => $form->createView(),
            'result' => null,
        ];

        if ($url != null) {
            $form->submit(['url' => $url]);
        } else {
            $form->handleRequest($request);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $status = $kulana->status($form->getData()['url']);
            $response['result'] = $status->toArray();
        }

        return $this->render('index/status.html.twig', $response);
    }

    #[Route('/ping', name: 'app_ping')]
    public function ping(Request $request, Kulana $kulana): Response
    {
        $form = $this->createForm(PingType::class);

        $host = null;
        $port = null;

        if (
            (isset($request->query->all()['host']) && $host == null) &&
            (isset($request->query->all()['port']) && $port == null)
        )
        {
            $host = $request->query->all()['host'];
            $port = $request->query->all()['port'];
        }

        if (!empty($request->request->all()['ping']) && !empty($request->request->all()['ping']['host']) && !empty($request->request->all()['ping']['port'])) {
            $host = $request->request->all()['ping']['host'];
            $port = $request->request->all()['ping']['port'];
        }

        if ($host != null && $port != null) {
            $form->setData(['host' => $host, 'port' => $port]);
        }

        $response = [
            'form' => $form->createView(),
            'result' => null,
        ];

        if ($host != null && $port != null) {
            $form->submit(['host' => $host, 'port' => $port]);
        } else {
            $form->handleRequest($request);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $status = $kulana->ping($form->getData()['host'], $form->getData()['port']);
            $response['result'] = $status->toArray();
        }

        return $this->render('index/ping.html.twig', $response);
    }
}
