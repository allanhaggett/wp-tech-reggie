<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

$description = get_the_archive_description();

?>

<?php if ( have_posts() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header alignwide">
	
		<h1>Solutions</h1>
		
		<?php if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>
	</header><!-- .page-header -->
	
	<div class="entry-content">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div style="background: #f2f2f2; margin: .25em; padding: .5em;">
		<a href="<?= the_permalink() ?>"><?= the_title() ?></a>
		</div>
	<?php endwhile; ?>
	</div>


<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>
</article>
<?php get_footer(); ?>
