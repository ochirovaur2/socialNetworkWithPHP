<div class="container miniContainer">
  
  <div class="row">
    <div class="col-6">
      <h2>Недавние посты </h2>
      <?php displayTweets('public'); ?>
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