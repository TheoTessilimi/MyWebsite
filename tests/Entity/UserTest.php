<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class UserTest extends KernelTestCase
{
    public function getEntity(): User
    {
        return (new User())
            ->setEmail('test@gmail.com')
            ->setFirstname('théo')
            ->setLastname('tessilimi')
            ->setSteamID('125884233')
            ->setRoles([]);
}
    public function assertHasErrors(User $user, int $number = 0){
        self::bootKernel();
        $error = self::getContainer()->get('validator')->validate($user);
        $this->assertCount($number, $error);
    }

    public function testValidEntity(){

        $this->assertHasErrors($this->getEntity(), 0);

    }

    public function testIfEmailIsEmptyInEntity(){
        $user = $this->getEntity()->setEmail('');
        $this->assertHasErrors($user, 1);
    }


    public function testIfgetFullNameReturnFullName(){
        $this->assertEquals('Théo TESSILIMI', $this->getEntity()->getFullName());

    }
}