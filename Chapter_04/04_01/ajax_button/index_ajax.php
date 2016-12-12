<?php
  session_start();

  if(!isset($_SESSION['favorites'])) { $_SESSION['favorites'] = []; }

  function is_favorite($id){
      return in_array($id, $_SESSION['favorites']);
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Asynchronous Button</title>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <style>
      #blog-posts {
        width: 700px;
      }
      .blog-post {
        border: 1px solid black;
        margin: 10px 10px 20px 10px;
        padding: 6px 10px;
      }

      button.favorite-button,button.unfavorite-button {
        background: #0000FF;
        color: white;
        text-align: center;
        width: 70px;
      }
      button.favorite-button:hover,button.unfavorite-button:hover {
        background: #000099;
      }

      button.favorite-button{
          display: inline;
      }

      .favorite button.favorite-button{
          display: none;
      }


      button.unfavorite-button{
          display: none;
      }

      .favorite button.unfavorite-button{
          display: inline;
      }

      .favorite-heart{
          color: red;
          font-size: 2em;
          float: right;
          display: none;
      }

      .favorite .favorite-heart{
          display: block;
      }

    </style>
  </head>
  <body>
  <?php
//  $_SESSION['favorites']=[];
  echo join(',',$_SESSION['favorites'])  ;


  ?>
    <div id="blog-posts">
      <div id="blog-post-101" class="blog-post <?php if(is_favorite(101)) {echo ' favorite';} ?>">
          <span class="favorite-heart">&hearts;</span>
        <h3>Blog Post 101</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque nunc malesuada mauris fermentum commodo. Integer non pellentesque augue, vitae pellentesque tortor. Ut gravida ullamcorper dolor, ac fringilla mauris interdum id. Nulla porta egestas nisi, et eleifend nisl tincidunt suscipit. Suspendisse massa ex, fringilla quis orci a, rhoncus porta nulla. Aliquam diam velit, bibendum sit amet suscipit eget, mollis in purus. Sed mattis ultricies scelerisque. Integer ligula magna, feugiat non purus eget, pharetra volutpat orci. Duis gravida neque erat, nec venenatis dui dictum vel. Maecenas molestie tortor nec justo porttitor, in sagittis libero consequat. Maecenas finibus porttitor nisl vitae tincidunt.</p>
        <button class="favorite-button">Favorite</button>
        <button class="unfavorite-button">UnFavorite</button>

      </div>
      <div id="blog-post-102" class="blog-post<?php if(is_favorite(102)) {echo ' favorite';} ?>">
          <span class="favorite-heart">&hearts;</span>
          <h3>Blog Post 102</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque nunc malesuada mauris fermentum commodo. Integer non pellentesque augue, vitae pellentesque tortor. Ut gravida ullamcorper dolor, ac fringilla mauris interdum id. Nulla porta egestas nisi, et eleifend nisl tincidunt suscipit. Suspendisse massa ex, fringilla quis orci a, rhoncus porta nulla. Aliquam diam velit, bibendum sit amet suscipit eget, mollis in purus. Sed mattis ultricies scelerisque. Integer ligula magna, feugiat non purus eget, pharetra volutpat orci. Duis gravida neque erat, nec venenatis dui dictum vel. Maecenas molestie tortor nec justo porttitor, in sagittis libero consequat. Maecenas finibus porttitor nisl vitae tincidunt.</p>
        <button class="favorite-button">Favorite</button>
        <button class="unfavorite-button">UnFavorite</button>

      </div>
      <div id="blog-post-103" class="blog-post<?php if(is_favorite(103)) {echo ' favorite';} ?>">
          <span class="favorite-heart">&hearts;</span>
          <h3>Blog Post 103</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque nunc malesuada mauris fermentum commodo. Integer non pellentesque augue, vitae pellentesque tortor. Ut gravida ullamcorper dolor, ac fringilla mauris interdum id. Nulla porta egestas nisi, et eleifend nisl tincidunt suscipit. Suspendisse massa ex, fringilla quis orci a, rhoncus porta nulla. Aliquam diam velit, bibendum sit amet suscipit eget, mollis in purus. Sed mattis ultricies scelerisque. Integer ligula magna, feugiat non purus eget, pharetra volutpat orci. Duis gravida neque erat, nec venenatis dui dictum vel. Maecenas molestie tortor nec justo porttitor, in sagittis libero consequat. Maecenas finibus porttitor nisl vitae tincidunt.</p>
        <button class="favorite-button">Favorite</button>
        <button class="unfavorite-button">UnFavorite</button>

      </div>
    </div>

    <script>
      function favorite() {
            var parent=this.parentElement;
          $.post('favorite.php',{id:parent.id},function (data,status,xhr) {
//              xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

              if(xhr.readyState == 4 && xhr.status == 200) {
                  var result = data;
                  if(result=='true'){
                      parent.classList.add("favorite")

                  }

                  console.log('Result: ' + result);
              }
          });


      }


      function unfavorite() {
          var parent=this.parentElement;
          $.post('unfavorite.php',{id:parent.id},function (data,status,xhr) {
//              xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
              if(xhr.readyState == 4 && xhr.status == 200) {
                  var result = data;
                  if(result=='true'){
                      parent.classList.remove("favorite");

                      butt=this.getElementsByc('button');
//                       butt.style.

                  }

                  console.log('Result: ' + result);
              }
          });


      }


      var buttons = document.getElementsByClassName("favorite-button");
      var buttons2 = document.getElementsByClassName("unfavorite-button");

      for(i=0; i < buttons.length; i++) {
        buttons.item(i).addEventListener("click", favorite);
        buttons2.item(i).addEventListener("click", unfavorite);

      }

    </script>

  </body>
</html>
