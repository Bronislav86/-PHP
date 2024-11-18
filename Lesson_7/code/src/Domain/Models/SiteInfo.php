<?php

namespace Geekbarins\Application1\Domain\Models;

class SiteInfo {
  private string $server;
  private string $phpVersion;
  private string $browserVersion;

  public function __construct()
  {
    $this->server = $_SERVER['SERVER_SOFTWARE'];
    $this->phpVersion = phpversion();
    $this->browserVersion = $_SERVER['HTTP_USER_AGENT'];
  }

  public function getServer(): string {
    return $this->server;
  }

  public function getPhpVersion(): string{
    return $this->phpVersion;
  }

  public function getBrowserVersion():string{
    return $this->browserVersion;
  }

  public function getInfo(): array{
    return [
      'server' => $this->getServer(),
      'phpVersion' => $this->getPhpVersion(),
      'browserVersion' => $this->getBrowserVersion()
    ];
  }
}