<?php

namespace App\Controller;

use App\Services\Sluggify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SluggerController extends AbstractController
{
    #[Route('/slugger', name: 'app_slugger')]
    public function index(Sluggify $sluggify): Response
    {
        $text = $sluggify->generateSlug('Ceci est un texte(§èè!ç!è§!èç!');
        return $this->render('slugger/index.html.twig', [
            'controller_name' => 'SluggerController',
            'text' => $text,
        ]);
    }
}
