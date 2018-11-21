$(document).ready(function () {
    console.log('Request.js [LOADED]');

    $('#btn-simple').on('click', function () {
        $.get(
            '/ajax.php',
            function (response, status) {
                console.log(status); // success
                console.log(response); // json
            }
        );
    });

    $('#btn-jsonitem').on('click', function () {
        $.get(
            '/ajax.php?action=jsonitem',
            function (response, status) {
                console.log(status);
                console.log(response);
            }
        );
    });

    $('#btn-post-simple').on('click', function () {
        $.post(
            '/ajax.php?action=input',
            {message: 'hello-from-ajax!'},
            function (response, status) {
                console.log(status);
                console.log(response);
            }
        );
    });

    $('#btn-post-jsonitem').on('click', function () {
        let user = {
            login: 'John',
            password: '123123'
        };

        $.post(
            '/ajax.php?action=object',
            {user: user},
            function (response, status) {
                console.log(status);
                console.log(response);
            }
        );
    });

	$('#submitForm').on('click', function() {
		let good = {
			name: $('#inputName').val(),
			description: $('#inputDescr').val(),
			price: $('#inputPrice').val(),
			quantity: $('#inputQuant').val(),
			catItem: $('#selectCat').val()
		};

		$.post(
			'/shop/addToCat.php?action=AddItem',
			{good: good},
			function (response, status) {
				  if(status == 'success') {
						alert('Товар добавлен');
          }
				  console.log(response);
			}
		);
	});

	// добавление товаров в базу
	$('#btn-add2db').on('click', function () {
		console.log(123);

		$.get(
			'/ajax.php?action=AddProductToDB',

		);
	});

	let num = 24;
// нажатие на кнопку "Еще 25 товаров"
	$('#btn-moreGoods').on('click', function () {
		// создаем ajax  запрос на catalog.php
		$.ajax({
			url: "catalog.php",
			type: "GET",
			data: {
				"action": "MoreGoods",
				"num": num
			},
			success: function(response) {
				if (response == 0) {
					alert("Больше нет записей");
				} else {
					// цикл чтобы заапендить
					$.each(response, function (index, value) {
						$('<div>',{
							class: 'card',
							css: {
								width: '250px',
								margin: '0 10px 20px 0',
							},
							append: $('<img>', {
								class: 'card-img-top',
								src: "/img/product.jpg",
								alt: "Image",})
								.add($('<div>',{
									class: 'card-body',
									  append: $('<h5>', {
											className: 'card-title',
											text: value.name,
										})
											.add($('<p>',{
												class: 'card-text',
												text: value.description,
											}))
											.add($('<a>',{
												href: '#',
												class: 'btn btn-primary',
												text: 'Link',
											}))
									}))
						}).appendTo('#content');
					});
					num = num + 25;
				}
			}
		});
	});
});







