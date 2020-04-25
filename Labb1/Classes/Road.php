<?php

namespace App;

class Road {
  const PATH = 'files/road.csv';
  const STRETCHES = [
    "left" => [1,0,0],
    "straight" => [0,1,0],
    "right" => [0,0,1]
  ];
  const STRETCH_OPTIONS = ['left', 'straight', 'right'];
  
  protected $road;

  /**
   * Construct the Road
   */
  public function __construct() {
    $this->setRoad();
  }

  /**
   * Remove the road
   * 
   * @return void
   */
  public function removeRoad() {
    unlink(self::PATH);
  }

  /**
   * Check if the road exists
   * 
   * @return Boolean true | false
   */
  static function exists() {
    return file_exists(self::PATH);
  }

  /**
   * Generate a new road
   * 
   * @return void
   */
  public function generate() {
    // If the road already exists; exit
    if ($this->exists()) return;

    // Roads placeholder
    $roads = [];

    // Amount of road stretches to use
    $roadStretches = [
      'left' => 4,
      'straight' => 4,
      'right' => 4
    ];

    // The turn limiter
    $lastTurn = null;
    $turn = 0;

    // Generate 12 stretches
    for ($i = 0; $i < 12; $i++) {
      $options = self::STRETCH_OPTIONS;
      $stretches = self::STRETCHES;

      if ($turn === 2) {
        array_splice($options, array_search($lastTurn, $options), 1);
      }

      foreach ($options AS $option) {
        if ($roadStretches[$option] = 0) {
          array_splice($options, array_search($option, $options), 1);
        }
      }

      $stretch = $options[array_rand($options)];

      if ($stretch !== 'straight') {
        if ($stretch === $lastTurn) {
          $turn = 2;
        } else {
          $lastTurn = $stretch;
          $turn = 1;
        }
      }

      $roadStretches[$stretch]--;
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
  private function translate($stretch) {
    foreach (self::STRETCHES AS $key => $value) {
      $count = 0;
      for ($i = 0; $i < 3; $i++) {
        if ($stretch[$i] == $value[$i]) {
          $count++;
        }
      }

      if ($count === 3) {
        return ucfirst($key);
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
    if (!file_exists(self::PATH)) return;

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