<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $passwordHasher;
    private $mailerInterface;
    private $container;

    public function __construct(UserPasswordHasherInterface $passwordHasher, MailerInterface $mailerInterface)
    {
        $this->passwordHasher = $passwordHasher;
        $this->mailerInterface = $mailerInterface;
    }

    public function load(ObjectManager $manager)
    {
        $users = array(
            ["kevin@leseditionscorses.com", "Admin", "Les Editions Corses", "Mr.", ["ROLE_SUPER_ADMIN"], "Cp20112b"],
        );


        foreach ($users as $user) {
            $u = new User();
            $u->setEmail($user[0]);
            $u->setUsername($user[1]);
            $u->setName($user[2]);
            // $u->setFirstname($user[2]);
            // $u->setCivility($user[3]);
            // $u->setCreationDate(new DateTime("NOW"));
            $u->setRoles($user[4]);
            $u->setPassword($this->passwordHasher->hashPassword($u, $user[5]));

            $manager->persist($u);

            // $email = (new TemplatedEmail())
            //     ->from(new Address('web@e-corses.com', 'Les Editions Corses'))
            //     ->to($u->getEmail())
            //     ->subject('Vos identifiants de connexion')
            //     ->htmlTemplate('mail/user_created.html.twig')
            //     ->context([
            //         'civility' => $u->getCivility(),
            //         'userEmail' => $u->getEmail(),
            //         'name' => $u->getName(),
            //         'password' => $password
            //     ]);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }

    /**
     * Sets the Container. Need it to create new User from fos_user.user_manager service
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
