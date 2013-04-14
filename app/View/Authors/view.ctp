<div class="authors view">
	<h2><?php  echo h($author['Author']['name']); ?></h2>
</div>

<h3>Related Series</h3>
<?php
	if (!empty($series)) {
		foreach ($series as $key => $value) {
			echo $this->Html->link($key, array('controller' => 'series', 'action' => 'view', $value));
		}
	} else {
		echo "No series";
	}
?>

<h3>Related Books</h3>
<?php foreach ($author['Book'] as $key => $book): ?>
	<div class="book-row">
		<?php if ($book['has_cover']): ?>
			<a class="fancybox" href="<?php echo $this->Image->resizeUrl($book['path'], $this->Image->resizeSettings['fancybox']); ?>" data-fancybox-group="gallery" title="<?php echo $book['sort']; ?>">
				<?php echo $this->Image->thumbnail($book['path'], 'index'); ?>
			</a>
		<?php else: ?>
			<span class="img-rounded pull-left cover">No Cover</span>
		<?php endif; ?>
		<div class="btn-group btn-group-vertical pull-right">
			<?php foreach ($book['Datum'] as $file): ?>
				<button type="button" class="btn"><?php echo $this->Html->link($file['format'], $this->Html->url(DS . 'calibre-library' . DS . $book['path'] . DS . $file['name'] . '.' . strtolower($file['format']), true)); ?></button>
			<?php endforeach; ?>
		</div>
		<div>
			<h5><?php echo $this->Html->link($book['sort'], array('controller'=>'books', 'action'=>'view', $book['id'])); ?></h5>
		</div>
		<?php
			echo $this->Txt->definition(array(__('Series') => $this->Txt->habtmLinks($book['Series'], 'series')));
			echo $this->Txt->definition(array(__('Year') => $this->Time->format('Y', $book['pubdate'])));
			echo $this->Txt->definition(array(__('Rating') => $this->Txt->rating($book['Rating'])));
			echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
			echo $this->Txt->definition(array(__('Tags') => $this->Txt->habtmLinks($book['Tag'], 'tags')));
		?>
	</div>
<?php endforeach; ?>

<script type="text/javascript">
	console.log('variable');
	$(document).ready(function() {
		$(".fancybox").fancybox({
			helpers: {
				title : null
			}
		});
	});
</script>