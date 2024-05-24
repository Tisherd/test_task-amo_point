loginForm.onsubmit = async (e) => {
    e.preventDefault();

    let login = $(loginForm).find('[name="formLogin"]').val();
    let password = $(loginForm).find('[name="formPassword"]').val();

    if (login.trim() == '' && password.trim()== ''){
        alert('Поля должны быть заполнены')
        return;
    }
    
    let response = await fetch('/actions/login', {
        method: 'POST',
        body: JSON.stringify({ 
            login: login,
            password: password
        })
    });

    let result = await response.json();

    if (result.auth_status == 1) {
        window.location.reload();
    } else {
        alert('Неверно');
    }
};

