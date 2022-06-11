(function () {
    document.getElementById('btn-login').addEventListener('click', (event) => {
        event.preventDefault();

        let username = document.getElementsByName('username')[0].value;
        let password = document.getElementsByName('password')[0].value;

        let data = new FormData();
        data.append('username', username);
        data.append('password', password);

        fetch('http://mvc.test/login', {
            method: 'POST',
            body: data
        })
            .then(response => response.json())
            .then(data => localStorage.setItem('key', data.key))
    })
})()