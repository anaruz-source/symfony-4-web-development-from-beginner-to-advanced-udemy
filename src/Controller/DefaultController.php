<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Author;
use App\Entity\File;
use App\Entity\Usr;
use App\Entity\Video;
use App\Events\VideoCreatedEvent;
use App\Services\GiftService;
use App\Services\ServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{
    private $dispatcher;

    public function __construct($logger, EventDispatcherInterface $d)
    {
        // do somthing with logger!

        $this->dispatcher = $d;
    }

    /**
     * @Route("/index", name="home")
     */
    public function index(GiftService $gifts /*Usr $user* this is used for param converter*/, ServiceInterface $service): Response
    {
        //dump($user);

        $repoUsr = $this->getDoctrine()->getRepository(Usr::class);
        $repoVideo = $this->getDoctrine()->getRepository(File::class);
        $repoAuth = $this->getDoctrine()->getRepository(Author::class);

        $entityManager = $this->getDoctrine()->getManager();

        // $service->dumpProps();
        // dump($service->argService->lazyLoadcled());

        // $user = $repo->find($id);

        // if (!$user) {
        //     throw $this->createNotFoundException('user with $id ='.$id.'not found');
        // }

        $user = $repoUsr->find(1); //by id 1
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

        // $conn = $entityManager->getConnection();
        // $sql = 'SELECT * FROM usr u WHERE u.id > :id';

        // $stmt = $conn->prepare($sql);
        // $stmt->execute(['id' => $id]);

        // $users = $stmt->fetchAll();

        // $user2 = new Usr();
        // $user2->setName('Robert');
        // $entityManager->persist($user2);
        // $entityManager->flush();

        // $user = new Usr();
        // $user->setName('Robert');

        // for ($i = 0; $i < 5; ++$i) {
        //     $video = new Video();
        //     $video->setTitle('video title.'.$i);
        //     $user->addVideo($video);
        //     $entityManager->persist($video);
        // }

        // $entityManager->persist($user);
        // $entityManager->flush();

        // $videos = $user->getVideos();
        // $txt = '';
        // foreach ($videos as $v) {
        //     $txt .= $v->getTitle().'<br>';
        // }

        // exit($txt);

        // $vid = $repoVideo->find(2);
        // $user->removeVideo($vid);

        // $entityManager->flush();
        $author = $repoAuth->find(1);
        $user1 = $repoUsr->find(1);
        $user1->setName('Robert');
        $entityManager->persist($user1);
        $entityManager->flush();
        $video = $repoVideo->find(1);

        // $newUser = new Usr();
        // $newUser->setName('John');
        // $address = new Address();
        // $address->setStreet('Marche verte');
        // $address->setNumber(34);
        // $newUser->setAddress($address);

        // $entityManager->persist($newUser);
        // $entityManager->persist($address); // this will be used if cascade={"remove", "persist"}

        // $usrs = ['Robert', 'John', 'Susan', 'Daniel'];
        // foreach ($usrs as $u) {
        //     $nUser = new Usr();
        //     $nUser->setName($u);
        //     $entityManager->persist($nUser);
        // }

        // $user2 = $repoUsr->find(2);
        // $user3 = $repoUsr->find(3);
        // $user4 = $repoUsr->find(4);

        // $user1->addFollowed($user2);
        // $user1->addFollowed($user3);
        // $user1->addFollowed($user4);

        // $entityManager->flush();

        // dump($user1);

        // for ($i = 0; $i < 3; ++$i) {
        //     $v = new Video();
        //     $v->setTitle('video n° '.($i + 1));
        //     $user1->addVideo($v);
        //     $entityManager->persist($v);
        // }

        // $entityManager->persist($user1);

        // $entityManager->flush();

        // $userWvideos = $repoUsr->findWithVideos(1);

        dump($author);
        dump($user1);
        dump($video->getAuthor()->getName());

        // composer require symfony/cache

        // $cache = new FilesystemAdapter();
        // $posts = $cache->getItem('database.get_posts'); // key database.get_posts

        // if (!$posts->isHit()) { // no posts found in the cache, thus usage of !
        //     $posts_from_db = ['post 1', 'post 2', 'post 3'];
        //     dump('Database connection made!');
        //     $posts->set(serialize($posts_from_db)); // serialize array to some string, cache couldn't store array
        //     $posts->expiresAfter(15); //expires after 15 seconds!
        //     $cache->save($posts);
        // }
        // dump(unserialize($posts->get()));

        // $cache->deleteItem('database.get_posts'); // to clear one Item!
        // $cache->clear(); // to clear all!

        // $cache = new TagAwareAdapter(
        //     new FilesystemAdapter()
        // );

        // $acer = $cache->getItem('acer');
        // $dell = $cache->getItem('dell');
        // $ibm = $cache->getItem('ibm');
        // $apple = $cache->getItem('apple');

        // if (!$acer->isHit()) { // cache not available!
        //     $acer_from_db = 'acer laptop';
        //     $acer->set($acer_from_db);
        //     $acer->tag(['computers', 'laptops', 'acer']);
        //     $cache->save($acer);
        //     dump('acer laptop from database...');
        // }

        // if (!$dell->isHit()) { // cache not available!
        //     $dell_from_db = 'dell laptop';
        //     $dell->set($dell_from_db);
        //     $dell->tag(['computers', 'laptops', 'dell']);
        //     $cache->save($dell);
        //     dump('dell laptop from database...');
        // }

        // if (!$ibm->isHit()) { // cache not available!
        //     $ibm_from_db = 'Ibm desktop';
        //     $ibm->set($ibm_from_db);
        //     $ibm->tag(['computers', 'desktops', 'ibm']);
        //     $cache->save($ibm);
        //     dump('ibm desktop from database...');
        // }

        // if (!$apple->isHit()) { // cache not available!
        //     $apple_from_db = 'apple desktop';
        //     $apple->set($apple_from_db);
        //     $apple->tag(['computers', 'desktops', 'apple']);
        //     $cache->save($apple);
        //     dump('apple desktop from database...');
        // }

        // dump($acer->get());
        // dump($dell->get());
        // dump($ibm->get());
        // dump($apple->get());

        //$cache->invalidateTags(['ibm']); // ibm will go from cache
        //$cache->invalidateTags(['desktops']); // ibm and apple  will go from cache
        //$cache->invalidateTags(['computers']); // ibm and apple  will go from cache

        $video = new \stdClass();
        $video->title = 'Funny Movie';
        $video->category = 'Funny';

        $event = new VideoCreatedEvent($video);

        $this->dispatcher->dispatch($event, 'video.created.event');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => [],
            'gifts' => $gifts->gifts,
            'user' => null,
            'video' => $video,
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
