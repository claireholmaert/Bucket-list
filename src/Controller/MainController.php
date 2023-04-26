<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_index')]
    public function index(): Response
    {

        return $this->render('main/index.html.twig');
    }

    #[Route('/about_us', name: 'main_about_us')]
    public function aboutUs(): Response
    {
        $json = file_get_contents("team.json");
        $tab = json_decode($json, true);
        return $this->render(
            'aboutUS/index.html.twig',
            compact('tab'));
    }
}
