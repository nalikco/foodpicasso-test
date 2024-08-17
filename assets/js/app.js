import '../css/app.css';

document.addEventListener("DOMContentLoaded", function () {
    function fetchForm(formId, callback) {
        const form = document.getElementById(formId);
        if (form) {
            const path = form.getAttribute('action');
            const method = form.getAttribute('method');

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const values = {};
                const errors = {};

                for (let i = 0; i < event.currentTarget.elements.length; i++) {
                    if (event.currentTarget.elements[i].tagName === 'INPUT') {
                        const formElement = event.currentTarget.elements[i];
                        const name = formElement.getAttribute('name');

                        values[name] = formElement.value;
                        errors[name] = document.getElementById(`${name}-error`);
                        errors[name].innerHTML = '';
                    }
                }

                const response = await fetch(path, {
                    method,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(values),
                });

                if (response.status === 400) {
                    const jsonErrors = (await response.json()).errors;

                    for (const [key, value] of Object.entries(jsonErrors)) {
                        errors[key].innerHTML = value;
                    }

                    return;
                }

                if (response.status === 401) {
                    for (const [key] of Object.entries(errors)) {
                        errors[key].innerHTML = 'Неверный логин или пароль.';
                        break;
                    }

                    return;
                }

                callback(response);
            });
        }
    }

    fetchForm('register-form', () => {
        window.location.href = '/login';
    });

    fetchForm('login-form', () => {
        window.location.href = '/dashboard';
    });

    fetchForm('logout-form', () => {
        window.location.href = '/login';
    });
});
