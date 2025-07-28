<script>
    fetch("http://localhost/PHP_training/Day10/api/courses.php", {
    method: "GET",
    headers: {
        "Authorization": localStorage.getItem("token")
    }
    });

</script>