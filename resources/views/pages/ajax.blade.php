<div class="boxed sticky push-down-30">
    <div class="row">
        <div class="col-xs-10  col-xs-offset-1">
            <div class="widget-author__content">
                <form action="" method="POST" id="ajaxForm">
                    {{ csrf_field() }}
                    Name: <input name="name" type="text"><br>
                    Surname: <input name="surname" type="text"><br>
                    Age: <input name="age" type="text"><br>
                    <button type="submit">Send</button>
                </form>
                <div id="ajaxContent"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#ajaxForm').on('submit', function (e) {
            var name = $('[name="name"]').val(),
                surname = $('[name="surname"]').val(),
                age = $('[name="age"]').val();

            e.stopPropagation();
            e.preventDefault();

            var postPromise = $.post('/ajax', {
                name: name,
                surname: surname,
                age: age
            });

            postPromise.then(function(data) {
                $('#ajaxContent').html(data);
            }, function (error) {
                $('#ajaxContent').html('<h3 style="color: red">Error fetching data from server with code: ' + error.status + '</h3>');
            });
        });
    });
</script>