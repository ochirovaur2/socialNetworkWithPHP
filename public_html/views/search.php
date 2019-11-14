<div class="container miniContainer">
  
  <div class="row">
    <div class="col-6">
      <h2>Результаты поиска </h2>
      <?php displayTweets('search'); ?>
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