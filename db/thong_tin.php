<?php
  $sql = "SELECT *FROM users_admin ";
  $result = mysqli_query($conn, $sql);
  $res = mysqli_fetch_assoc($result);
  $_SESSION['users_name']=$res['users_name'];

  $user = $_SESSION['users_name'];
