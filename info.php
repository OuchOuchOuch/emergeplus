<?php
/*
  Template Name: info
*/
?>
<?php get_header(); ?>

  <div id="main" class="container span12" style="margin-bottom: 20px;">

      <table>
      <tr>
      <td class="span3">
        <a href="/">
          <img class="img-rounded" src="<?php echo get_template_directory_uri(); ?>/img/emergeplus_logo_2013_200px.gif">
        </a>
      </td>
      <td class="offset2 span7" style="padding-top: 10px; padding-left: 10px;">
        <h3 class="caption"><?php the_title(); ?></h3>
      </td>
      </tr>
      </table>
      <hr>

      <div class="row-fluid">

      <div class="span3">
        <?php get_sidebar(); ?>
      </div>
      <div class="span8" style="padding-left: 20px;">

<?php
$query_string = "";
query_posts($query_string . '&category__in=4');

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
      </div><!-- row-fluid -->

    </div><!-- main -->

<?php get_footer(); ?>

