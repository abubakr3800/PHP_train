<?php

// ✅ Task 6: API with Course class
class CourseAPI {
  private $title;
  private $duration;
  private $isPublished = false;

  public function __construct($title, $duration) {
    $this->title = $title;
    $this->duration = $duration;
  }

  public function publish() {
    $this->isPublished = true;
  }

  public function toJson() {
    return json_encode([
      'title' => $this->title,
      'duration' => $this->duration,
      'published' => $this->isPublished
    ]);
  }
}