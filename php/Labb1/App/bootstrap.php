<?php

// Get all class files
$classes = scandir('Classes');

// Make sure it's only PHP files in array
$classes = array_filter($classes, function($class) {
  return explode('.', $class)[1] === 'php';
});

// Require each class
foreach ($classes AS $class) {
  require 'Classes/' . $class;
}