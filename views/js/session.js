(function () {
    setInterval(function () {
        fetch("http://192.168.56.56/session", {
                method: 'POST'
            }
        ).then(response => response.json()).then(data => {
            if (data.status.length > 0) {
                console.log("Logged in")
            }
            else{
                window.location.href = "http://192.168.56.56/login"
            }
        })
    }, 5000)
})()