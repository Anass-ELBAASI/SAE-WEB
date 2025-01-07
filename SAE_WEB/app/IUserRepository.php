<?php

namespace Romai\SaeWeb;

use Romai\SaeWeb\User;

interface IUserRepository {
  public function saveUser(User $user): bool;
  public function findUserByEmail(string $email): ?User;
}