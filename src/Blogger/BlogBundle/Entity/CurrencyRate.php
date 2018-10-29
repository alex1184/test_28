<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23.10.2018
 * Time: 16:58
 */

namespace Blogger\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\Type;


/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\Repository\CurrencyRateRepository");
 * @ORM\Table(name="currency_rate")
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("all")
 *
 */
class CurrencyRate
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     *
     */
    protected $id;

    /**
     * @ORM\Column(name="numcode",type="string")
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $NumCode;

    /**
     * @ORM\Column(name="charcode",type="string",length=3)
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $CharCode;

    /**
     * @ORM\Column(name="nominal",type="integer")
     * @JMS\Expose
     * @JMS\Type("integer")
     */
    protected $Nominal;

    /**
     * @ORM\Column(name="name",type="string")
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $Name;

    /**
     * @ORM\Column(name="value",type="float")
     * @JMS\Expose
     * @JMS\Type("float")
     */
    protected $Value;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $created;


    public function __construct(){

        $this->created = $this->setCreated(new \ DateTime());
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numcode
     *
     * @param string $numcode
     *
     * @return CurrencyRate
     */
    public function setNumcode($numcode)
    {
        $this->NumCode = $numcode;

        return $this;
    }

    /**
     * Get numcode
     *
     * @return string
     */
    public function getNumcode()
    {
        return $this->NumCode;
    }

    /**
     * Set charcode
     *
     * @param string $charcode
     *
     * @return CurrencyRate
     */
    public function setCharcode($charcode)
    {
        $this->CharCode = $charcode;

        return $this;
    }

    /**
     * Get charcode
     *
     * @return string
     */
    public function getCharcode()
    {
        return $this->CharCode;
    }

    /**
     * Set nominal
     *
     * @param integer $nominal
     *
     * @return CurrencyRate
     */
    public function setNominal($nominal)
    {
        $this->Nominal = $nominal;

        return $this;
    }

    /**
     * Get nominal
     *
     * @return integer
     */
    public function getNominal()
    {
        return $this->Nominal;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CurrencyRate
     */
    public function setName($name)
    {
        $this->Name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return CurrencyRate
     */
    public function setValue($value)
    {
        $this->Value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * Set created
     *
     * @ORM\PrePersist
     * @param \DateTime $created
     *
     * @return CurrencyRate
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Set created value
     *
     * @ORM\PrePersist
     */
    public function setUpdatedValue()
    {
        $this->setCreated(new \DateTime());
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }


}
