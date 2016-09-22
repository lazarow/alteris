<?php

namespace Task\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MaterialGroup
 *
 * @ORM\Table(name="material_group", indexes={@ORM\Index(name="fk_material_group_idParent", columns={"idParent"})})
 * @ORM\MappedSuperclass
 */
abstract class MaterialGroup
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
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modifiedAt", type="datetime", nullable=false)
     */
    private $modifiedat = '0000-00-00 00:00:00';

    /**
     * @var \Task\Entity\MaterialGroup
     *
     * @ORM\ManyToOne(targetEntity="Task\Entity\MaterialGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idParent", referencedColumnName="id")
     * })
     */
    private $idparent;



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
     * @return MaterialGroup
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
     * @return MaterialGroup
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
     * @return MaterialGroup
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
     * Set idparent
     *
     * @param \Task\Entity\MaterialGroup $idparent
     *
     * @return MaterialGroup
     */
    public function setIdparent(\Task\Entity\MaterialGroup $idparent = null)
    {
        $this->idparent = $idparent;

        return $this;
    }

    /**
     * Get idparent
     *
     * @return \Task\Entity\MaterialGroup
     */
    public function getIdparent()
    {
        return $this->idparent;
    }
}
