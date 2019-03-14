<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AdminPath
 *
 * @ORM\Table(name="admin_path")
 * @ORM\Entity
 */
class AdminPath
{
    /**
     * @var int
     *
     * @Groups({"path"})
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="admin_path_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"path"})
     * @ORM\Column(name="label", type="text", nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @Groups({"path"})
     * @ORM\Column(name="path", type="text", nullable=false)
     */
    private $path;

    /**
     * @var self
     *
     * @Groups({"path"})
     * @ORM\ManyToOne(targetEntity="AdminPath")
     */
    private $parent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
