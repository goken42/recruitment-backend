<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AdminRole
 *
 * @ORM\Table(name="admin_role", uniqueConstraints={@ORM\UniqueConstraint(name="uniq_7770088aea750e8", columns={"label"})})
 * @ORM\Entity
 */
class AdminRole
{
    /**
     * @var int
     *
     * @Groups({"role"})
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="admin_role_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"role"})
     * @ORM\Column(name="label", type="text", nullable=false)
     */
    private $label;

    /**
     * @var ArrayCollection
     *
     * @Groups({"paths"})
     * @ORM\ManyToMany(targetEntity="AdminPath")
     * @ORM\JoinTable(name="admin_role_path",
     *     joinColumns={@ORM\JoinColumn(name="role_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="path_id")}
     * )
     */
    private $paths;

    public function __construct()
    {
        $this->paths = new ArrayCollection();
    }

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

    /**
     * @return Collection|AdminPath[]
     */
    public function getPaths(): Collection
    {
        return $this->paths;
    }

    public function addPath(AdminPath $path): self
    {
        if (!$this->paths->contains($path)) {
            $this->paths[] = $path;
        }

        return $this;
    }

    public function removePath(AdminPath $path): self
    {
        if ($this->paths->contains($path)) {
            $this->paths->removeElement($path);
        }

        return $this;
    }
}
