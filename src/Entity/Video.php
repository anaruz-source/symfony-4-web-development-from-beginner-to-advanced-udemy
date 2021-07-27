<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PDFRepository::class)
 */
class Video extends File
{
    /**
     * @ORM\ManyToOne(targetEntity=Usr::class, inversedBy="videos")
     */
    private $usr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    public function getUsr(): ?Usr
    {
        return $this->usr;
    }

    public function setUsr(?Usr $usr): self
    {
        $this->usr = $usr;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
