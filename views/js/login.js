(function () {
    document.getElementById('btn-login').addEventListener('click', (event) => {
        event.preventDefault();

        let username = document.getElementsByName('username')[0].value;
        let password = document.getElementsByName('password')[0].value;

        fetch('http://192.168.56.56/login', {
            method: 'POST',
            body: JSON.stringify({
                username,
                password
            }),
        })
            .then(response => response.json())
            .then(data => console.log(data))
    })
})()