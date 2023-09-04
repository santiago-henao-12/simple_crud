/**
 * Script to setup the contact page
 */

// Callback for ajax requets
function ajaxHandler(event) {
	// Searchs for the spinner
	const spinner = $('.spinner');
	const loadingMask = $('.loading-mask')
	spinner.show();
	loadingMask.show();
	fetch('export', {
		method: 'GET',
		headers: {
			Accept: this.dataset.format
		}
	}).then(async (response) => {
		if (response.status == 200) {
			// Parses the downloaded data
			this.fileName = /filename=\"(.+)\"/.exec(response.headers.get('Content-Disposition'))[1];
			return response.arrayBuffer();
		} else {
			spinner.hide();
			loadingMask.hide();
		}
	}).then((data) => {
		// Creates a blob with the data to download it
		const blob = new Blob([data], { type: `${this.dataset.format}; charset=UTF-8`});
		const url = window.URL.createObjectURL(blob);
		// Uses a virtual element to download the data
		const link = document.createElement("a");
		link.download = this.fileName;
		link.href = url;
		link.dispatchEvent(new MouseEvent('click'));
		window.URL.revokeObjectURL(url);

		spinner.hide();
		loadingMask.hide();
	}).catch((error) => {
		console.error('Error: ', error);
		spinner.hide();
		loadingMask.hide();
	})
}

/* // Clamps a value
function clamp(value, min, max) {
	if (isFinite(value)) {
		return value; // Value is finite, return it as-is
	}

	return Math.min(Math.max(value, min), max);
} */

/* // Transform string to array buffer
function str2ab(str) {
    var buf = new ArrayBuffer(str.length*2); // 2 bytes for each char
    var bufView = new Uint16Array(buf);
    for (var i=0, strLen=str.length; i < strLen; i++) {
    bufView[i] = str.charCodeAt(i);
    }
    return buf;
} */

$(document).ready(function () {
	// Set up of the datatable
	$('#contacts-table').DataTable({
		responsive: {
			details: {
				type: 'column'
			}
		},
		lengthMenu: [1, 2, 5, 10],
		scrollY: 300,
		scrollCollapse: true,
		columnDefs: [
			{orderable: false , targets: 5}
		]
	});

	// Set up for the export buttons
	$('.export-button-wrapper').on('click', 'button', ajaxHandler);
});