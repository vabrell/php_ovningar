<?php

namespace App;

class Map {
  const PATH = 'files/map.csv';
  protected $map;

  /**
   * Construct the map
   */
  public function __construct() {
    $this->setMap();
  }
  
  /**
   * Check if the map exists
   * 
   * @return Boolean true | false
   */
  static function exists() {
    return file_exists(self::PATH);
  }

  /**
   * Get the map
   * 
   * @return Array The map
   */
  public function getMap() {
    return $this->map;
  }

  /**
   * Update the map with road
   * 
   * @return void
   */
  public function updateMap($roadPieces) {
    // Open the CSV map file
    $file = fopen(self::PATH, 'a+');

    // Add a piece of road
    fputcsv($file, $roadPieces);

    // Close the CSV map file
    fclose($file);
  }

  /**
   * Set the map from CSV file
   * 
   * @return void
   */
  private function setMap() {
    // If the file doesn't exist; exit
    if (!file_exists(self::PATH)) return;

    // Open the CSV file
    $file = fopen(self::PATH, 'r');

    // Set the map
    while (!feof($file)) {
      $content = fgetcsv($file);

      if (!empty($content)) {
        $this->map[] = $content;
      }
    }

    // Close the CSV file
    fclose($file);
  }

  /**
   * Remove the map
   * 
   * @return void
   */
  public function removeMap() {
    unlink(self::PATH);
  }
}