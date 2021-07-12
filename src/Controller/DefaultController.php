<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(GiftService $gifts): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'gifts' => $gifts->gifts,
        ]);
    }

    /**
     * @Route("/blog/{page?}", name="page", requirements={"page":"\d+"})
     */
    public function blog(): Response
    {
        return new Response('Optional parameters in url and requirements for parameters');
    }

    /**
     * @Route(
     * "/articles/{_locale}/{year}/{slug}/{category}",
     * defaults={"category":"computers"},
     * requirements={
     *    "_locale":"en|fr",
     *    "year":"\d+",
     *    "category":"computers|rtv"
     * }
     * )
     */
    public function article(): Response
    {
        return new Response('An advanced Route Example!');
    }
}
