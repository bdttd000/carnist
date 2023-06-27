<?php

class UserInfo
{
    private $userInfoId;
    private $name;
    private $surname;
    private $phone;
    private $address;

    public function __construct(
        int $userInfoId,
        string $name,
        string $surname,
        string $phone,
        string $address
    ) {
        $this->userInfoId = $userInfoId;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function getUserInfoId(): int
    {
        return $this->userInfoId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}