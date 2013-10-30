<?php

namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Form\RegisterFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * A user
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @property string $name
 * @property string $email
 * @property int $userId
 * @property string $password
 */
class User implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $userId;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    const SALT = "3#$48fh4r%%$8fjh2345ka@sd034s*^d(fhh";

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate($data = array())
    {
        $this->userId = $data['userId'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $this->saltPassword($data['password']);
    }

    public function verifyPassword($password)
    {
        if($this->password === $this->saltPassword($password))
        {
            return true;
        }

        return false;
    }

    private function saltPassword($password)
    {
        return crypt($password, self::SALT);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new RegisterFilter();
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}