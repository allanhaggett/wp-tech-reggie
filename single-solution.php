<?php
/**
 * The template for displaying all pages of the Course content type. This is primarily
 * a copy of Twenty_Twenty_One's single.php but with added stuff in there and a lot of
 * theme-specific stuff deleted.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<header class="entry-header alignwide">

	<div>Solution</div>

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>


</header>

<div class="entry-content">

<div><?php the_terms( $post->ID, 'solstatuses', 'Status: ', ', ', ' ' ); ?></div>

<?php the_content(); ?>

<h3>Use Cases</h3>
<?php
$postids = explode(',',$post->related_usecases);
$args=array(
    'include'        => $postids,
    'post_type'      => 'usecases',
    'post_status'    => 'publish',
    'posts_per_page' => -1
);
$usecases = get_posts( $args );
foreach($usecases as $u): ?>
<div style="background: #f2f2f2; margin: .25em; padding: .5em;">
<a href="/tech-inventory/usecases/<?= $u->post_name ?>"><?= $u->post_title ?></a>
</div>
<?php
endforeach;
// WP_Post Object ( [ID] => 10 [post_author] => 1 [post_date] => 2021-05-17 21:40:16 [post_date_gmt] => 2021-05-17 21:40:16 [post_content] =>
// MS Teams is what we all use for video conferencing meetings.
// Features
// Does a bunch of things,
// Training
// We have a lot of training opportunities here.
// [post_title] => Microsoft Teams [post_excerpt] => [post_status] => publish [comment_status] => closed [ping_status] => closed [post_password] => 
// [post_name] => microsoft-teams [to_ping] => [pinged] => [post_modified] => 2021-05-17 21:42:19 [post_modified_gmt] => 2021-05-17 21:42:19 
// [post_content_filtered] => [post_parent] => 0 [guid] => https://lc.virtuallearn.ca/tech-inventory/?post_type=solutions&p=10 [menu_order] => 0 
// [post_type] => solutions [post_mime_type] => [comment_count] => 0 [filter] => raw ) 
?>
<?php if($post->related_solutions): ?>
<h3>Related Solutions</h3>
<?php
$postids = explode(',',$post->related_solutions);
$args=array(
    'include'        => $postids,
    'post_type'      => 'solutions',
    'post_status'    => 'publish',
    'posts_per_page' => -1
);
$solutions = get_posts( $args );
foreach($solutions as $s): ?>
<div style="background: #f2f2f2; margin: .25em; padding: .5em;">
<a href="/tech-inventory/solutions/<?= $s->post_name ?>"><?= $s->post_title ?></a>
</div>
<?php
endforeach;
// WP_Post Object ( [ID] => 10 [post_author] => 1 [post_date] => 2021-05-17 21:40:16 [post_date_gmt] => 2021-05-17 21:40:16 
// [post_content] => MS Teams is what we all use for video conferencing meetings....
// [post_title] => Microsoft Teams [post_excerpt] => [post_status] => publish [comment_status] => closed [ping_status] => closed [post_password] => 
// [post_name] => microsoft-teams [to_ping] => [pinged] => [post_modified] => 2021-05-17 21:42:19 [post_modified_gmt] => 2021-05-17 21:42:19 
// [post_content_filtered] => [post_parent] => 0 [guid] => https://lc.virtuallearn.ca/tech-inventory/?post_type=solutions&p=10 [menu_order] => 0 
// [post_type] => solutions [post_mime_type] => [comment_count] => 0 [filter] => raw ) 
?>
<?php endif ?>
</div><!-- .entry-content -->

<footer class="entry-footer default-max-width">

	<?php the_meta() ?>
	
</footer><!-- .entry-footer -->


</article><!-- #post-<?php the_ID(); ?> -->

	<?php


endwhile; // End of the loop.

get_footer();
