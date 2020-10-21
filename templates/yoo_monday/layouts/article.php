
<?php
$view = $this['system']->application->input->get('view');

$this_tag = '';
$tag_class = '';
$tag_colors = $this['config']->get('tag_colors', array());

if (is_array($tags)) {
    foreach ($tags as $i => $tag) {
        foreach ($tag_colors as $color) {
            if (in_array(strtolower($tag['title']), array_map('strtolower', $color))) {
                $tag_class = $color['color'];
                $this_tag = $tag;
                unset($tags[$i]);
            }
        }
    }

    $tags = array_values($tags);
}

if ($author || $date || $category) {
    $author   = ($author && $author_url) ? '<a href="'.$author_url.'">'.$author.'</a>' : $author;
    $date     = ($date) ? ($datetime ? '<time datetime="'.$datetime.'">'.JHtml::_('date', $date, JText::_('DATE_FORMAT_LC3')).'</time>' : JHtml::_('date', $date, JText::_('DATE_FORMAT_LC3'))) : '';
    $category = ($category && $category_url) ? '<a href="'.$category_url.'">'.$category.'</a>' : $category;
}

?>

<article class="uk-article tm-article <?php echo ($this['config']->get('article_box')) ? ' tm-article-box ' : ''; ?> <?php echo $tag_class; ?>" <?php if ($permalink) echo 'data-permalink="'.$permalink.'"'; ?>>

	<?php if ($image) : ?>
		<?php if ($view === 'category' || $view === 'tag' || $view === 'featured') : ?>
		<div class="uk-grid uk-grid-width-large-1-2 uk-grid-collapse" data-uk-grid-margin>
		<?php endif; ?>

			<div class="uk-position-relative <?php echo (($view === 'category' || $view === 'featured') && $image_alignment == 'right') ? 'uk-flex-order-last-large' : ''; ?>">
				<div class="uk-position-cover tm-article-image" style="background-image: url(<?php echo $image ?>); background-size: cover; background-position: 50% 50%;"></div>
				<img class="uk-invisible" src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
				<?php if ($url) : ?>
					<a href="<?php echo $url; ?>" class="uk-position-cover"></a>
				<?php endif; ?>
			</div>

	<?php endif; ?>

	<div class="tm-article-container <?php echo ($image && $view === 'article') ? 'tm-margin-xlarge-top' : ''; ?>">

        <?php if ($title || $author || $date || $category || $this_tag) : ?>
		<div class="<?php echo ($view === 'article') ? 'uk-text-center': ''; ?> uk-margin-large-bottom">

			<?php if ($this_tag) : ?>
			<span class="uk-badge"><?php echo $this_tag['link']; ?></span>
			<?php endif; ?>

			<?php if ($title) : ?>
		    <h1 class="uk-article-title uk-margin-top-remove">
                <?php if ($url && $title_link) : ?>
                    <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                <?php else : ?>
                    <?php echo $title; ?>
                <?php endif; ?>
            </h1>
			<?php endif; ?>

			<?php if ($author || $date || $category) : ?>
			<p class="uk-article-meta uk-margin-bottom-remove">

				<?php

					if ($view === 'category' || $view === 'featured') {
						if ($date) { echo '<span>' .$date. '</span>'; }
						if ($category) { echo '<span>' .$category. '</span>'; }
					}

					if ($view === 'article') {
						if ($author) {
							printf('<span>'.JText::_('TPL_WARP_META_AUTHOR').'</span>', $author);
						}
						if ($date) {
							echo ' ';
							echo '<span>' .$date. '</span>';
						}

						if ($category) {
							echo ' ';
							printf('<span>'.JText::_('TPL_WARP_META_CATEGORY').'</span>', $category);
						}
					}
				?>

			</p>
			<?php endif; ?>

			<?php echo $hook_aftertitle; ?>

		</div>
		<?php endif; ?>

		<?php echo $hook_beforearticle; ?>

		<?php if ($article) : ?>
			<?php echo $article; ?>
		<?php endif; ?>

		<?php if ($tags && $view === 'article') : ?>
		<p>
    		<?php
    			echo JText::_('TPL_WARP_TAGS').': ';
    			foreach ($tags as $i => $tag) {
    				echo ($i > 0) ? ', ' : '';
    				echo $tag['link'];
    			}
    		?>
		</p>
		<?php endif; ?>

		<?php if ($more) : ?>
		<p class="uk-margin-large-top">
			<a class="tm-button-arrow" href="<?php echo $url; ?>" title="<?php echo $title; ?>"></a>
		</p>
		<?php endif; ?>

		<?php if ($edit) : ?>
		<p><?php echo $edit; ?></p>
		<?php endif; ?>

		<?php if ($this['config']->get('article_meta', false) && ($date_published || $date_modified || $hits)) : ?>
			<?php
				$date_published = ($date_published) ? JHtml::_('date', $date_published, JText::_('DATE_FORMAT_LC3')) : '';
				$date_modified = ($date_modified) ? JHtml::_('date', $date_modified, JText::_('DATE_FORMAT_LC3')) : '';
			?>
			<ul class="uk-list">
				<?php if ($date_published) : ?>
					<li><?php printf(JText::_('COM_CONTENT_PUBLISHED_DATE_ON'), $date_published); ?></li>
				<?php endif; ?>

				<?php if ($date_modified) : ?>
					<li><?php printf(JText::_('COM_CONTENT_LAST_UPDATED'), $date_modified); ?></li>
				<?php endif; ?>

				<?php if ($hits) : ?>
					<li><?php printf(JText::_('COM_CONTENT_ARTICLE_HITS'), $hits); ?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>

		<?php if ($previous || $next) : ?>
			<ul class="uk-pagination">
				<?php if ($previous) : ?>
				<li class="uk-pagination-previous">
					<a href="<?php echo $previous; ?>"><i class="uk-icon-angle-double-left"></i> <?php echo JText::_('JPREV'); ?></a>
				</li>
				<?php endif; ?>

				<?php if ($next) : ?>
				<li class="uk-pagination-next">
					<a href="<?php echo $next; ?>"><?php echo JText::_('JNEXT'); ?> <i class="uk-icon-angle-double-right"></i></a>
				</li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>

		<?php echo $hook_afterarticle; ?>

	</div>

	<?php if ($image && ($view === 'category' || $view === 'tag' || $view === 'featured')) : ?>
	</div>
	<?php endif; ?>

</article>
