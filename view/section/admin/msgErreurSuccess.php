<?php if(isset($_GET['error']) && $_GET['error'] = 1 && isset($_GET['message']) && isset($_GET['title'])):?>
		<script>
			Swal.fire({
				title: '<?= htmlspecialchars($_GET['title']) ?>',
				text: '<?= htmlspecialchars($_GET['message']) ?>',
				icon: "error",
				timer: 3000,
				timerProgressBar: true,
    		})
		</script>
	<?php endif;?>

	<!-- ================== Message Success =============== -->
	<?php if(isset($_GET['success']) && $_GET['success'] = 1 && isset($_GET['message']) && isset($_GET['title'])):?>
		<script>
			Swal.fire({
				title: '<?= htmlspecialchars($_GET['title']) ?>',
				text: '<?= htmlspecialchars($_GET['message']) ?>',
				icon: "success",
				timer: 3000,
				timerProgressBar: true,
    		})
		</script>
	<?php endif;?>