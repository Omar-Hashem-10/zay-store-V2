<?php

$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

function get_all($table_name)
{
  global $conn;
  $sql = "SELECT * FROM `$table_name`";
  return mysqli_query($conn, $sql);
}

function get_row($table_name, $id)
{
  global $conn;
  $sql = "SELECT * FROM `$table_name` WHERE id = '$id'";
  return mysqli_query($conn, $sql);
}

function get_featured($table_name, $featured)
{
  global $conn;
  $sql = "SELECT * FROM `$table_name` WHERE `featured_product` = '$featured'";
  return mysqli_query($conn, $sql);
}

function get_month($table_name, $month)
{
  global $conn;
  $sql = "SELECT * FROM `$table_name` WHERE `category_month` = '$month'";
  return mysqli_query($conn, $sql);
}