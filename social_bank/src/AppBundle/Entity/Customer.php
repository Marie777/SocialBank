<?php

namespace AppBundle\Entity;

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
     * @ORM\Column
     * @var \DateTime
     */
    protected $dateOfBirth;

    /**
     * @ORM\Column
     * @var string
     */
    protected $jobDescription;

    /**
     * @Column(type="enummaritalstatus")
     */
    protected $status;


}