<h2>Рейтинг экстрасенсов</h2>
<table class="table table-bordered">
    <tr>
        <?php
        foreach ($extrasenses as $key => $extrasense) { ?>
        <td>Экстрасенс <?= $key ?></td>
        <?php } ?>
    </tr>
    <tr>
        <?php
        foreach ($extrasenses as $extrasense) { ?>
        <td><?= $extrasense ?></td>
        <?php } ?>
    </tr>
</table>

<h2>История вводимых чисел</h2>
<table class="table table-bordered">
    <?php 
    foreach ($history as $value) { ?>
    <tr><td><?= $value ?></td></tr>
    <?php } ?>
</table>
