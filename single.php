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
            
            <?php the_content(); ?>
            <?php
              $args = array(
                'before' => '<div class="page-link">',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                );
                wp_link_pages($args);
            ?>

            <?php
              if (!in_category('shopitem')) :
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
                <?php 
                  previous_post_link_short(
                    $format='%link',
                    $link='&laquo; %title', 
                    $in_same_cat=false,
                    $excluded_categories='',
                    $length=24);                
                ?>
              </li>
            <?php
            endif;
            if (get_next_post()) :
            ?>
              <li class="next">
                <?php 
                  next_post_link_short(
                    $format='%link',
                    $link='%title &raquo;', 
                    $in_same_cat=false,
                    $excluded_categories='',
                    $length=24);                
                ?>
              </li>
            <?php
            endif;
            ?>
            </ul>
            <?php
            endif;
            ?>

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

