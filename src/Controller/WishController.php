<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * methode qui retourne une wishes
     *
     * @author Holmaert Claire
     * @return Response
     */
    #[Route('/list', name: 'wish_list')]
    public function list(): Response
    {
        return $this->render('list/index.html.twig');
    }

    /**
     * methode qui retourne un seul wish
     *
     * @author Holmaert Claire
     * @return Response
     */
    #[Route('/detail', name: 'wish_detail')]
    public function detail(): Response
    {
        return $this->render('detail/index.html.twig');
    }
}
