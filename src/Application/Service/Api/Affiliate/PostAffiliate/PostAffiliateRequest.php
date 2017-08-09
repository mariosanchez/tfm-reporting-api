<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\PostAffiliate;

class PostAffiliateRequest
{
    private $name;
    private $lastName;
    private $email;

    /**
     * CreateServiceRequest constructor.
     * @param $name
     * @param $lastName
     * @param $email
     */
    public function __construct($name, $lastName, $email)
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    /**
     * Returns the Name value.
     *
     * @return mixed
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Returns the LastName value.
     *
     * @return mixed
     */
    public function lastName()
    {
        return $this->lastName;
    }

    /**
     * Returns the Email value.
     *
     * @return mixed
     */
    public function email()
    {
        return $this->email;
    }
}
