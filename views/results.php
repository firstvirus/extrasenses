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

<h2>История вводимых чисел и ответов экстрасенсов</h2>
<table class="table table-bordered">
    <th>Ваши числа</th>
    <?php 
    for($i = 1; $i <= 16; $i++) {
        echo '<th>Экстрасенс ' . $i . '</th>';
    }
    ?>
    <?php 
    foreach ($history as $row) { ?>
    <tr>
        <?php foreach ($row as $cell) { ?>
        <td><?= $cell ?></td>
        <?php } ?>
    </tr>
    <?php } ?>
</table>
