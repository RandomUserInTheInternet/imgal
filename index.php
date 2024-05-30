<!DOCTYPE html>
<html>
<head>
<title>Gallery</title>
<link rel="stylesheet" href="styleshit.css"> 
<link rel="stylesheet" href="styletest.css">
<link rel="stylesheet" href="https://unpkg.com/css.gg@2.0.0/icons/css/link.css">
<style>
.typewriter h1 {
  color: #0fb800;
  overflow: hidden;
  border-right: .15em solid orange; 
  white-space: nowrap; 
  margin: 0 auto; 
  letter-spacing: .15em; 
  animation: 
    typing 2.8s steps(30, end) infinite,
    blink-caret .5s ;
}

/* The typing effect */
@keyframes typing {
  from { width: 0 }
  to { width: 40% }
}

/* The typewriter cursor effect */
@keyframes blink-caret {
  from, to { border-color: transparent }
  50% { border-color: orange }
}
</style>

</head>
<body>

<div class="container">
  <header class="header">
     <div class="typewriter">
      <h1><em>LOST IN WEB</em></h1>
      </div> 
  <a href="https://dav3.netlify.app" class="gg-link-button">
  <i class="gg-link">https://dav3.netlify.app</i>
</a>
  </header>
  <?php include "db_conn.php"; ?>

  <main>
    <button class="upload-button">Upload Image</button>
    <h2>Image Gallery</h2>
    <section class="image-gallery">
      <?php 
       $sql = "SELECT * FROM images ORDER BY id DESC";
       $res = mysqli_query($conn, $sql);

       if (mysqli_num_rows($res) > 0) {
         while ($images = mysqli_fetch_assoc($res)) { ?>
           <div class="image-item">
             <img src="uploads/<?=$images['image_url']?>">
           </div>
         <?php }
       }

       mysqli_close($conn);
      ?>
    </section>
  </main>

  <footer>
    <h4>NOT mobile friendly,<b><em> will fix soon<em><b></h4>
    <p>Start sharing your own images today and become part of my gallery hehe</p>
    <p>© 2023 Open gallery. All rights reserved.</p>
  </footer>
</div>

<div class="overlay"> <div class="box">
  <section class="upload">
  <h4> refresh to close upload image</4>
  <br>
  <br>
  <br>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="my_image" class="upload-button">
    <span class="upload-icon">&#128441;</span> Choose Image</label>
      <input type="file" name="my_image" id="my_image" style="display: none;">
      <input type="submit" name="submit" value="Upload"  class="upload-button2">
    </form>
  </section>
</div>
 


<script>
  const uploadButton = document.querySelector('.upload-button');
  const uploadBox = document.querySelector('.box');
  const overlay = document.querySelector('.overlay');
  const body = document.querySelector('body');

  uploadButton.addEventListener('click', () => {
    uploadBox.classList.add('box-visible');
    overlay.classList.add('visible'); // Add class to show overlay
    body.classList.add('no-scroll'); // Prevent scrolling
  });
</script>

</body>
</html>
