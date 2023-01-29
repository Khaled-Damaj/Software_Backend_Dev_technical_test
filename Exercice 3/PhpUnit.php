<?php

    class CustomerControllerTest extends PHPUnit_Framework_TestCase
    {
        public function testGetCustomerSuccess()
        {
            $customerId = 1;
            $bearerToken = "Bearer 81vhcdbbftogrypwbqtrjznhupnfidom";
            $apiUrl = "https://api.dev.ecommerce.ontdf.io/rest/V1/customers/$customerId";

            $expectedResponse = [
                "id" => 1,
                "firstname" => "John",
                "lastname" => "Doe"
                "email" => "johndoe@example.com",
            ];

            $mock = $this->getMockBuilder(CustomerController::class)
                        ->setMethods(["sendRequest"])
                        ->getMock();

            $mock->expects($this->once())
                ->method("sendRequest")
                ->with($this->equalTo($apiUrl), $this->equalTo($bearerToken))
                ->willReturn(json_encode($expectedResponse));

            $customer = $mock->getCustomer($customerId, $bearerToken);
            $this->assertEquals($expectedResponse, $customer);
        }

        public function testGetCustomerFail()
        {
            $customerId = 999;
            $bearerToken = "Bearer 81vhcdbbftogrypwbqtrjznhupnfidom";
            $apiUrl = "https://api.dev.ecommerce.ontdf.io/rest/V1/customers/$customerId";
            $errorMessage = "Customer not found";

            $mock = $this->getMockBuilder(CustomerController::class)
                        ->setMethods(["sendRequest"])
                        ->getMock();

            $mock->expects($this->once())
                ->method("sendRequest")
                ->with($this->equalTo($apiUrl), $this->equalTo($bearerToken))
                ->willReturn($errorMessage);

            $this->expectExceptionMessage($errorMessage);
            $mock->getCustomer($customerId, $bearerToken);
        }
    }

