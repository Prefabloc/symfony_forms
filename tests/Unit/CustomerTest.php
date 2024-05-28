<?php

namespace App\Tests\Unit;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerTest extends KernelTestCase
{
    public function getEntityCustomer() : Customer
    {
        return (new Customer())->setFullname('John Doe');
    }

    public function assertHasErrors(Customer $customer, int $number = 0)
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($customer);
        $this->assertCount($number, $errors);
    }

    public function testCustomerIsValid(): void
    {
        $this->assertHasErrors($this->getEntityCustomer(), 0);
    }

    public function testInvalidCustomerName()
    {
        $customer = $this->getEntityCustomer()->setFullname('');
        $this->assertHasErrors($customer, 2);
    }

    public function testInvalidCustomerLength()
    {
        $customer = $this->getEntityCustomer()->setFullname('a');
        $this->assertHasErrors($customer, 1);
    }
}
