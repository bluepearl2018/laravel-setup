<?php

namespace Eutranet\Setup\Repository\Interface;

use Illuminate\Support\Collection;

/**
 * Methods to be implemented in UserRepository
 *
 */
interface UserRepositoryInterface
{
    public function all(): Collection;

    public function getAllUsers(): Collection;

    public function getByTaxId($userTaxId);

    public function getByEmail($userEmail);

    public function getByPhone($userPhone);

    public function getByDateOfBirth($userDateOfBirth);
}
