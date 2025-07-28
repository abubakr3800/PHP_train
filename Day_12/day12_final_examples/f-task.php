<?php
function clean($val) {
  return strtolower(htmlspecialchars(trim($val)));
}