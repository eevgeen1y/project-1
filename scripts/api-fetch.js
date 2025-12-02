document.addEventListener("DOMContentLoaded", () => {
  const loadUsersBtn = document.getElementById('load-users-btn');
  const usersContainer = document.getElementById('users-container');
  const loadingDiv = document.getElementById('loading');
  const errorDiv = document.getElementById('error-message');

  if (!loadUsersBtn || !usersContainer) return;

  async function fetchRandomUsers(count = 3) {
    try {
      loadingDiv.style.display = 'block';
      errorDiv.style.display = 'none';
      usersContainer.innerHTML = '';

      const response = await fetch(`https://randomuser.me/api/?results=${count}&nat=us,gb,ua`);
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve(data);
        }, 500);
      });
    } catch (error) {
      console.error('Помилка при отриманні даних:', error);
      throw error;
    } finally {
      loadingDiv.style.display = 'none';
    }
  }

  function displayUsers(users) {
    usersContainer.innerHTML = '';
    
    users.forEach(user => {
      const userCard = document.createElement('div');
      userCard.className = 'user-card';
      userCard.style.cssText = `
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin: 15px;
        text-align: center;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: inline-block;
        width: 250px;
        vertical-align: top;
      `;

      const img = document.createElement('img');
      img.src = user.picture.large;
      img.alt = `${user.name.first} ${user.name.last}`;
      img.style.cssText = 'width: 150px; height: 150px; border-radius: 50%; margin-bottom: 15px; border: 3px solid #244992;';

      const name = document.createElement('h3');
      name.textContent = `${user.name.title} ${user.name.first} ${user.name.last}`;
      name.style.cssText = 'margin: 10px 0; color: #244992;';

      const email = document.createElement('p');
      email.textContent = user.email;
      email.style.cssText = 'color: #666; margin: 5px 0;';

      const phone = document.createElement('p');
      phone.textContent = user.phone;
      phone.style.cssText = 'color: #666; margin: 5px 0;';

      const location = document.createElement('p');
      location.textContent = `${user.location.city}, ${user.location.country}`;
      location.style.cssText = 'color: #666; margin: 5px 0; font-size: 0.9em;';

      userCard.appendChild(img);
      userCard.appendChild(name);
      userCard.appendChild(email);
      userCard.appendChild(phone);
      userCard.appendChild(location);

      usersContainer.appendChild(userCard);
    });
  }

  loadUsersBtn.addEventListener('click', async () => {
    try {
      const data = await fetchRandomUsers(6);
      displayUsers(data.results);
    } catch (error) {
      errorDiv.textContent = `Помилка завантаження даних: ${error.message}`;
      errorDiv.style.display = 'block';
      usersContainer.innerHTML = '';
    }
  });

  loadUsersBtn.click();
});

