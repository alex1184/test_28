<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 25.10.2018
 * Time: 12:33
 */

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Form\BlogType;
use Doctrine\ORM\NoResultException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ApiController extends FOSRestController implements ClassResourceInterface
{

    /**
     * Gets an individual Blog Post
     *
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     *
     * @ApiDoc(
     *     output="blogger\BlogBundle\Entity\Blog",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */

    public function getAction($blog_id) {

        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->findOneBy(['id' => $blog_id]);

        if(!$blog instanceof Blog){
            throw new NoResultException();
        }
        $serializer = $this->container->get('jms_serializer');
        $serializedData = $serializer->serialize($blog, 'json');
        return new Response($serializedData,200);
    }

    /**
     * Sets new blog
     *
     * @param request $request
     * @return mixed
     *
     * @ApiDoc(
     *     output="blogger\BlogBundle\Entity\BlogType",
     *     statusCodes={
     *         201 = "Returned when successful",
     *         500 = "Return when error"
     *     }
     * )
     */
    public function postAction(Request $request) {

        $form = $this->createForm(BlogType::class,null,[
            'csrf_protection' => false
        ]);

        $form->submit($request->request->all());

        if(!$form->isValid()){
             return new Response('error','500');
        }

        $formData = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($formData);
        $em->flush();

        return new Response('new blog created','201');
    }

    public function putAction(Request $request,$blog_id) {


        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->findOneBy(['id' => $blog_id]);

        if(!$blog instanceof Blog){
            throw new NoResultException();
        }

        $form = $this->createForm(BlogType::class,null,[
            'csrf_protection' => false
        ]);

        $form->submit($request->request->all(),false);

        if(!$form->isValid()){
            return new Response('error','500');
        }

        $em->flush();

        return new Response("blog $blog_id updated",'201');
    }



    public function deleteAction($blog_id) {


        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->findOneBy(['id' => $blog_id]);

        if(!$blog instanceof Blog){
            throw new NoResultException();
        }

        $em->remove($blog);
        $em->flush();

        return new Response("blog $blog_id deleted",'201');
    }
}