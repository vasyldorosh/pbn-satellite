<ul>
<?php foreach ($items as $item):?>
<li>
    <a href="/blog/<?= $item['alias']?>"><?= $item['title']?></a>
    <p>
        <?= $item['description']?>
    </p>
</li>
<?php endforeach;?>
</ul>

