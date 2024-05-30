<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
  include "db_conn.php";

  // Remove debugging line (not needed in production)
  // echo "<pre>";
  // print_r($_FILES['my_image']);
  // echo "</pre>";

  $img_name = $_FILES['my_image']['name'];
  $img_size = $_FILES['my_image']['size'];
  $tmp_name = $_FILES['my_image']['tmp_name'];
  $error = $_FILES['my_image']['error'];

  if ($error === 0) {
    if ($img_size > 5242880) { // 5 MB in bytes (1024 * 1024 * 5)
      $error_message = "Sorry, your file is too large. Please keep it under 5 MB.";
    } else {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);

      $allowed_exs = array("jpg", "jpeg", "png");

      if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $img_upload_path = 'uploads/' . $new_img_name;

        // Move the uploaded file
        if (move_uploaded_file($tmp_name, $img_upload_path)) {

          // Use prepared statement for security
          $stmt = mysqli_prepare($conn, "INSERT INTO images(image_url) VALUES (?)");
          mysqli_stmt_bind_param($stmt, "s", $new_img_name);
          mysqli_stmt_execute($stmt);

          // Close prepared statement and connection (optional)
          mysqli_stmt_close($stmt);
          mysqli_close($conn);

          // Success message
          $success_message = "Image uploaded successfully!";
          header("Location: index.php?success=$success_message");

        } else {
          $error_message = "Failed to upload image.";
        }
      } else {
        $error_message = "You can only upload files of type JPG, JPEG, or PNG.";
      }
    }
  } else {
    // Provide a more specific error message based on the error code
    switch ($error) {
      case UPLOAD_ERR_INI_SIZE:
        $error_message = "The file exceeds the upload limit.";
        break;
      case UPLOAD_ERR_FORM_SIZE:
        $error_message = "The file exceeds the upload limit set in the form.";
        break;
      case UPLOAD_ERR_PARTIAL:
        $error_message = "The uploaded file was only partially uploaded.";
        break;
      case UPLOAD_ERR_NO_TMP_DIR:
        $error_message = "Missing a temporary folder.";
        break;
      case UPLOAD_ERR_CANT_WRITE:
        $error_message = "Failed to write file to disk.";
        break;
      case UPLOAD_ERR_EXTENSION:
        $error_message = "A PHP extension stopped the file upload.";
        break;
      default:
        $error_message = "Unknown upload error.";
    }
  }

  if (isset($error_message)) {
    header("Location: index.php?error=$error_message");
  }
} else {
  header("Location: index.php");
}
