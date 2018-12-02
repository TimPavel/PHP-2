/*
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

$('#add2Cart').on('click', function () {
	event.preventDefault();

	let id = $(this).val();

	console.log(id);
	$.post(
		"/cart",
		{id: id, quantity: 1},

		function (response, status, jqXHR) {
			console.log(response.result);

			if (response.result == "OK") {
				alert('Товар добавлен в корзину');
			} else {
				alert('Не удалось добавить товар в корзину');
			}
		}
	);
});

