/* Indonesia initialisation for the jQuery UI date picker plugin. */
/* Written by Teguh DC <dheche@gmail.com> */
jQuery(function($){
	$.datepicker.regional['id'] = {clearText: 'Hapus', clearStatus: 'Hapus tanggal sekarang',
		closeText: 'Tutup', closeStatus: 'Tutup tanpa mengubah',
		prevText: '<Sblm', prevStatus: 'Tampilkan bulan sebelumnya',
		nextText: 'Stlh>', nextStatus: 'Tampilkan bulan setelahnya',
		currentText: 'Hari Ini', currentStatus: 'Tampilkan bulan sekarang',
		monthNames: ['Januari','Februari','Maret','April','Mei','Juni',
		'Juli','Agustus','September','Oktober','November','Desember'],
		monthNamesShort: ['Jan','Feb','Mar','Apr','Mei','Jun',
		'Jul','Ags','Sep','Okt','Nov','Dec'],
		monthStatus: 'Tampilkan bulan lainnya', yearStatus: 'Tampilkan tahun lainnya',
		weekHeader: 'Mg', weekStatus: 'Minggu ke',
		dayNames: ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
		dayNamesShort: ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
		dayNamesMin: ['Mi','Sn','Sl','Rb','Km','Jm','Sa'],
		dayStatus: 'Pilih DD sebagai hari pertama', dateStatus: 'Pilih DD, MM d',
		dateFormat: 'dd/mm/yy', firstDay: 0, 
		initStatus: 'Pilih tanggal', isRTL: false};
	$.datepicker.setDefaults($.datepicker.regional['id']); 
});
