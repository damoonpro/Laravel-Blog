<?php

namespace Damoon\Blog\Http\Middleware\Interfaces;

interface IAdminUser
{
    public function is_admin(): bool | null;
}
