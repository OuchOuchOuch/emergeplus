<?php get_header(); ?>

    <div id="main" class="container" style="padding:0 20px;">
      <div class="row-fluid">
      <div class="span8">

<?php
//$query_string = "";
//query_posts($query_string . '&category__not_in=4');

if (have_posts()) :
  while (have_posts()) : the_post();
?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="content-box">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <p class="post-meta">
              <span class="post-date"><?php the_date(); ?></span>
              <span class="category">カテゴリー - <?php the_category(', ') ?></span>
            </p>
            
            <?php the_content();
              $args = array(
                'before' => '<div class="page-link">',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                );
                wp_link_pages($args);
            ?>

            <p class="footer-post-meta">
              <?php the_tags('Tag : ', ', '); ?>
              <span class="post-author">作成者： <a href=
                  "<?php echo get_author_posts_url(get_the_author_meta('ID'));
                  ?>"><?php echo get_the_author(); ?></a></span>
            </p>

            <ul class="pager" style="padding-top: 20px;">
            <?php
            if (get_previous_post()) :
            ?>
              <li class="previous">
                <?php previous_post_link('%link', '&laquo; %title'); ?>
              </li>
            <?php
            endif;
            if (get_next_post()) :
            ?>
              <li class="next">
                <?php next_post_link('%link', '&raquo; %title'); ?>
              </li>
            <?php
            endif;
            ?>
            </ul>
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

