<?php
namespace Blogger\BlogBundle\Entity;
use JMS\Serializer\Annotation as JMS;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\Repository\CourseRepository")
 * @ORM\Table(name="course")
 *
 * @JMS\ExclusionPolicy("all")
 */

class Course
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Type("string")
     */
    protected $name;
    /**
     * @ORM\Column(type="float")
     *
     * @JMS\Expose
     * @JMS\Type("float")
     */
    protected $value;

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Expose
     * @JMS\Type("integer")
     */
    protected $numcode;

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Expose
     * @JMS\Type("string")
     */

    protected $nominal;

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Expose
     * @JMS\Type("integer")
     */

    protected $charcode;

    /**
     * @ORM\Column(type="date")
     */
    protected $created;


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
     * Set name
     *
     * @param string $name
     *
     * @return Course
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return Course
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return Course
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set isoCode
     *
     * @param string $isoCode
     *
     * @return Course
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * Get isoCode
     *
     * @return string
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Course
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
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
