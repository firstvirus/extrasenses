<h2>Варианты экстрасенсов</h2>
<table class="table table-bordered">
    <tr>
        <?php
        foreach ($variants as $key => $variant) { ?>
        <td>Экстрасенс <?= $key ?></td>
        <?php } ?>
    </tr>
    <tr>
        <?php
        foreach ($variants as $variant) { ?>
        <td><?= $variant ?></td>
        <?php } ?>
    </tr>
</table>
<div id="UserVariantBlock" class="col-md-4 align-self-center">
    <label for="UserVariant" class="form-label">Ваш вариант</label>
    <input type="text" class="form-control mb-3 " name="UserVariant" id="UserVariant">
    <button id="send" class="btn btn-primary">Отправить</button>
</div>

<script>
    $('#send').on('click', function(){
        let answer = $('#UserVariant').val();
        $.ajax({
            url: '\ajaxGetAnswer',
            data: {'answer' : answer},
            type: 'POST',
            success: function(res) {
                switch (res) {
                    case 'error_0' : break;
                    case 'error_1' :
                        console.log('error_1');
                        $('#UserVariantBlock').append('<p style="color:red">Число должно быть положительным и двузначным!</p>');
                        break;
                    default : 
                        $('#reiting').html(res);
                        $('#variants').hide();
                        $('#intro').show();
                        break;
                }
            }
        });
    });
</script>
