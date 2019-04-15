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
        $userHolly = $this->createUser('holly', 'holly',['ROLE_USER']);
        $userPeter = $this->createUser('peter', 'peter',['ROLE_USER']);
        $userLucia = $this->createUser('lucia', 'lucia',['ROLE_USER']);
        $userDaniel = $this->createUser('daniel', 'daniel',['ROLE_USER']);
        $userAka = $this->createUser('aka', 'aka',['ROLE_USER']);
        $userDylan = $this->createUser('dylan', 'dylan',['ROLE_USER']);
        $userHelp1 = $this->createUser('help', 'help',['ROLE_USER']);
        $userHelp2 = $this->createUser('help2', 'help2',['ROLE_USER']);
        $userKhaw = $this->createUser('khaw', 'khaw',['ROLE_USER']);
        $userMatt = $this->createUser('matt', 'matt',['ROLE_ADMIN']);
        $userAdmin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);
        $userAdam = $this->createUser('adam', 'kmet', ['ROLE_SUPER_ADMIN']);
// store to DB
        $manager->persist($userUser);
        $manager->persist($userAdmin);
        $manager->persist($userAdam);
        $manager->persist($userHolly);
        $manager->persist($userPeter);
        $manager->persist($userDaniel);
        $manager->persist($userAka);
        $manager->persist($userDylan);
        $manager->persist($userHelp1);
        $manager->persist($userHelp2);
        $manager->persist($userKhaw);
        $manager->persist($userLucia);
        $manager->persist($userMatt);
        $manager->flush();

    }
}