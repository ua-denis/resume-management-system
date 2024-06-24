<?php

namespace App\Infrastructure\Persistence\Database\Entity;

use App\Common\Trait\Timestampable;
use App\Common\ValueObject\PhoneNumber;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Persistence\Database\Repository\CompanyRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Company
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url
     * @Assert\NotBlank
     */
    private string $website;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private string $address;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     * @Assert\Length(max=20)
     */
    private PhoneNumber $telephone;


    public function setTelephone(PhoneNumber $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getTelephone(): PhoneNumber
    {
        return $this->telephone;
    }

}