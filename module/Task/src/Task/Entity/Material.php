<?php

namespace Task\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Material
 *
 * @ORM\Table(name="material", uniqueConstraints={@ORM\UniqueConstraint(name="code", columns={"code"}), @ORM\UniqueConstraint(name="name", columns={"name"})}, indexes={@ORM\Index(name="fk_material_idGroup", columns={"idGroup"}), @ORM\Index(name="fk_material_idUnit", columns={"idUnit"})})
 * @ORM\Entity
 */
class Material
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=16, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modifiedAt", type="datetime", nullable=false)
     */
    private $modifiedat;

    /**
     * @var \Task\Entity\MaterialGroup
     *
     * @ORM\ManyToOne(targetEntity="Task\Entity\MaterialGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGroup", referencedColumnName="id")
     * })
     */
    private $idgroup;

    /**
     * @var \Task\Entity\Unit
     *
     * @ORM\ManyToOne(targetEntity="Task\Entity\Unit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUnit", referencedColumnName="id")
     * })
     */
    private $idunit;



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
     * Set code
     *
     * @param string $code
     *
     * @return Material
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Material
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
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Material
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set modifiedat
     *
     * @param \DateTime $modifiedat
     *
     * @return Material
     */
    public function setModifiedat($modifiedat)
    {
        $this->modifiedat = $modifiedat;

        return $this;
    }

    /**
     * Get modifiedat
     *
     * @return \DateTime
     */
    public function getModifiedat()
    {
        return $this->modifiedat;
    }

    /**
     * Set idgroup
     *
     * @param \Task\Entity\MaterialGroup $idgroup
     *
     * @return Material
     */
    public function setIdgroup(\Task\Entity\MaterialGroup $idgroup = null)
    {
        $this->idgroup = $idgroup;

        return $this;
    }

    /**
     * Get idgroup
     *
     * @return \Task\Entity\MaterialGroup
     */
    public function getIdgroup()
    {
        return $this->idgroup;
    }

    /**
     * Set idunit
     *
     * @param \Task\Entity\Unit $idunit
     *
     * @return Material
     */
    public function setIdunit(\Task\Entity\Unit $idunit = null)
    {
        $this->idunit = $idunit;

        return $this;
    }

    /**
     * Get idunit
     *
     * @return \Task\Entity\Unit
     */
    public function getIdunit()
    {
        return $this->idunit;
    }
}
