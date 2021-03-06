<div class="sidebar" data-color="white" data-active-color="danger">
  <div class="logo">
    <a href="#" class="simple-text logo-mini">
      <div class="logo-image-small">
        <img src="assets/img/logo-small.png">
      </div>
    </a>
    <a href="#" class="simple-text logo-normal">
      PANASONIC
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li 
        <?php if (basename($_SERVER['PHP_SELF'])=='index.php')
        {
         echo 'class="active"';
        } else 
        {
         echo 'class=""'; 
        } 
        ?>
        >
        <a href="index">
          <i class="nc-icon nc-ambulance"></i>
          <p>LOADING ITEMS</p>
        </a>
      </li>
      <li 
        <?php if (basename($_SERVER['PHP_SELF'])=='daily_sales.php')
        {
         echo 'class="active"';
        } else 
        {
         echo 'class=""'; 
        } 
        ?>
        >
        <a href="daily_sales">
          <i class="nc-icon nc-book-bookmark"></i>
          <p>DAILY SALES</p>
        </a>
      </li>
      <li
        <?php if (basename($_SERVER['PHP_SELF'])=='category.php')
        {
         echo 'class="active"';
        } else 
        {
         echo 'class=""'; 
        } 
        ?>
        >
        <a href="category">
          <i class="nc-icon nc-bullet-list-67"></i>
          <p>ITEM CATEGORIES</p>
        </a>
      </li>
      <li
        <?php if (basename($_SERVER['PHP_SELF'])=='item.php')
        {
         echo 'class="active"';
        } else 
        {
         echo 'class=""'; 
        } 
        ?>
        >
        <a href="item">
          <i class="nc-icon nc-cart-simple"></i>
          <p>ITEMS</p>
        </a>
      </li>
      <?php if ($_SESSION["user_role"]==1): ?>

        <li 
          <?php if (basename($_SERVER['PHP_SELF'])=='profit.php')
          {
          echo 'class="active"';
          } else 
          {
          echo 'class=""'; 
          } 
          ?>
          >
          <a href="profit">
            <i class="nc-icon nc-book-bookmark"></i>
            <p>DAILY PROFIT</p>
          </a>
        </li>

      <?php else: ?>

       <li 
          <?php if (basename($_SERVER['PHP_SELF'])=='profit_user_view.php')
          {
          echo 'class="active"';
          } else 
          {
          echo 'class=""'; 
          } 
          ?>
          >
          <a href="profit_user_view">
            <i class="nc-icon nc-book-bookmark"></i>
            <p>DAILY PROFIT</p>
          </a>
        </li>

      <?php endif ?>
     
      
      <li
        <?php if (basename($_SERVER['PHP_SELF'])=='debt.php')
        {
         echo 'class="active"';
        } else 
        {
         echo 'class=""'; 
        } 
        ?>
        >
        <a href="debt">
          <i class="nc-icon nc-money-coins"></i>
          <p>DEBT COLLECTION</p>
        </a>
      </li>
      <li
        <?php if (basename($_SERVER['PHP_SELF'])=='credit.php')
        {
         echo 'class="active"';
        } else 
        {
         echo 'class=""'; 
        } 
        ?>
        >
        <a href="credit">
          <i class="nc-icon nc-money-coins"></i>
          <p>CREDIT COLLECTION</p>
        </a>
      </li>
     <li
        <?php  if (basename($_SERVER['PHP_SELF'])=='report.php')
        {
         echo 'class="active"';
        } else 
        {
          echo 'class=""'; 
        } 
        ?>
        >
        <a href="report">
          <i class="nc-icon nc-paper"></i>
          <p>SALES REPORT</p>
        </a>
      </li>
      <li
        <?php if (basename($_SERVER['PHP_SELF'])=='user.php')
        {
         echo 'class="active"';
        } else 
        {
         echo 'class=""'; 
        } 
        ?>
        >
        <a href="user">
          <i class="nc-icon nc-single-02"></i>
          <p>USER PROFILE</p>
        </a>
      </li>         
    </ul>
  </div>
</div>