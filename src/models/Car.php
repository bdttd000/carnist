<?php

require_once 'CarInfo.php';

class Car
{
    private $carId;
    private $userId;
    private $carInfoId;
    private $active;
    private $creationDate;
    private $carInfo;
    private $cityId;
    private $cityName;

    public function __construct(
        int $carId,
        int $userId,
        int $carInfoId,
        bool $active,
        string $creationDate,
        CarInfo $carInfo,
        int $cityId,
        string $cityName
    ) {
        $this->carId = $carId;
        $this->userId = $userId;
        $this->carInfoId = $carInfoId;
        $this->active = $active;
        $this->creationDate = $creationDate;
        $this->carInfo = $carInfo;
        $this->cityId = $cityId;
        $this->cityName = $cityName;
    }

    public function getCarId(): int
    {
        return $this->carId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCarInfoId(): int
    {
        return $this->carInfoId;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function getCarInfo(): CarInfo
    {
        return $this->carInfo;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getCityName(): string
    {
        return $this->cityName;
    }
}