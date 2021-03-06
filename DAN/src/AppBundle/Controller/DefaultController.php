<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\WallParser;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function homeAction() {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/wall", name="wall")
     */
    public function wallAction(WallParser $wallParser) {

        if (isset($_POST["search-bar"])) {
            $pageid = $_POST["search-bar"];
            if(WallParser::ValidateId($pageid)) {
                return $this->render('parser.html.twig', array("data" => $wallParser->Parse($pageid)));
            }
        }


        $this->addFlash(
            'notice',
            'Validation error!'
        );
        return $this->redirectToRoute('home');
    }

}
