<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $comment = new Comment();
        $comment->setDatePublish(new \DateTime());
        $comment->setLikeCount(0);
        $comment->setComment("first comment");

        dump($comment);

        /*$em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();*/


        return $this->render('index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/comment/list", name="commentList")
     */
    public function listAction()
    {

        $commentRepository = $this->getDoctrine()->getRepository('AppBundle:Comment');
        $comments = $commentRepository->findAll();

        return $this->render('list.html.twig', array("comments" => $comments));
    }
}
