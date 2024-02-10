<?php

namespace App\Controller;

use App\Services\Slug;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Request;

class SlugController extends AbstractController
{
    #[Route('/slug', name: 'app_slug')]
    public function index(Request $request, Slug $slugger): Response
    {
        $phrase = $request->request->get('phrase');

        if ($phrase !== null) {
            $slug = $slugger->sluggify($phrase);
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