/**
 * Script to setup the contacts DataTable
 */
$(document).ready( function () {
	$('#contacts-table').DataTable({
		lengthMenu: [1, 2, 5, 10],
		scrollY: 200,
		scrollCollapse: true,
		columnDefs: [
			{orderable: false , targets: 5}
		]
	});
} );