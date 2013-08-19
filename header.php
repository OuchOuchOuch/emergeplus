<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
      if (is_single()):
        wp_title('::', true, 'right');
      endif;
      bloginfo('name');
    ?>
  </title>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
 
<?php
echo '<script type="text/javascript">var templatePath = "' . get_template_directory_uri() . '";</script>';
?>

<?php 
wp_enqueue_script('jquery');
wp_head();
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js"></script>
</head>

<body <?php body_class(); ?>>
  <div class="row-fluid">

    <div id="header" class="container span12">

      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
            <!--
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            -->
            <a class="brand" href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a>
              <ul class="nav">
                <?php wp_list_pages('title_li=&include=2657,2659,2663,2665'); ?>
              </ul>
              <form class="navbar-search pull-right" method="get" id="searchform" action="/">
                <input type="text" class="search-query" id="s" name="s" value="" placeholder="検索">
              </form>
          </div> <!-- container -->
        </div> <!-- navbar-inner -->
      </div> <!-- navbar -->

      <?php breadcrumb(); ?>
    </div><!-- header -->

