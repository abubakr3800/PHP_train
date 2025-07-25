<script>
    if (!localStorage.getItem("token")) {
        alert("🔒 Please login to access this page");
        window.location.href = "login.html";
    }
</script>
<script>
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? decodeURIComponent(match[2]) : null;
    }
    if (!getCookie("token")) {
        alert("❌ Access Denied. Please login first.");
        window.location.href = "login.html";
    }
</script>
