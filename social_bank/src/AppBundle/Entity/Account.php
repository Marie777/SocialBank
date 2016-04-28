<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="enumaccountstatus")
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
