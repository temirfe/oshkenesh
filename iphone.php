<?

?>
<div class="touch">
<h3>Smooth</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>

<style>
    body {
      background: url('/images/iphone_bg.jpg');
    }

    div {
      width: 200px;
      height: 200px;
      margin-right: 20px;
      overflow-y: scroll; /* has to be scroll, not auto */
      float: left;
    }

    .touch {
      -webkit-overflow-scrolling: touch;
    }

    .module {
      width: 300px;
      height: 200px;

      overflow-y: scroll; /* has to be scroll, not auto */
      -webkit-overflow-scrolling: touch;
    }
</style>