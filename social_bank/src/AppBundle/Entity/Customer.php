<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Customer extends User {
    /**
     * @ORM\Column
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $dateOfBirth;

    /**
     * @ORM\Column
     * @var string
     */
    protected $jobDescription;

    /**
     * @ORM\Column(type="enum_marital_status")
     * @var string
     */
    protected $status;

    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="customer")
     * @var ArrayCollection
     */
    protected $accounts;

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->accounts = new ArrayCollection();
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return string
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * @param string $jobDescription
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return ArrayCollection
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

}