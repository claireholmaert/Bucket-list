<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use App\service\Alerte;
use App\service\Censurator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class WishController extends AbstractController
{
    /**
     * methode qui retourne une wishes
     *
     * @author Holmaert Claire
     * @return Response
     */
    #[Route('/list', name: 'wish_list')]
    public function list(
        WishRepository $wishRepository,
    ): Response
    {
        //$tabWish = $wishRepository->findAll();// version junior
        return $this->render(
            'list/index.html.twig',
            [
                "tabWish" => $wishRepository->findBy(["author" => $this->getUser()], ["dateCreated" => "DESC"]) // version senior
            ]
        );
    }

    /**
     * methode qui retourne un seul wish
     *
     * @author Holmaert Claire
     * @return Response
     */
    #[Route('/detail/{detail}',
        name: 'wish_detail',
        requirements: ["detail" =>'\d+'])]
    public function detail(
        Wish $detail,
    ): Response
    {
        return $this->render('detail/index.html.twig',
        compact('detail'));
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/ajouter',
        name: 'wish_ajouter')]
    public function ajouter(
        Request $request,
        Alerte $alerte,
        Censurator $censurator,
        EntityManagerInterface $entityManager
    ):Response
    {
        $wish = new Wish();
        $wish->setAuthor($this->getUser());
        $wishForm = $this->createForm(WishType::class, $wish);
        $wishForm->handleRequest($request);
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());
        if($wishForm->isSubmitted() && $wishForm->isValid()){
            try {
                $wish->setDescription($censurator->purify($wish->getDescription()));// Purification
                $entityManager->persist($wish);
                $entityManager->flush();
                $alerte->envoiMail();//envoi un mail a chaque fois que l'on ajoute un wish
                $this->addFlash('success', message: 'La tache a été ajoutée');// message flash
            } catch (\Exception $exception){
                $this->addFlash('erreur', message: "La tache n'a pas été ajoutée");
            }
            return $this->redirectToRoute('wish_list');
        }
        return $this->render('ajouter/index.html.twig',
        compact('wishForm'));
    }


}
