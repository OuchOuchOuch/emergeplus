<?php
/*
  Template Name: top
*/
?>
<?php get_header(); ?>

<?php $query_string = ""; ?>

<div id="banner" class="span12" style="margin: 20px;">
  <div style="position: relative; margin: 0px; padding: 0px;">
    <img class="img-rounded" src="<?php echo get_template_directory_uri(); ?>/img/ProjectBox_Image_G.jpg">
    <div style="position:absolute; top:20px; left:20px;">
      <img class="img-rounded" src="<?php echo get_template_directory_uri(); ?>/img/emergeplus_logo_2013_200px.gif">
    </div>
    <div style="position:absolute; top:80px; left:45px;">
      <h5 style="color: white;">クラウド ファクトリー</h5>
    </div>
  </div>
</div>

<div id="info-area" class="row" style="margin: 0 20px;">
  <div class="span12">
    <div id="info" class="container span6">
      <!--<h4 class="caption"><a href="<?php echo get_category_link('4'); ?>">お知らせ</a></h4>-->
      <h4 class="caption"><a href="/info">お知らせ</a></h4>
      <div class="alert alert-success">
<?php
query_posts($query_string . '&category__in=4&showposts=1');

if (have_posts()) :
  while (have_posts()) : the_post();
?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h5><?php the_title(); ?></h5>
            <!--<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>-->
              <?php the_excerpt(); ?>
              <p class="more-link">
                <a class="btn" href="<?php the_permalink() ?>" 
                   title="「<?php the_title(); ?>」の続きを読む">続きを読む &raquo;</a>
              </p>
        </div><!-- posts -->
<?php
  endwhile;
else:
?>
        <div class="info-post">
          <h4>記事はありません</h4>
          <p>お探しの記事は見つかりませんでした。</p>
        </div>
<?php
endif;
?>
      </div>
    </div>

    <div id="blog" class="container span6">
      <h4 class="caption"><a href="/blog">ブログ</a></h4>
      <div class="alert alert-info">
<?php
query_posts($query_string . '&category__not_in=4&showposts=1');


if (have_posts()) :
  while (have_posts()) : the_post();
?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h5><?php the_title(); ?></h5>
            <!--<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>-->
              <?php the_excerpt(); ?>
              <p class="more-link">
                <a class="btn" href="<?php the_permalink() ?>" 
                   title="「<?php the_title(); ?>」の続きを読む">続きを読む &raquo;</a>
              </p>
        </div><!-- posts -->
<?php
  endwhile;
else:
?>
        <div class="blog-post">
          <h4>記事はありません</h4>
          <p>お探しの記事は見つかりませんでした。</p>
        </div>
<?php
endif;
?>
      </div>
    </div>
  </div>
</div>

<div id="main" class="row" style="margin: 0 20px;">
  <div class="span12">
    <div id="main-left" class="container span6">
      <h4 class="caption"><a href="/laser-cutting-service">レーザー加工サービス</a></h4>
      <div class="alert alert-info">
      あなたのオリジナルアイデアを形にしてみませんか？<br/>
      Emerge+のレーザー加工サービスは個人のお客様に特化。<br/>
      オンラインで加工発注→加工品を発送する格安なシステムです。<br/>
      ご質問もメール・twitter・Facebookなどで細かく対応。<br/>
      Emerge+はあなたのクラウドファクトリーです。<br/><br/>
      <a class="btn" href="/laser-cutting-service">詳しくはこちら &raquo;</a>
      </div>
    </div>

    <div id="main-right" class="container span6">
      <h4 class="caption"><a href="/shop">ショップ</a></h4>
      <div class="alert alert-success">
      ArduinoエンクロージャのProjectBox for Arduinoを始めとしたEmerge+オリジナル商品や、
      個人で製作されているユニークな商品とのコラボレーション商品を販売しています。<br/>
      他では手に入らない、貴重なアイテムばかりです。<br/>
      数に限りがあるものもありますので、ご購入はお早めに！<br/><br/>
      <a class="btn" href="/shop">いらっしゃいませ！</a>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>

