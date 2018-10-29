<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23.10.2018
 * Time: 13:00
 */

namespace Blogger\BlogBundle\Controller;
use Blogger\BlogBundle\Entity\Course;
use Blogger\BlogBundle\Entity\Courses;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction(){

        $em = $this->getDoctrine()
            ->getManager();

        $blogs = $em->getRepository('BloggerBlogBundle:Blog')
            ->getLatestBlogs();

        return $this->render('BloggerBlogBundle:Page:index.html.twig',['blogs' => $blogs]);
    }

    public function aboutAction(){

        return $this->render('BloggerBlogBundle:Page:about.html.twig' );
    }

    public function contactAction(Request $request){
        $enquiry = new Enquiry();

        $form = $this->createForm(EnquiryType::class,$enquiry);

        if($request->isMethod($request::METHOD_POST)){
            $form->handleRequest($request);
            if($form->isValid()){
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact enquiry from symblog')
                    ->setFrom('example@gmail.com')
                    ->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
                    ->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', ['enquiry' => $enquiry]));

                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
                return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
            }
        }

        return $this->render('BloggerBlogBundle:Page:contact.html.twig',['form'=>$form->createView()]);
    }

    public function sidebarAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tags = $em->getRepository('BloggerBlogBundle:Blog')
            ->getTags();

        $tagWeights = $em->getRepository('BloggerBlogBundle:Blog')
            ->getTagWeights($tags);

        $commentLimit  = $this->container
            ->getParameter('blogger_blog.comments.latest_comment_limit');

        $latestComments = $em->getRepository('BloggerBlogBundle:Comment')
            ->getLatestComments($commentLimit);

        return $this->render('BloggerBlogBundle:Page:sidebar.html.twig', array(
            'tags' => $tagWeights,
            'latestComments' => $latestComments
        ));
    }
}