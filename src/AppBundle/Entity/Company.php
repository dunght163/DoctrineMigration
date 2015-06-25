<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 */
class Company
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $addr;

    /**
     * @var string
     */
    private $descriptionRename;


    private $companyProductMaps;

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
     * @return Company
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
     * Set phone
     *
     * @param string $phone
     * @return Company
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set addr
     *
     * @param string $addr
     * @return Company
     */
    public function setAddr($addr)
    {
        $this->addr = $addr;

        return $this;
    }

    /**
     * Get addr
     *
     * @return string 
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * Set descriptionRename
     *
     * @param string $descriptionRename
     * @return Company
     */
    public function setDescriptionRename($descriptionRename)
    {
        $this->descriptionRename = $descriptionRename;

        return $this;
    }

    /**
     * Get descriptionRename
     *
     * @return string 
     */
    public function getDescriptionRename()
    {
        return $this->descriptionRename;
    }

    /**
     * @return mixed
     */
    public function getCompanyProductMaps()
    {
        return $this->companyProductMaps;
    }

    /**
     * @param mixed $companyProductMaps
     */
    public function setCompanyProductMaps($companyProductMaps)
    {
        $this->companyProductMaps = $companyProductMaps;
    }

}
