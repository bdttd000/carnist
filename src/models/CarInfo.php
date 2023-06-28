<?php

class CarInfo
{
    private $carInfoId;
    private $name;
    private $description;
    private $directoryUrl;
    private $avatarUrl;
    private $photos;

    public function __construct(
        int $carInfoId,
        string $name,
        string $description,
        string $directoryUrl,
        string $avatarUrl,
        array $photos
    ) {
        $this->carInfoId = $carInfoId;
        $this->name = $name;
        $this->description = $description;
        $this->directoryUrl = $directoryUrl;
        $this->avatarUrl = $avatarUrl;
        $this->photos = $photos;
    }

    public function getCarInfoId(): int
    {
        return $this->carInfoId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDirectoryUrl(): string
    {
        return $this->directoryUrl;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }
}