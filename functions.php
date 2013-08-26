<?php
/****************************************

		functions.php

*****************************************/

function wpbootstrap_scripts_with_jquery()
{
// Register the script like this for a theme:
wp_register_script(
  'custom-script', get_template_directory_uri().'/bootstrap/js/bootstrap.js', array('jquery'));
// For either a plugin or a theme, you chan then enqueue the script:
wp_enqueue_script('custom-script');
}
add_action('wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery');


// <head>内に RSSフィードのリンクを表示するコード
add_theme_support( 'automatic-feed-links' );

function new_excerpt_more($more)
{
return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// ダイナミックサイドバーを定義するコード（CHAPTER 11）
register_sidebar( array(
	'name' => 'サイドバーウィジット',
	'id' => 'sidebar-1',
	'description' => 'サイドバーのウィジットエリアです。デフォルトのサイドバーと丸ごと入れ替えたいときに使ってください。',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => ' <div class="alert-info" style="padding-left:13px;">',
  'after_title' => '</div>',
) );

// ダイナミックサイドバーを定義するコード（CHAPTER 11）
register_sidebar( array(
	'name' => 'サイドバーウィジット2',
	'id' => 'sidebar-2',
	'description' => 'サイドバーのウィジットエリアです。',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h3 class="widgettitle">',
  'after_title' => '</h3>',
) );

// 複数のダイナミックサイドバーを定義するコード（CHAPTER 11）
/*
register_sidebar(array(
	'name' => sprintf('サイドバーウィジット-2' ),
	'id' => 'sidebar-2',
	'description' => 'サイドバーのウィジットのテストです。',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
));
*/


// カスタムメニュー機能を有効にするコード（CHAPTER 12）
add_theme_support( 'menus' );

// カスタムメニューの「場所」を設定するコード
// register_nav_menu( 'header-navi', 'ヘッダーのナビゲーション' );
register_nav_menu( 'sidebar-1', 'サイドバーナビゲーション' );
// register_nav_menu( 'footer-navi', 'フッターのナビゲーション' );

remove_filter('the_content', 'wpautop');

function breadcrumb() {
global $post;
$str ='';
if(!is_front_page()&&!is_page_template('top.php')&&!is_admin()){ /* !is_admin は管理ページ以外という条件分岐 */
  $str.= '<ul class="breadcrumb" style="margin: 20px 80px">';
  $str.= '<li><a href="'. home_url() .'/">ホーム</a></li>';
  $str.= '<span class=devider> / </span>';
                        
  if(is_search()){
    $str.='<li>「'. get_search_query() .'」で検索した結果</li>';
  } elseif(is_tag()){
    $str.='<li>タグ : '. single_tag_title( '' , false ). '</li>';
  } elseif(is_date()){
    if(get_query_var('day') != 0){
      $str.='<li><a href="'. get_year_link(get_query_var('year')). '">' . get_query_var('year'). '年</a></li>';
      $str.='<span class=devider> / </span>';
      $str.='<li><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '">'. get_query_var('monthnum') .'月</a></li>';
      $str.='<span class=devider> / </span>';
      $str.='<li>'. get_query_var('day'). '日</li>';
    } elseif(get_query_var('monthnum') != 0){
      $str.='<li><a href="'. get_year_link(get_query_var('year')) .'">'. get_query_var('year') .'年</a></li>';
      $str.='<span class=devider> / </span>';
      $str.='<li>'. get_query_var('monthnum'). '月</li>';
    } else {
      $str.='<li>'. get_query_var('year') .'年</li>';
    }
  } elseif(is_category()) {
    $cat = get_queried_object();
    if($cat -> parent != 0){
      $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
      foreach($ancestors as $ancestor){
        $str.='<li><a href="'. get_category_link($ancestor) .'">'. get_cat_name($ancestor) .'</a></li>';
        $str.='<span class=devider> / </span>';
      }
    }
    $str.='<li>'. $cat -> name . '</li>';
  } elseif(is_author()){
    $str .='<li>投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</li>';
  } elseif(is_page()){
    if($post -> post_parent != 0 ){
      $ancestors = array_reverse(get_post_ancestors( $post->ID ));
      foreach($ancestors as $ancestor){
        $str.='<li><a href="'. get_permalink($ancestor).'">'. get_the_title($ancestor) .'</a></li>';
        $str.='<span class=devider> / </span>';
      }
    }
    $str.= '<li>'. $post -> post_title .'</li>';
        
  } elseif(is_attachment()){
    if($post -> post_parent != 0 ){
      $str.= '<li><a href="'. get_permalink($post -> post_parent).'">'. get_the_title($post -> post_parent) .'</a></li>';
      $str.='<span class=devider> / </span>';
    }
    $str.= '<li>' . $post -> post_title . '</li>';
  } elseif(is_single()){
    $categories = get_the_category($post->ID);
    $cat = $categories[0];
    if($cat -> parent != 0){
      $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
      foreach($ancestors as $ancestor){
        $str.='<li><a href="'. get_category_link($ancestor).'">'. get_cat_name($ancestor). '</a></li>';
        $str.='<span class=devider> / </span>';
      }
    }
    $str.='<li><a href="'. get_category_link($cat -> term_id). '">'. $cat-> cat_name . '</a></li>';
    $str.='<span class=devider> / </span>';
    $str.= '<li>'. $post -> post_title .'</li>';
  } elseif(is_404()){
    $str.='<li>404 Not found</li>';
  } else {
    $str.='<li>'. wp_title('', false) .'</li>';
  }
  $str.='</ul>';
}
echo $str;
}

?>
