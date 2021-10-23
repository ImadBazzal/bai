<?php

declare(strict_types=1);


namespace App\Entity;


interface CelebrityRepresentative
{
    public function getCelebrity(): ?Celebrity;

    public function getRepresentative(): ?Representative;

    public function getType(): string;
}