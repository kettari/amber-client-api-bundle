<?php

namespace Amber\ClientApiBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Authentication
{
  /**
   * @var boolean
   * @Assert\Type(
   *   type="boolean",
   *   message="Authenticated must be boolean"
   * )
   * @Assert\NotBlank(
   *   message="Authenticated can't be blank"
   * )
   */
  private $authenticated;

  /**
   * @return bool
   */
  public function isAuthenticated(): bool
  {
    return $this->authenticated;
  }

  /**
   * @param bool $authenticated
   * @return \Amber\ClientApiBundle\Entity\Authentication
   */
  public function setAuthenticated(bool $authenticated): Authentication
  {
    $this->authenticated = $authenticated;

    return $this;
  }
}