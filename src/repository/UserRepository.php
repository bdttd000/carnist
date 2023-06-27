<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/UserInfo.php';
require_once __DIR__ . '/../models/Privilege.php';

class UserRepository extends Repository
{
    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.*, p.name privilege_name, ui.name user_info_name, ui.surname, ui.phone, ui.address
            FROM users u 
            JOIN privilege p ON u.privilege_id = p.privilege_id 
            JOIN user_info ui ON u.user_info_id = ui.user_info_id
            WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        $privilege = new Privilege(
            $user['privilege_id'],
            $user['privilege_name']
        );

        $userInfo = new UserInfo(
            $user['user_info_id'],
            $user['user_info_name'],
            $user['surname'],
            $user['phone'],
            $user['address']
        );

        return new User(
            $user['user_id'],
            $privilege,
            $userInfo,
            $user['email'],
            $user['password'],
            $user['enabled'],
            $user['creation_date']
        );
    }

    public function checkUser(string $nickname, string $email): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_profile WHERE LOWER(nickname) = :nickname OR LOWER(email) = :email
        ');

        $stmt->bindParam(':nickname', strtolower($nickname), PDO::PARAM_STR);
        $stmt->bindParam(':email', strtolower($email), PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return (bool) $user;
    }

    public function addUser(string $nickname, string $email, string $password): void
    {
        $id = $this->getNextId('user_profile', 'userid');
        $creationDate = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_profile (userid, nickname, email, password, creationdate) VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $id,
            $nickname,
            $email,
            hash('sha256', $password),
            $creationDate->format('Y-m-d')
        ]);
    }
}