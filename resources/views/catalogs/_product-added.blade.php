<script type="text/javascript">
	$(document).ready(function(){
		swal({
			title:"Sukses",
			text: "Berhasil menambah <strong>{{ $product_name }}</strong> ke cart!",
			type: "success",
			showCancelButton: true,
			confirmButtonColor: "#63BC81",
			confirmButtonText: "Konfirmasi pesanan",
			cancelButtonText: "Lanjutkan belanja",
			html: true
		}, function(isConfirm){
			if(isConfirm){
				window.location = '/cart';
			}
		});
	});
</script>