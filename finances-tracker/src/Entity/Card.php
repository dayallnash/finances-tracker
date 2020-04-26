<?php

namespace App\Entity;

use App\Helper\CardHelper;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardRepository")
 */
class Card
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $long_number;

    /**
     * @ORM\Column(type="text")
     */
    private $long_number_start;

    /**
     * @ORM\Column(type="text")
     */
    private $long_number_end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cardholder_name;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $expiry_date;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $cvv;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $card_type;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLongNumber(): ?string
    {
        return $this->long_number;
    }

    public function getLongNumberFormatted(): ?string
    {
        return CardHelper::formatLongNumber($this->long_number);
    }

    public function setLongNumber(string $long_number): self
    {
        $this->long_number = $long_number;

        return $this;
    }

    public function getLongNumberStart(): ?string
    {
        return $this->long_number_start;
    }

    public function setLongNumberStart(string $long_number_start): self
    {
        $this->long_number_start = $long_number_start;

        return $this;
    }

    public function getLongNumberEnd(): ?string
    {
        return $this->long_number_end;
    }

    public function setLongNumberEnd(string $long_number_end): self
    {
        $this->long_number_end = $long_number_end;

        return $this;
    }

    public function getCardholderName(): ?string
    {
        return $this->cardholder_name;
    }

    public function setCardholderName(string $cardholder_name): self
    {
        $this->cardholder_name = $cardholder_name;

        return $this;
    }

    public function getExpiryDate(): ?string
    {
        return $this->expiry_date;
    }

    public function setExpiryDate(string $expiry_date): self
    {
        $this->expiry_date = $expiry_date;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function getCardType(): ?string
    {
        return $this->card_type;
    }

    public function setCardType(string $card_type): self
    {
        $this->card_type = $card_type;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
