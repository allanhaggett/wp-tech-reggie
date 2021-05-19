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

$title  = single_term_title( '', false );
?>

<?php if ( have_posts() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header alignwide">
	
		<h1><?= $title ?></h1>
		

		<?php if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>


	</header><!-- .page-header -->
	<div class="entry-content">
	<div class="alignwide">
	
	

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div style="background: #f2f2f2; margin: .25em; padding: .5em;">
		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
		</div>


	<?php endwhile; ?>
	<ul> 
    <?php
     wp_list_categories( array(
	 	'taxonomy' => 'usecase_categories',
        'orderby' => 'name',
		'title_li' => '',
        'depth' => -1
    ) );
    ?>
 </ul>
</div>
</div>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>
</article>
<?php get_footer(); ?>
