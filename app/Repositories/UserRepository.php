<?php declare(strict_types=1);

namespace App\Repositories;

use App\Core\DatabaseConnector;
use App\Models\Profile;
use App\Models\User;

class UserRepository
{
    private DatabaseConnector $databaseConnector;

    public function __construct(DatabaseConnector $databaseConnector)
    {
        $this->databaseConnector = $databaseConnector;
    }

    public function findUserByEmail(string $email): ?User
    {
        try {
            $user = $this->databaseConnector->getQueryBuilder()->select('*')
                ->from('users')
                ->where("email = ?")
                ->setParameter(0, $email)
                ->fetchAssociative();
            if ($user) {
                return $this->buildUserModel($user);
            } else {
                return null;
            }
        } catch (\Doctrine\DBAL\Exception $e) {
            return null;
        }
    }

    public function save(Profile $profile): void
    {
        try {
            $this->databaseConnector->getQueryBuilder()->insert('users')
                ->values([
                    'name' => '?',
                    'surname' => '?',
                    'email' => '?',
                    'password' => '?'
                ])
                ->setParameter(0, $profile->getName())
                ->setParameter(1, $profile->getSurname())
                ->setParameter(2, $profile->getEmail())
                ->setParameter(3, $profile->getPassword())
                ->executeQuery();

            $user = $this->findUserByEmail($profile->getEmail());
            $profile->setId($user->getId());

            $this->databaseConnector->getQueryBuilder()->insert('profiles')
                ->values([
                    'user_id' => '?',
                    'address' => '?',
                    'city' => '?',
                    'postal_code' => '?',
                    'phone' => '?',
                    'comments' => '?',
                    'smoking' => '?',
                    'employed_from' => '?',
                    'employed_to' => '?',
                    'hobbies' => '?'
                ])
                ->setParameter(0, $user->getId())
                ->setParameter(1, $profile->getAddress())
                ->setParameter(2, $profile->getCity())
                ->setParameter(3, $profile->getPostalCode())
                ->setParameter(4, $profile->getPhone())
                ->setParameter(5, $profile->getComments())
                ->setParameter(6, $profile->getSmoking())
                ->setParameter(7, $profile->getEmployedFrom())
                ->setParameter(8, $profile->getEmployedTo())
                ->setParameter(9, implode(',', $profile->getHobbies()))
                ->executeQuery();

        } catch (\Doctrine\DBAL\Exception $e) {
            throw new \Exception("Failed to save profile.", 500);
        }
    }

    public function getAll(): array
    {
        try {
            $profiles = $this->databaseConnector->getQueryBuilder()
                ->select('users.id AS user_id, users.*, profiles.*')
                ->from('users')
                ->leftJoin('users', 'profiles', null, 'users.id = profiles.user_id')
                ->fetchAllAssociative();

            $profileCollection = [];
            foreach ($profiles as $profile) {
                $profileCollection[] = $this->buildProfileModel($profile);
            }
            return $profileCollection;
        } catch (\Doctrine\DBAL\Exception $e) {
            return [];
        }
    }

    private function buildUserModel(array $userData): User
    {
        return new User(
            $userData['name'],
            $userData['surname'],
            $userData['email'],
            $userData['password'],
            (int)$userData['id']
        );
    }

    private function buildProfileModel(array $profileData): Profile
    {
        return new Profile(
            $profileData['name'],
            $profileData['surname'],
            $profileData['email'],
            $profileData['password'],
            $profileData['address'],
            $profileData['city'],
            $profileData['postal_code'],
            $profileData['phone'],
            $profileData['comments'],
            $profileData['smoking'],
            explode(',', $profileData['hobbies']),
            $profileData['employed_from'],
            $profileData['employed_to'],
            (int)$profileData['user_id']
        );
    }
}
