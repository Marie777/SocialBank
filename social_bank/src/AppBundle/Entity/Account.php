<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Account {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $balance = 0;

    /**
     * @ORM\Column(type="enum_account_status")
     * @var string
     */
    protected $status;

    /**
     * @ORM\Column(type="decimal")
     * @var float
     */
    protected $typeCommission;

    /**
     * @var Customer
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="accounts")
     */
    protected $customer;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="source")
     */
    protected $expense;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="destination")
     */
    protected $income;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
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
     * @return float
     */
    public function getTypeCommission()
    {
        return $this->typeCommission;
    }

    /**
     * @param float $typeCommission
     */
    public function setTypeCommission($typeCommission)
    {
        $this->typeCommission = $typeCommission;
    }
}
