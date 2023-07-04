
        // Start the timer on page load or when the user logs in
        window.onload = function() {
            startTimer();
        };

        // Variables for idle timeout
        var timer;
        var idleTimeout = 0.1 * 60 * 1000; // 30 minutes (in milliseconds)

        // Function to reset the timer
        function resetTimer() {
            clearTimeout(timer);
            startTimer();
        }

        // Function to start the timer
        function startTimer() {
            timer = setTimeout(logout, idleTimeout);
        }

        // Function to perform logout
        function logout() {
            alert("Inactivity detected. System is logging out.");
            window.location.href = "destroy_session.php";
        }

        // Event listeners to reset the timer on user activity
        window.addEventListener("mousemove", resetTimer);
        window.addEventListener("keydown", resetTimer);
