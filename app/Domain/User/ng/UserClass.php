<?php

namespace App\Domain\User\Ng;

use Coyote\Domain\User\User;

class UserClass extends User
{
  public function __construct(
    public string $username,
    public string $email,
  )
  {
    $u = new User(false,null,null,null);
  }

  public function getUserObject($u){
    return $u;
  }

  /**
   * @return mixed (0 => not logged; 1 => logged)
   */
  public function isUserLogged(){
    return $this->loggedIn;
  }
}
