<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * AddressBook
 *
 * @ORM\Table(name="address_book")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressBookRepository")
 */
class AddressBook {
  
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  
  /**
   * @var string
   *
   * @ORM\Column(name="firstName", type="string", length=255)
   */
  private $firstName;
  
  /**
   * @var string
   *
   * @ORM\Column(name="lastName", type="string", length=255)
   */
  private $lastName;
  
  /**
   * @var string
   *
   * @ORM\Column(name="street", type="string", length=255)
   */
  private $street;
  
  /**
   * @var string
   *
   * @ORM\Column(name="zip", type="string", length=255)
   */
  private $zip;
  
  /**
   * @var string
   *
   * @ORM\Column(name="city", type="string", length=255)
   */
  private $city;
  
  /**
   * @var string
   *
   * @ORM\Column(name="country", type="string", length=255)
   */
  private $country;
  
  /**
   * @var string
   *
   * @ORM\Column(name="phoneNo", type="string", length=255)
   */
  private $phoneNo;
  
  /**
   * @var \DateTime
   *
   * @ORM\Column(name="dob", type="datetime")
   */
  private $dob;
  
  /**
   * @var string
   *
   * @ORM\Column(name="email", type="string", length=255)
   */
  private $email;
  
  /**
   * Get id
   *
   * @return int
   */
  public function getId() {
    return $this->id;
  }
  
  /**
   * Set firstName
   *
   * @param string $firstName
   *
   * @return AddressBook
   */
  public function setFirstName($firstName) {
    $this->firstName = $firstName;
    
    return $this;
  }
  
  /**
   * Get firstName
   *
   * @return string
   */
  public function getFirstName() {
    return $this->firstName;
  }
  
  /**
   * Set lastName
   *
   * @param string $lastName
   *
   * @return AddressBook
   */
  public function setLastName($lastName) {
    $this->lastName = $lastName;
    
    return $this;
  }
  
  /**
   * Get lastName
   *
   * @return string
   */
  public function getLastName() {
    return $this->lastName;
  }
  
  /**
   * Set street
   *
   * @param string $street
   *
   * @return AddressBook
   */
  public function setStreet($street) {
    $this->street = $street;
    
    return $this;
  }
  
  /**
   * Get street
   *
   * @return string
   */
  public function getStreet() {
    return $this->street;
  }
  
  /**
   * Set zip
   *
   * @param string $zip
   *
   * @return AddressBook
   */
  public function setZip($zip) {
    $this->zip = $zip;
    
    return $this;
  }
  
  /**
   * Get zip
   *
   * @return string
   */
  public function getZip() {
    return $this->zip;
  }
  
  /**
   * Set city
   *
   * @param string $city
   *
   * @return AddressBook
   */
  public function setCity($city) {
    $this->city = $city;
    
    return $this;
  }
  
  /**
   * Get city
   *
   * @return string
   */
  public function getCity() {
    return $this->city;
  }
  
  /**
   * Set country
   *
   * @param string $country
   *
   * @return AddressBook
   */
  public function setCountry($country) {
    $this->country = $country;
    
    return $this;
  }
  
  /**
   * Get country
   *
   * @return string
   */
  public function getCountry() {
    return $this->country;
  }
  
  /**
   * Set phoneNo
   *
   * @param string $phoneNo
   *
   * @return AddressBook
   */
  public function setPhoneNo($phoneNo) {
    $this->phoneNo = $phoneNo;
    
    return $this;
  }
  
  /**
   * Get phoneNo
   *
   * @return string
   */
  public function getPhoneNo() {
    return $this->phoneNo;
  }
  
  /**
   * Set dob
   *
   * @param \DateTime $dob
   *
   * @return AddressBook
   */
  public function setDob($dob) {
    $this->dob = $dob;
    
    return $this;
  }
  
  /**
   * Get dob
   *
   * @return \DateTime
   */
  public function getDob() {
    return $this->dob;
  }
  
  /**
   * Set email
   *
   * @param string $email
   *
   * @return AddressBook
   */
  public function setEmail($email) {
    $this->email = $email;
    
    return $this;
  }
  
  /**
   * Get email
   *
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }
  
}

