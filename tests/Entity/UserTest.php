<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


/**
 *
 */
class UserTest extends KernelTestCase
{
    /**
     * @return User
     */
    public function getEntity(): User
    {
        return (new User())
            ->setEmail('test@gmail.com')
            ->setFirstname('théo')
            ->setLastname('tessilimi')
            ->setSteamID('125884233')
            ->setRoles([]);
}
//TEST GUETTER AND SETTER
public function testGetterAndSetterIsTrue(){
    $user = new User();
        $user->setFirstname("myFirstName")
            ->setLastname("myLastName")
            ->setEmail("email@test.com")
            ->setPseudo("myPseudo")
            ->setRoles(array('myRole'))
            ->setSteamID("258745cdsqa")
            ->setPassword("motDePasse");

        $this->assertTrue($user->getFirstname()==='myFirstName');
        $this->assertTrue($user->getLastname()==='myLastName');
        $this->assertTrue($user->getEmail()==='email@test.com');
        $this->assertTrue($user->getPseudo()==='myPseudo');
        $this->assertTrue($user->getRoles() === array('myRole','ROLE_USER'));
        $this->assertTrue($user->getSteamID()==='258745cdsqa');
        $this->assertTrue($user->getPassword()=== 'motDePasse');
}
    public function testGetterAndSetterIsFalse()
    {
        $user = new User();
        $user->setFirstname("myFirstName")
            ->setLastname("myLastName")
            ->setEmail("email@test.com")
            ->setPseudo("myPseudo")
            ->setRoles(array('myRole'))
            ->setSteamID("258745cdsqa")
            ->setPassword("motDePasse");

        $this->assertFalse($user->getFirstname() === 'badFirstName');
        $this->assertFalse($user->getLastname() === 'badLastName');
        $this->assertFalse($user->getEmail() === 'bademail@test.com');
        $this->assertFalse($user->getPseudo() === 'badmyPseudo');
        $this->assertFalse($user->getRoles() === array('badRole', 'ROLE_USER'));
        $this->assertFalse($user->getSteamID() === 'bad258745cdsqa');
        $this->assertFalse($user->getPassword() === 'badmotDePasse');
    }
    public function testGetterAndSetterIsEmpty()
    {
        $user = new User();

        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getLastname());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPseudo());
        $this->assertTrue($user->getRoles() == array('ROLE_USER'));
        $this->assertEmpty($user->getSteamID());
    }
    /**
     * @param User $user
     * @param int $number
     * @return void
     */
    public function assertHasErrors(User $user, int $number = 0): void
    {
        self::bootKernel();
        $error = self::getContainer()->get('validator')->validate($user);
        $this->assertCount($number, $error);
    }

    /**
     * @return void
     */
    public function testValidEntity(): void
    {

        $this->assertHasErrors($this->getEntity(), 0);

    }

    /**
     * @return void
     */
    public function testIfEmailIsEmptyInEntity(){
        $user = $this->getEntity()->setEmail('');
        $this->assertHasErrors($user, 1);
    }


    /**
     * @return void
     */
    public function testIfGetFullNameReturnFullName(){
        $this->assertEquals('Théo TESSILIMI', $this->getEntity()->getFullName());

    }
}