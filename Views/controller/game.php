<?php if ($data):?>
<ul>
        <?php foreach ($data as $beeName => $healthArray):?>
            <?php foreach ($healthArray as $health) :?>
                <li>
                    <?php echo $beeName. '- health : ' . $health?>
                </li>
            <?php endforeach;?>
        <?php endforeach;?>
</ul>
<form action="index.php" method="post">
    <input type="hidden" name="hit" value="hit"/>
    <input type="submit" value="Hit random bee"/>
</form>
<?php else: ?>
    <h2>You have killed all bees. <a href="index.php"> Press link to start new game.</a></h2>
<?php endif;?>