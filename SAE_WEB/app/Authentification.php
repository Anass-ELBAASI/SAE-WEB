<?php

namespace Romai\SaeWeb;

class Authentification {

  public function __construct(private IUserRepository $userRepository) { }

  /**
   * @throws AuthentificationException
   */
    public function register(string $email, string $password, string $repeat, string $nom, string $prenom) : bool {
        if($password !== $repeat) {
            throw new \Exception("Mots de passe différents");
        }
        if($this->invalideEmail($email)) {
            throw new \Exception("Email invalide");
        }
        if($this->userRepository->findUserByEmail($email)) {
            throw new \Exception("Utilisateur déjà enregistré");
        }

        $user = new User($email,$nom,$prenom, $password);

        return $this->userRepository->saveUser($user);
    }

    /**
     * @throws \Exception
     */
    public function authenticate(string $email, string $password) : true {
        $user = $this->userRepository->findUserByEmail($email);
        if(!$user || !password_verify($password, $user->getPassword())) {
            throw new \Exception("Mot de passe ou email invalide");
        }
        return true;
    }

    private function invalideEmail(string $email) : bool {
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}