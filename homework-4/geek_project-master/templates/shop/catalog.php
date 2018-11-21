<h1>Каталог:</h1>

<div id="content" style="display: flex; justify-content: flex-start; flex-wrap: wrap">
	<?php foreach ($products as $product): ?>
		<div class="card" style="width: 250px; margin: 0px 10px 20px 0px">
			<img class="card-img-top" src="/img/product.jpg" alt="Image">
			<div class="card-body">
				<h5 class="card-title"><?= $product['name'] ?></h5>
				<p class="card-text"><?= $product['description'] ?></p>
				<a href="#" class="btn btn-primary">Link</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>
<button class="btn btn-info" id="btn-moreGoods">Еще 25 товаров</button>
<script defer src="/js/request.js"></script>

