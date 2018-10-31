<?php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\User;
use Blogger\BlogBundle\Entity\Role;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;


class UserFixtures  extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // создание роли ROLE_ADMIN
        $role = new Role();
        $role->setName('ROLE_ADMIN');

        $manager->persist($role);

        // создание пользователя
        $user = new User();
        $user->setUsername('Alex');
        $user->setEmail('alex@example.com');
        $user->setSalt(md5(time()));

        // шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('admin', $user->getSalt());
        $user->setPassword($password);

        $user->getUserRoles()->add($role);

        $manager->persist($user);

        // создание роли ROLE_USER
        $role = new Role();
        $role->setName('ROLE_USER');

        $manager->persist($role);

        // создание пользователя
        $user = new User();
        $user->setUsername('dsyph3r');
        $user->setEmail('dsyph3r@example.com');
        $user->setSalt(md5(time()));

        // шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('12345', $user->getSalt());
        $user->setPassword($password);

        $user->getUserRoles()->add($role);

        $manager->persist($user);



       /* // создание роли ROLE_USER
        $role = new Role();
        $role->setName('ROLE_USER');

        $manager->persist($role);*/

        // создание пользователя
        $user = new User();
        $user->setUsername('Zero');
        $user->setEmail('Zero@example.com');
        $user->setSalt(md5(time()));

        // шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('12345', $user->getSalt());
        $user->setPassword($password);

        $user->getUserRoles()->add($role);

        $manager->persist($user);



        /*// создание роли ROLE_USER
        $role = new Role();
        $role->setName('ROLE_USER');*/

        //$manager->persist($role);

        // создание пользователя
        $user = new User();
        $user->setUsername('Gabriel');
        $user->setEmail('Gabriel@example.com');
        $user->setSalt(md5(time()));

        // шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('12345', $user->getSalt());
        $user->setPassword($password);

        $user->getUserRoles()->add($role);

        $manager->persist($user);



       /* // создание роли ROLE_USER
        $role = new Role();
        $role->setName('ROLE_USER');*/

        //$manager->persist($role);

        // создание пользователя
        $user = new User();
        $user->setUsername('Kevin');
        $user->setEmail('Kevin@example.com');
        $user->setSalt(md5(time()));

        // шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('12345', $user->getSalt());
        $user->setPassword($password);

        $user->getUserRoles()->add($role);

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}