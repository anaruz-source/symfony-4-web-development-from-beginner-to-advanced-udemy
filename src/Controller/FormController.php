<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form/new", name="form")
     */
    public function index(Request $request): Response
    {
        $article = new Article();
        $article = new Article();
        $article->setTitle('Hello World');
        $article->setContent('Too short article.');
        $article->setAuthor('Anaruz');

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($article);
        }

        return $this->render('form/index.html.twig', [
            'form_type' => 'ArticleType Form',
            'form' => $form->createView(),
        ]);
    }
}
