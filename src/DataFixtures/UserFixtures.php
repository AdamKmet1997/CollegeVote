<?php
namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    private function createUser($username, $plainPassword, $roles = ['ROLE_USER']):User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setRoles($roles);
// password - and encoding
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        return $user;
    }
    public function load(ObjectManager $manager)
    {
        // create objects
        $userUser = $this->createUser('user', 'user',['ROLE_USER']);
        $userAdmin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);
        $userAdam = $this->createUser('adam', 'kmet', ['ROLE_SUPER_ADMIN']);
// store to DB
        $manager->persist($userUser);
        $manager->persist($userAdmin);
        $manager->persist($userAdam);
        $manager->flush();

    }
}