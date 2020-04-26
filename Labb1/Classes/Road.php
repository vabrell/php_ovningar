<?php

namespace App;

class Road {
  const PATH = 'files/road.csv';
  const STRETCHES = [
    "left" => ['o','x','x'],
    "straight" => ['x','o','x'],
    "right" => ['x','x','o']
  ];
  const STRETCH_OPTIONS = ['left', 'straight', 'right'];
  const STRETCH_PIECES = [
    'left' => 4,
    'straight' => 4,
    'right' => 4
  ];
  
  protected $road;

  /**
   * Construct the Road
   */
  public function __construct() {
    // Get the road and set it
    $this->setRoad();
  }

  /**
   * Remove the road
   * 
   * @return void
   */
  public function remove() {
    // Remove the road file
    unlink(self::PATH);
  }

  /**
   * Check if the road exists
   * 
   * @return Boolean true | false
   */
  static function exists() {
    // Check if the road file exists
    return file_exists(self::PATH);
  }

  /**
   * Generate a new road
   * 
   * @return void
   */
  public function generate() {
    // If the road already exists; return
    if ($this->exists()) return;

    // Roads placeholder
    $roads = [];

    // Amount of road stretches to use
    $roadStretches = self::STRETCH_PIECES;

    // The turn limiter
    $lastTurns = [];

    // Generate the stretches
    for ($i = 0; $i < array_sum(array_values(self::STRETCH_PIECES)); $i++) {
      $options = self::STRETCH_OPTIONS;
      $stretches = self::STRETCHES;

      // Check if the last two turns are the same
      if (count($lastTurns) > 1 && $lastTurns[0] === $lastTurns[1]) {
        // Remove the turn from the options
        array_splice($options, array_search($lastTurns[0], $options), 1);
      }

      // Check if any of the stretch pieces are used up
      foreach ($options AS $option) {
        if ($roadStretches[$option] === 0) {
          array_splice($options, array_search($option, $options), 1);
        }
      }

      // Get a new stretch from the available options
      $stretch = $options[array_rand($options)];

      // Check if the new stretch is a turn
      if ($stretch !== 'straight') {
        // Reverse the turns so the last turn becomes the next to last turn
        $lastTurns = array_reverse($lastTurns);

        // Make sure there is at least one turn already
        count($lastTurns) > 0
          ? $lastTurns[1] = $stretch
          : $lastTurns[] = $stretch;
      }

      // Decrease the amount of stretch peices available
      $roadStretches[$stretch]--;

      echo " . $stretch<br>";

      // Add the new stretch to the road
      $roads[] = $stretches[$stretch];
    }

    // Open the csv file
    $file = fopen(self::PATH, 'a+');

    // Save the roads to the file
    foreach ($roads AS $road) {
      fputcsv($file, array_values($road));
    }

    // Close the csv file
    fclose($file);
  }

  /**
   * Get the road
   * 
   * @return Array The generated road
   */
  public function getRoad() {
    // Return the road
    return $this->road;
  }

  /**
   * Get stretches by name
   * 
   * @param Array $stretches The stretches that should be turned into their names
   * 
   * @return Array List of stretch names
   */
  public function getStretchesByName($stretches) {
    // Translate the list of stretches to a list of stretch names
    return array_map(function($stretch) {
      return $this->translate($stretch);
    }, $stretches);
  }

  /**
   * Translate the stretch to stretch name
   * 
   * @param Array $stretch The stretch to translate
   * 
   * @return String Left | Straight | Right
   */
  public function translate($stretch) {
    // Loop through the stretches
    foreach (self::STRETCHES AS $key => $value) {
      $count = 0;
      for ($i = 0; $i < 3; $i++) {
        if ($stretch[$i] === $value[$i]) {
          $count++;
        }
      }

      if ($count === 3) {
        return $key;
      }
    }
  }

  /**
   * Set road from CSV file
   * 
   * @return void
   */
  private function setRoad() {
    // If the file doesn't exist; exit
    if (!$this->exists()) return;

    // Open the CSV file
    $file = fopen(self::PATH, 'r');

    // Set the road
    while (!feof($file)) {
      $content = fgetcsv($file);

      if (!empty($content)) {
        $this->road[] = $content;
      }
    }

    // Close the CSV file
    fclose($file);
  }

}