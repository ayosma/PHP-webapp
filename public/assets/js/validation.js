// public/assets/js/validation.js
function validateLoginForm() {
    const username = document.querySelector('input[name="username"]').value;
    const password = document.querySelector('input[name="password"]').value;
    
    if (username.length < 3) {
        alert('Username must be at least 3 characters long');
        return false;
    }
    
    if (password.length < 6) {
        alert('Password must be at least 6 characters long');
        return false;
    }
    
    return true;
}

function validateItemForm() {
    const name = document.querySelector('input[name="name"]').value;
    const description = document.querySelector('textarea[name="description"]').value;
    
    if (name.length < 3) {
        alert('Item name must be at least 3 characters long');
        return false;
    }
    
    if (description.length > 500) {
        alert('Description cannot be longer than 500 characters');
        return false;
    }
    
    return true;
}