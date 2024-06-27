<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .board {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .board-header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .add-user-btn {
            background-color: white;
            color: #4CAF50;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .user-list {
            padding: 20px;
        }
        .user-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideDown 0.3s ease-out;
            transition: all 0.2s ease-out;
            max-height: 100px;
            opacity: 1;
        }
        .user-card.deleting {
            max-height: 0;
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
            margin-bottom: 0;
            border: none;
        }
        .user-info {
            flex-grow: 1;
        }
        .user-info span {
            display: inline-block;
            min-width: 100px;
            padding: 5px;
            cursor: pointer;
        }
        .user-info input {
            font-size: 1em;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .user-actions {
            display: flex;
            gap: 5px;
        }
        .user-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #f44336;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .edit-container {
            display: flex;
            align-items: center;
        }
        .edit-container input {
            flex-grow: 1;
            margin-right: 5px;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-left: 2px;
        }
        .edit-btn.cancel {
            background-color: #f44336;
        }
    </style>
</head>
<body>
<div class="board">
    <div class="board-header">
        <h2>Список пользователей</h2>
        <button class="add-user-btn" onclick="addUser()">Добавить пользователя</button>
    </div>
    <div class="user-list" id="userList"></div>
</div>

<script>
    let users = [];

    async function fetchUsers() {
        try {
            const response = await fetch('/api/user/list');
            users = await response.json();
            renderUsers();
        } catch (error) {
            console.error('Ошибка при загрузке пользователей:', error);
        }
    }

    function renderUsers() {
        const userList = document.getElementById('userList');
        const currentCards = userList.querySelectorAll('.user-card');
        const currentIds = new Set(Array.from(currentCards).map(card => card.dataset.id));

        users.forEach((user) => {
            if (!currentIds.has(user.id.toString())) {
                const userElement = createUserElement(user);
                userList.appendChild(userElement);
            } else {
                const existingCard = userList.querySelector(`.user-card[data-id="${user.id}"]`);
                existingCard.querySelector('.user-info').innerHTML = `
                        <span onclick="editField(this, ${user.id}, 'username')">${user.username}</span><br>
                        <span onclick="editField(this, ${user.id}, 'email')">${user.email}</span>
                    `;
            }
        });

        // Удаляем карточки пользователей, которых больше нет в списке
        currentCards.forEach(card => {
            if (!users.some(user => user.id.toString() === card.dataset.id)) {
                card.remove();
            }
        });
    }

    async function addUser() {
        try {
            const response = await fetch('/api/user/new', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({})  // Пустой объект, так как данные генерируются на сервере
            });
            const newUser = await response.json();
            users.push(newUser);
            renderUsers();
        } catch (error) {
            console.error('Ошибка при добавлении пользователя:', error);
        }
    }

    async function deleteUser(id) {
        try {
            const response = await fetch(`/api/user/${id}`, {
                method: 'DELETE'
            });
            if (response.ok) {
                const userElement = document.querySelector(`.user-card[data-id="${id}"]`);
                userElement.classList.add('deleting');
                await new Promise(resolve => setTimeout(resolve, 300)); // Ждем завершения анимации
                users = users.filter(user => user.id !== id);
                renderUsers();
            }
        } catch (error) {
            console.error('Ошибка при удалении пользователя:', error);
        }
    }

    function createUserElement(user) {
        const userElement = document.createElement('div');
        userElement.className = 'user-card';
        userElement.dataset.id = user.id;
        userElement.innerHTML = `
                <div class="user-info">
                    <span onclick="editField(this, ${user.id}, 'username')">${user.username}</span><br>
                    <span onclick="editField(this, ${user.id}, 'email')">${user.email}</span>
                </div>
                <div class="user-actions">
                    <button class="user-btn delete-btn" onclick="deleteUser(${user.id})">Удалить</button>
                </div>
            `;
        return userElement;
    }

    function editField(element, userId, field) {
        const currentValue = element.textContent;
        const editContainer = document.createElement('div');
        editContainer.className = 'edit-container';

        const input = document.createElement('input');
        input.value = currentValue;
        // stop click propagation
        input.onclick = (e) => e.stopPropagation();

        const confirmBtn = document.createElement('button');
        confirmBtn.className = 'edit-btn';
        confirmBtn.innerHTML = '✓';
        confirmBtn.onclick = (e) => {
            e.stopPropagation();
            confirmEdit(element, userId, field, input.value);
        };

        const cancelBtn = document.createElement('button');
        cancelBtn.className = 'edit-btn cancel';
        cancelBtn.innerHTML = '✕';
        cancelBtn.onclick = (e) => {
            e.stopPropagation();
            cancelEdit(element, currentValue);
        };

        editContainer.appendChild(input);
        editContainer.appendChild(confirmBtn);
        editContainer.appendChild(cancelBtn);

        element.textContent = '';
        element.appendChild(editContainer);
        input.focus();

        input.onkeydown = (e) => {
            if (e.key === 'Enter') {
                confirmEdit(element, userId, field, input.value);
            } else if (e.key === 'Escape') {
                cancelEdit(element, currentValue);
            }
        };
    }

    async function confirmEdit(element, userId, field, newValue) {
        try {
            const response = await fetch('/api/user/edit', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id: userId, [field]: newValue})
            });
            const updatedUser = await response.json();
            const index = users.findIndex(u => u.id === userId);
            users[index] = updatedUser;
            renderUsers();
        } catch (error) {
            console.error('Ошибка при редактировании пользователя:', error);
            cancelEdit(element, newValue);
        }
    }

    function cancelEdit(element, originalValue) {
        element.textContent = originalValue;
    }

    // Загрузка пользователей при инициализации
    fetchUsers();
</script>
</body>
</html>
