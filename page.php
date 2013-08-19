<?php get_header(); ?>

  <div id="main" class="container span12" style="margin-bottom: 20px;">

<?php
  if (have_posts()):
    while (have_posts()): the_post();
?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
        <div id="sidebar" class="container span3">
          <?php
            if($post->post_parent)
              $children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0');
            else
              $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
            if ($children) {
          ?>
          <ul class="nav nav-tabs nav-stacked">
            <?php echo $children; ?>
          </ul>
          <?php
            } // if ($children)
          ?>
          <div class="alert-info" style="padding-left:13px;">営業日</div>
          <div align="center">
          <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=240&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=emergeplus.jp_k1j8mdm7k5loipptj00oulrr20%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Asia%2FTokyo" style=" border-width:0 " width="200" height="240" frameborder="0" scrolling="no">
          </iframe>
          </div>
        </div><!-- sidebar -->

        <div id="contents" class="container span8">
          <div class="alert alert-info">
            <strong>お知らせ：</strong>現在受注が立て込んでおり、発送はご入金確認後、7営業日以内となっております。
          </div>
          <?php the_content(); ?>
        </div><!-- posts -->
        </div>
      </div>

<?php
  endwhile;
else:
?>

      <div class="post page">
        <h3>ページがありません</h3>
        <p>お探しのページが見つかりませんでした。</p>
      </div>

<?php
endif;
?>

    </div><!-- main -->

<?php get_footer(); ?>

