<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\SecurityUser;
use App\Entity\Video;
use App\Form\ArticleType;
use App\Form\RegisterUserType;
use App\Form\VideoFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
        $manager = $this->getDoctrine()->getManager();

        // $repo = $manager->getRepository(Video::class);
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

        //$video = $repo->find(1);

        $form = $this->createForm(VideoFormType::class, $video);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            $filename = sha1(random_bytes(14)).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('videos_dir'),
                $filename
            );

            $video->setFilename($filename);
            $manager->persist($video);
            $manager->flush();
            $this->redirectToRoute('home');
        }

        return $this->render('form/index.html.twig', [
            'form_type' => 'VideoTypeForm Form',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/new", name="new-user")
     */
    public function newSecurityUser(Request $request, UserPasswordHasherInterface $hasher)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository(SecurityUser::class);

        dump($repo->findAll());

        $user = new SecurityUser();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $hasher->hashPassword($user, $form->get('password')->getData())
            );

            $user->setEmail($form->get('email')->getData());

            $manager->persist($user);
            $manager->flush();

            return  $this->redirectToRoute('home');
        }

        return $this->render('form/index.html.twig', [
            'form_type' => 'SecurityUserTypeForm Form',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $auth)
    {
        $error = $auth->getLastAuthenticationError();
        $lastUsername = $auth->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }
}
