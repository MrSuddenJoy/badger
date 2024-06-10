<?php
namespace App\Domain\Github;

class GithubStars
{
  public function fetchStars(): int
  {
    $noStars = 0;
    $result = @\file_get_contents('https://api.github.com/repos/MrSuddenJoy/4programmers.net', false, stream_context_create([
    'http' => ['header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36'], ]));
      if ($result !== false) {
        $data = @\json_decode($result, true);
        if ($data !== null) {
          return $data['stargazers_count'];
        } else {
        // echo($noStars);
        return $noStars;
        }}
  }

/*   public function checkIPs(){
    $ghs2 = new GithubStars2();
    $ghs2->usageFromAllowedIPS();
  } */
}
