<?php if( rs::getField('libero_quote') ) { ?>
<div class="libero-quote">
	<blockquote><?php echo rs::getField('libero_quote') ?></blockquote>
	<?php if( rs::getField('libero_quotesource') ) { ?>
	<cite class="text-right"><?php echo rs::getField('libero_quotesource') ?></cite>
	<?php } ?>
</div>
<?php } ?>
<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('large') ?></a>