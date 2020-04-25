<?php

namespace App;

class Driver {
  public $plannedRoute;
  private $next;

  /**
   * Drive the car
   * 
   * @return String The result of the drive
   */
  public function drive() {
    $road = new Road;
    $index = count($this->plannedRoute) - 1;

    $count = 0;
    for ($i = 0; $i < 3; $i++) {
      if ($this->next[$i] == $road->getroad()[$index][$i]) {
        $count++;
      }
    }

    if ($count === 3) {
      $result = 'Correct way!';
      Map::updateMap($this->next);
    } else {
      $result = 'Crash!';
      // Update crash info
    }

    return $result;
  }

  /**
   * Plan the next drive
   * 
   * @return Array The planned route to drive
   */
  public function planDrive() {
    $route = [];
    $map = new Map;
    if ($map->exists()) {
      $route = $map->getMap();
    }

    $route[] = $this->guessNext($route);

    $this->plannedRoute = $route;
    return $this;
  }

  /**
   * Guess the next strech
   * 
   * @param Array $knownStretches The known route of the road
   * 
   * @return Array A stretch to try
   */
  private function guessNext($knownStretches) {
    $options = Road::STRETCH_OPTIONS;
    $stretches = Road::STRETCHES;

    $next = $stretches[$options[array_rand($options)]];

    $this->next = $next;
    return $next;
  }

  // Log drive
}