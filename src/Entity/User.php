<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chirm", mappedBy="creator")
     */
    private $chirms;

    public function __construct()
    {
        parent::__construct();
        $this->chirms = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Chirm[]
     */
    public function getChirms(): Collection
    {
        return $this->chirms;
    }

    public function addChirm(Chirm $chirm): self
    {
        if (!$this->chirms->contains($chirm)) {
            $this->chirms[] = $chirm;
            $chirm->setCreator($this);
        }

        return $this;
    }

    public function removeChirm(Chirm $chirm): self
    {
        if ($this->chirms->contains($chirm)) {
            $this->chirms->removeElement($chirm);
            // set the owning side to null (unless already changed)
            if ($chirm->getCreator() === $this) {
                $chirm->setCreator(null);
            }
        }

        return $this;
    }
}