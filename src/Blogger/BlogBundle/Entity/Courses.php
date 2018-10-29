<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26.10.2018
 * Time: 17:21
 */

namespace Blogger\BlogBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS/XmlRoot("valcurs")
 */

class Courses
{

    /**
     * @JMS\Type("ArrayCollection<Blogger\BlogBundle\Entity\Course>")
     * @JMS\XmlList(inline=false,entry="valute")
     */
    protected $valutes = [];
}