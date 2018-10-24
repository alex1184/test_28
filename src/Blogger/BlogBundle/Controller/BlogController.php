<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23.10.2018
 * Time: 13:00
 */

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BlogController extends Controller
{
    public function showAction($id,$slug){

        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('Blogger\BlogBundle\Entity\Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $comments = $em->getRepository('BloggerBlogBundle:Comment')
            ->getCommentsForBlog($blog->getId());

        return $this->render('BloggerBlogBundle:Blog:show.html.twig', ['blog' => $blog,'comments' => $comments]);
    }




}