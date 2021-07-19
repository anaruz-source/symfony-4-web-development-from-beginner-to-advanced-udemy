<?php

namespace App\Controller;

use App\Entity\Usr;
use App\Entity\Video;
use App\Services\GiftService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{
    public function __construct($logger)
    {
        // do somthing with logger!
    }

    /**
     * @Route("/{id}", name="home")
     */
    public function index(GiftService $gifts, Usr $user): Response
    {
        dump($user);
        $repo = $this->getDoctrine()->getRepository(Usr::class);
        $entityManager = $this->getDoctrine()->getManager();
        $id = 1;

        // $user = $repo->find($id);

        // if (!$user) {
        //     throw $this->createNotFoundException('user with $id ='.$id.'not found');
        // }

        // $user = $repo->find(1); //by id 1
        //  $user = $repo->findOneBy(['name' => 'name-0', 'id' => 1]); //by a field or many fields!
        // $users = $repo->findBy(['name' => 'name-0'], ['id' => 'DESC']);

        // $user->setName('name-0 to Robert');

        // $userManager->remove($user);
        // $userManager->flush();

        // if ($users) {
        //     throw  $this->createNotFoundException('user doesnt exist, create one');
        // }

        // $this->addFlash('notice', 'your changes were saved!');
        // $this->addFlash('warning', 'your changes were saved -warning classname!');

        $conn = $entityManager->getConnection();
        $sql = 'SELECT * FROM usr u WHERE u.id > :id';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $users = $stmt->fetchAll();

        // $user2 = new Usr();
        // $user2->setName('Robert');
        // $entityManager->persist($user2);
        // $entityManager->flush();

        $user = new Usr();
        $user->setName('Robert');

        for ($i = 0; $i < 5; ++$i) {
            $video = new Video();
            $video->setTitle('video title.'.$id);
            $user->addVideo($video);
            $entityManager->persist($video);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'gifts' => $gifts->gifts,
            'user' => $user,
        ]);
    }

    /**
     * @Route(
     * "/blog/{page?}",
     * name="page",
     * requirements={"page":"\d+"}
     * )
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

    /**
     * @Route(
     * {"en":"/about-us",
     *   "nl":"/over-ons"
     * },
     * name="about_us"
     * )
     */
    public function aboutUs(): Response
    {
        return new Response('Translated paths');
    }

    /**
     * @Route(
     * "/send-cookie",
     * name="send_cookie"
     * )
     */
    public function sendCookie(Request $request, SessionInterface $session)
    {
        exit($request->query->get('page', 'default'));
        $session->set('name', 'session-value');
        if ($session->has('name')) {
            exit($session->get('name'));
        }
        exit($request->cookies->get('PHPSESSID'));

        $cookie = new Cookie('my_cookie', 'test', time() * (2 * 60)); //expires after 2 minutes

        $response = new Response();
        $response->headers->setcookie($cookie);

        return $response->send();
    }

    /**
     * @Route("/gen-url/{param?}", name="gen_url")
     */
    public function genUrl()
    {
        exit($this->generateUrl(
            'gen-url',
            ['param' => 10],
            UrlGeneratorInterface::ABSOLUTE_URL
            ));
    }

    /**
     * @Route("/download", name="download")
     */
    public function download()
    {
        $path = $this->getParameter('download_directory'); // retrieved from services.yaml under paramerts section

        return  $this->file($path.'file.pdf'); //enforces symfony to launch a download
    }

    /**
     * @Route("/redirect-test", name="redirect_test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', ['param' => 10]);
    }

    /**
     * @Route("/url-redirect/{param?}", name="route_to_redirect")
     * name parameter will be used inside redirection method above!
     */
    public function methodToRedirect()
    {
        exit('test redirection');
    }

    /**
     * @Route("/forward-to-controller")
     * This method will forward to different controller, here as we have only one controller, so we use DefaultController, look below!
     */
    public function forwarding_to()
    {
        return $this->forward(
            'App\Controller\DefaultController::forwardedToMethod',
            ['param' => 'xyz']);
    }

    /**
     * @Route("/forwarded-to/{param?}")
     * Method that above forwards to
     */
    public function forwardedToMethod($param)
    {
        exit('Forwarded to controller with param'.$param);
    }

    public function mostPopularBlogPosts($num = 3)
    {
        $posts = ['post1', 'post2', 'post3'];

        return  $this->render(
            'default/most-popular-blog-posts.html.twig',
            ['posts' => $posts]
    );
    }
}
