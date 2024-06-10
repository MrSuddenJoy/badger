<?php
namespace App\Domain\Github;

class GithubStars2
{

  public $t = "Sample text";

  public function annTest(){
    $ghs = new GithubStars();
    $ghs->fetchStars();
  }
}
