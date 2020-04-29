<?php

abstract class Menu {
  protected $name;
  protected $items;
  abstract function render();

  public function __construct(String $name, Array $items) {
    $this->name = $name;
    $this->items = $items;
  }
}

class VerticalMenu extends Menu {
  public function render() {
    $menu = "<ul style='list-style-type: none;'>";
    foreach ($this->items AS $item) {
      $menu .= "<li><a href='/$item'>$item</a></li>";
    }
    $menu .= "</ul>";

    return $menu;
  }
}

class HorizontalMenu extends Menu {
  public function render() {
    $menu = "";
    foreach ($this->items AS $item) {
      $menu .= "<a href='/$item' style='display: inline-block; padding: 5px;'>$item</a>";
    }

    return $menu;
  }
}

$menuItems = [
  'Hem',
  'Sida 1',
  'Sida 2'
];


$vertical = new VerticalMenu('horizontal', $menuItems);
echo "<h3>Vertical menu</h3>", $vertical->render();

$horizontal = new HorizontalMenu('horizontal', $menuItems);
echo "<h3>Horizontal menu</h3>", $horizontal->render();