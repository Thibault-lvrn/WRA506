<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Request;

class SlugController extends AbstractController
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    #[Route('/slug', name: 'app_slug')]
    public function index(Request $request): Response
    {
        $phrase = $request->request->get('phrase');

        if ($phrase !== null) {
            $slug = $this->slugger->slug($phrase);
        } else {
            $slug = '';
        }

        return $this->render('slug/index.html.twig', [
            'controller_name' => 'SlugController',
            'phrase' => $phrase,
            'slug' => $slug,
        ]);
    }
}