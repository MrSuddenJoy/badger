<?php
namespace App\Domain\Github;

class GithubStars2
{

  public $t = "Sample text";
  private $triggingPoint = 1;
  public $allowedIPs = array('192.168.0.1', '89.187.175.145');

  public function annTest(){
    $ghs = new GithubStars();
    $ghs->fetchStars();
  }

  /**
   * @return mixed
   */
  public function getMinAcc(){
    return $this->triggingPoint;
  }

  public function usageFromAllowedIPS(){
    print_r($this->allowedIPs);

    if (in_array($_SERVER['HTTP_HOST_IP'], $this->allowedIPs, false)){
      foreach ($this->allowedIPs as $ip) {
        echo($ip. 'is allowed');
      }  
    } else {
      die('Not allowed IP');
    }
  }
}
