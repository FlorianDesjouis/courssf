<?php

namespace RouteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    public function createTicketAction()
    {
        $comment = new comment();
        $comment->setName('Computer Peripherals');

        $ticket = new ticket();
        $ticket->setName('Keyboard');
        $ticket->setPrice(19.99);
        $ticket->setDescription('Ergonomic and stylish!');

        // relate this ticket to the comment
        $ticket->setcomment($comment);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->persist($ticket);
        $em->flush();

        return new Response(
            'Saved new ticket with id: '.$ticket->getId()
            .' and new comment with id: '.$comment->getId()
        );
    }

    public function showAction($ticketId)
    {
        $ticket = $this->getDoctrine()
            ->getRepository('RouteBundle:Ticket')
            ->find($ticketId);

        $commentName = $ticket->getComment()->getName();

    }

    public function showTicketAction($commentId)
    {
        $comment = $this->getDoctrine()
            ->getRepository('RouteBundle:Comment')
            ->find($categoryId);

        $ticket = $comment->getTicket();
        
    }

    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('RouteBundle:Default:index.html.twig');
    }
    /**
    *@Route("/platform/{name}", name="page1")
    */
    public function showPageOne($name)
    {
    	return $this->render('RouteBundle:Default:page1.html.twig', ['name' => $name]);
    }
    /**
    *@Route("/platform/{name}", name="page2")
    */
    public function showPageTwo($name)
    {
    	return $this->render('RouteBundle:Default:page2.html.twig', ['name' => $name]);
    }
    /**
    *@Route("/platform/{name}", name="page3")
    */
    public function showPageThree($name)
    {
    	return $this->render('RouteBundle:Default:page3.html.twig', ['name' => $name]);
    }
}
