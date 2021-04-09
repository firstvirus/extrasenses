<div class="text-center" id="intro">
    <h1>Загадайте любое двухзначное число</h1>
    <button class="btn btn-primary" id="ready">Загадано</button>
</div>
<div class="text-center" id="variants" style="display: none"></div>
<div class="text-center" id="reiting"></div>


<script>
    var wait = false;
    $('#ready').on('click', function(){
        if (!wait) {
            let query = {
                ready: true
            }
            $.ajax({
                url: '\ajaxReady',
                data: query,
                type: 'POST',
                success: function(res) {
                    $('#variants').html(res);
                    $('#variants').show();
                    $('#intro').hide();
                    wait = false;
                }
            });
        }
    });
    $(document).ready(function(){
        $.ajax({
            url: '\ajaxGetAnswer',
            type: 'POST',
            success: function(res) {
                $('#reiting').html(res);
            }
        });
    });
</script>
