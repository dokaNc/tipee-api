<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Project
{
    
    private $id;

    /**
     * @Assert\NotNull
     */
    private $name;
    
    /**
     * @Assert\NotNull
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function serialize() {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "slug" => $this->getSlug()
        ];
    }
}