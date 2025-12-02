document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.querySelector('form[action="https://uk.wikipedia.org"]');
  const usernameInput = document.querySelector('input[name="username"]');
  const emailInput = document.querySelector('input[name="email"]');
  const phoneInput = document.querySelector('input[name="phone"]');

  if (!loginForm) return;

  const loginRegex = /^[a-zA-Z0-9_]{3,20}$/;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const phoneRegex = /^(\+38)?0\d{9}$/;

  function validateLogin(value) {
    if (!value) return { valid: false, message: "Логін не може бути порожнім" };
    const match = value.match(loginRegex);
    if (!match) {
      return { valid: false, message: "Логін має містити 3-20 символів (латиниця, цифри, _)" };
    }
    return { valid: true, message: "" };
  }

  function validateEmail(value) {
    if (!value) return { valid: false, message: "Email не може бути порожнім" };
    const search = emailRegex.test(value);
    if (!search) {
      return { valid: false, message: "Невірний формат email" };
    }
    return { valid: true, message: "" };
  }

  function validatePhone(value) {
    if (!value) return { valid: false, message: "Телефон не може бути порожнім" };
    const match = value.match(phoneRegex);
    if (!match) {
      return { valid: false, message: "Телефон має бути у форматі: +380XXXXXXXXX або 0XXXXXXXXX" };
    }
    return { valid: true, message: "" };
  }

  function showError(input, message) {
    let errorDiv = input.parentElement.querySelector('.error-message');
    if (!errorDiv) {
      errorDiv = document.createElement('div');
      errorDiv.className = 'error-message';
      errorDiv.style.color = 'red';
      errorDiv.style.fontSize = '0.875rem';
      errorDiv.style.marginTop = '0.25rem';
      input.parentElement.appendChild(errorDiv);
    }
    errorDiv.textContent = message;
    input.style.borderColor = 'red';
  }

  function clearError(input) {
    const errorDiv = input.parentElement.querySelector('.error-message');
    if (errorDiv) {
      errorDiv.remove();
    }
    input.style.borderColor = '';
  }

  if (usernameInput) {
    usernameInput.addEventListener('blur', () => {
      const value = usernameInput.value.trim();
      const result = validateLogin(value);
      if (!result.valid) {
        showError(usernameInput, result.message);
      } else {
        clearError(usernameInput);
      }
    });

    usernameInput.addEventListener('input', () => {
      let value = usernameInput.value;
      value = value.replace(/\s+/g, '');
      value = value.replace(/[^a-zA-Z0-9_]/g, '');
      value = value.replace(/_{2,}/g, '_');
      if (usernameInput.value !== value) {
        usernameInput.value = value;
      }
    });
  }

  if (emailInput) {
    emailInput.addEventListener('blur', () => {
      const value = emailInput.value.trim();
      const result = validateEmail(value);
      if (!result.valid) {
        showError(emailInput, result.message);
      } else {
        clearError(emailInput);
      }
    });
  }

  if (phoneInput) {
    phoneInput.addEventListener('blur', () => {
      const value = phoneInput.value.trim();
      const result = validatePhone(value);
      if (!result.valid) {
        showError(phoneInput, result.message);
      } else {
        clearError(phoneInput);
      }
    });
  }

  loginForm.addEventListener('submit', (e) => {
    let isValid = true;

    if (usernameInput) {
      const loginValue = usernameInput.value.trim();
      const loginResult = validateLogin(loginValue);
      if (!loginResult.valid) {
        showError(usernameInput, loginResult.message);
        isValid = false;
      }
    }

    if (emailInput) {
      const emailValue = emailInput.value.trim();
      const emailResult = validateEmail(emailValue);
      if (!emailResult.valid) {
        showError(emailInput, emailResult.message);
        isValid = false;
      }
    }

    if (phoneInput) {
      const phoneValue = phoneInput.value.trim();
      const phoneResult = validatePhone(phoneValue);
      if (!phoneResult.valid) {
        showError(phoneInput, phoneResult.message);
        isValid = false;
      }
    }

    if (!isValid) {
      e.preventDefault();
    }
  });
});

