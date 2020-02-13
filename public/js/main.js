function createCell(id) {
    var title = $('#cell_title').val();
    if (title != ''){
        $.ajax({
            type: 'GET',
            url: '/create-cell',
            data: {id: id, title: title},
            success: function(data){
                if (data.error == null) {
                    location.reload();
                    // var cell = data.data;
                    // $('.card-deck').prepend('<div id="card_'+ cell.id + '" class="col-md-3"><img class="card-img-top" src="/images/cell.jpg" alt="Card image cap"><div class="card-body"><h5 class="card-title">' + cell.title + '</h5><form action="/cell/' + cell.id + '" method="POST"><a class="btn btn-info" href="/cell/' + cell.id + '">Показать</a><div class="btn btn-danger" onclick="destroyItem('+ cell.id +')">Удалить</div></form></div></div>');
                } else {
                    alert(data.error);
                }
            },
            error: function () {
                alert('eerorrooror')
            }
        });
        return false;
    }else{
        $('#cell_title').css({
            border: '1px solid red'
        });
        $('#cell_title').attr("placeholder", "Введите название");
    }
}

