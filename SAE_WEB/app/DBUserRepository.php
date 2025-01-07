<?php

namespace Romai\SaeWeb;

class DBUserRepository implements IUserRepository {

    public function __construct(private \PDO $dbConnexion) { }

    public function saveUser(User $user) : bool {

        $stmt = $this->dbConnexion->prepare(
            "INSERT INTO users (email,nom,prenom,mdp,estAdherent,estAdmin) VALUES (:email, :nom, :prenom, :mdp, :estAdherant, :estAdmin)"
        );
        return $stmt->execute(array(
            'email' => $user->getEmail(),
            'nom' => $user->getNom(),
            'prenom' =>$user->getPrenom(),
            'mdp' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'estAdherant' => true,
            'estAdmin' => false
        ));
    }

    public function findUserByEmail(string $email) : ?User {
        $stmt = $this->dbConnexion->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($result) {
            return new User($result['email'], $result['nom'], $result['prenom'], $result['mdp']);
        }
        return null;
    }

    public function isUserLoggedIn(): bool {
        if(session_status() === PHP_SESSION_NONE) {
            return false;
        }
        if(!empty($_SESSION['email'])) {
            return true;
        }
        return false;
    }

    public function isUserAdmin(string $email) : bool {
        $stmt = $this->dbConnexion->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($result) {
            $_SESSION["admin"] = $result["estAdmin"];
            return $_SESSION["admin"];
        }
        return false;
    }
}