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
     * @var int
     */
    private $phone;

    /**
     * @var string
     */
    private $addrRename;

    /**
     * @var string
     */
    private $descriptionRename1;


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
     * @param int $phone
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
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set addrRename
     *
     * @param string $addrRename
     * @return Company
     */
    public function setAddrRename($addrRename)
    {
        $this->addrRename = $addrRename;

        return $this;
    }

    /**
     * Get addrRename
     *
     * @return string 
     */
    public function getAddrRename()
    {
        return $this->addrRename;
    }

    /**
     * Set descriptionRename1
     *
     * @param string $descriptionRename1
     * @return Company
     */
    public function setDescriptionRename1($descriptionRename1)
    {
        $this->descriptionRename1 = $descriptionRename1;

        return $this;
    }

    /**
     * Get descriptionRename1
     *
     * @return string 
     */
    public function getDescriptionRename1()
    {
        return $this->descriptionRename1;
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
