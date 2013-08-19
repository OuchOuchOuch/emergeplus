<?php get_header(); ?>

    <div id="main" class="container" style="padding:0 20px;">
      <div class="row-fluid">
      <div class="span8">
<?php

if (have_posts()) :
  while (have_posts()) : the_post();
?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="content-box">
            <h4 class="caption"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <p class="post-meta">
              <span class="post-date"><?php the_date(); ?></span>
              <span class="category">カテゴリー - <?php the_category(', ') ?></span>
            </p>
              <?php the_excerpt(); ?>
              <p class="more-link">
                <a href="<?php the_permalink() ?>" 
                   title="「<?php the_title(); ?>」の続きを読む">続きを読む &raquo;</a>
              </p>
          </div><!-- cotent-box-->
        </div><!-- posts -->
        <hr>
<?php
  endwhile;
else:
?>
        <div class="post">
          <h4>記事はありません</h4>
          <p>お探しの記事は見つかりませんでした。</p>
        </div>
<?php
endif;
?>
      </div>
      <div class="span4">
        <?php get_sidebar(); ?>
      </div>
      </div><!-- row-fluid -->

    </div><!-- main -->

<?php get_footer(); ?>

