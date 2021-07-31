<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Video;
use App\Form\ArticleType;
use App\Form\VideoFormType;
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

    /**
     * @Route("/video/new", name="video-form")
     */
    public function videoForm(Request $request): Response
    {
        /*
        *
        ***
        ***** Rendering From!
        ***
        */

        $video = new Video();
        $video->setFilename('horse.mp4');
        $video->setDescription('Riding horse for the first time');
        $video->setSize(8340);
        $video->setFormat('mpeg-4');
        $video->setDuration(3600);
        $video->setCreatedAt(new \DateTime());

        $form = $this->createForm(VideoFormType::class, $video);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());

            //return $this->redirectToRoute('index');
        }

        $form = $this->createForm(VideoFormType::class, $video);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($video);
        }

        return $this->render('form/index.html.twig', [
            'form_type' => 'VideoTypeForm Form',
            'form' => $form->createView(),
        ]);
    }
}
