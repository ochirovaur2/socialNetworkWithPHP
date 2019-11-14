<div class="container miniContainer">
  
  <div class="row">
    <div class="col-6">
      <h2>Посты тех, на кого вы подписались </h2>
      <?php displayTweets('isFollowing'); ?>
    </div>
    <div class="col-6">
      <?php displaySearch();
      ?>
      <hr>
      <?php displayTweetBox();
      ?>
    </div>
  </div>
</div>