<?php

namespace App\DTOs\Auth;

class CompleteProfileDto
{
    public ?string $name;
    public ?string $email;
    public ?string $avatar;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->avatar = $data['avatar'];
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

}
