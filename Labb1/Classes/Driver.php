<?php

namespace App;

class Driver {
  const PATH = 'files/crash_report.csv';
  public $plannedRoute;
  private $next;
  private $crashReport;

  /**
   * Construct the driver
   * 
   * @return void
   */
  public function __construct() {
    // If the crash report file exists, set it
    if ($this->exists()) {
      $this->setCrashReport();
    }
  }

  /**
   * Check if the crash report extists
   * 
   * @return Boolean true | false
   */
  static function exists() {
    // Check if the file exists
    return file_exists(self::PATH);
  }
  /**
   * Remove the crash report
   * 
   * @return void
   */
  public function remove() {
    // Remove the file
    unlink(self::PATH);
  }

  /**
   * Drive the car
   * 
   * @return String The result of the drive
   */
  public function drive()
  {
    $road = new Road;
    // Get the current stretch index
    $index = count($this->plannedRoute) - 1;

    // Try to  match the stretch
    $match = $road->translate($this->next) === $road->translate($road->getRoad()[$index]);

    // Check if the drive was successful
    if ($match) {
      $result = 'Correct way!';
      Map::updateMap($this->next);
    } else {
      $result = 'Crash!';
      // Update crash info
      $this->writeCrashReport($index, $road->translate($this->next)); 
    }

    // Return the result
    return $result;
  }

  /**
   * Plan the next drive
   * 
   * @return Array The planned route to drive
   */
  public function planDrive()
  {
    // Declare the route placeholder
    $route = [];

    // Get the map if the map exists
    $map = new Map;
    if ($map->exists()) {
      $route = $map->getMap();
    }

    // Guess the next stretch
    $route[] = $this->guessNext($route);

    // Set the planned route
    $this->plannedRoute = $route;

    // Return the driver object
    return $this;
  }

  /**
   * Guess the next strech
   * 
   * @param Array $knownStretches The known route of the road
   * 
   * @return Array A stretch to try
   */
  private function guessNext(Array $knownStretches)
  {
    // Get the necessary road information
    $stretches = Road::STRETCHES;
    $options = Road::STRETCH_OPTIONS;
    $pieces = Road::STRETCH_PIECES;

    // Turn limiter
    $lastTurns = [];

    // If the map exists check the last turns
    if (Map::exists()) {
      foreach ($knownStretches as $stretch) {
        $road = new Road;

        if ($road->translate($stretch) !== 'straight') {
          $lastTurns = array_reverse($lastTurns);

          count($lastTurns) > 0
            ? $lastTurns[1] = $road->translate($stretch)
            : $lastTurns[] = $road->translate($stretch);
        }

        $pieces[$road->translate($stretch)]--;
      }
    }

    // If the last two turns are the same, remove it from the options
    if (count($lastTurns) > 1 && $lastTurns[0] === $lastTurns[1]) {
      array_splice($options, array_search($lastTurns[0], $options), 1);
    }

    // Check if there are any pieces of stretch that have been used up,
    // if so remove it from the options
    foreach ($options as $option) {
      if ($pieces[$option] === 0) {
        array_splice($options, array_search($option, $options), 1);
      }
    }

    // Check of there is any crashes on the stretch
    if ($this->exists()) {
      foreach($this->crashReport AS $crash) {
        if ((int)$crash[0] === count($knownStretches)) {
          array_splice($options, array_search($crash[1], $options), 1);
        }
      }
    }

    // Guess the next stretch to take
    $next = $stretches[$options[array_rand($options)]];

    // Set the next stretch to try
    $this->next = $next;

    // Return the next stretch
    return $next;
  }

  /**
   * Write note about last crash
   * 
   * @param Int $stretch The current stretch index
   * @param String $wrongWay The stretch that made the driver crash
   * 
   * @return void
   */
  private function writeCrashReport(Int $stretch, String $wrongWay) {
    // Open the crash report csv file
    $file = fopen(self::PATH, 'a+');

    // Add the stretch index and the crash
    fputcsv($file, [$stretch, $wrongWay]);

    // Close the crash report file
    fclose($file);
  }

  /**
   * Set the crash report
   * 
   * @return void
   */
  private function setCrashReport() {
    // Open the file
    $file = fopen(self::PATH, 'r');
    
    // Set the crash report
    while (!feof($file)) {
      $content = fgetcsv($file);

      if (!empty($content)) {
        $this->crashReport[] = $content;
      }
    }

    // Close the CSV file
    fclose($file);
  }
}
