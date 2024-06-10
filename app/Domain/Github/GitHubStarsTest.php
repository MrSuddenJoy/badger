<?php

namespace App\Domain\Github;

/**
 * @access public
 * @author MrSuddenJoy
 * @coversNothing
 * @license MIT
 */
class GitHubStarsTest {

  public function testFetchingStars() {
    $ghs = new GitHubStars() ;
    $a = assert( $ghs->fetchStars(1));
    if (gettype($a) == "int") {
      return true;
  }
}
?>
