<?php


namespace Blogger\BlogBundle\Entity;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use Blogger\BlogBundle\Entity\CurrencyRate;

/**
 *
 * @JMS\XmlRoot("ValCurs")
 */
class Result
{
    /**
     *
     * @JMS\XmlList(inline = true, entry="Valute")
     * @JMS\Type("ArrayCollection<Blogger\BlogBundle\Entity\CurrencyRate>")
     * @JMS\expose
     */

    public $valutes;

}
