// elemen card 
const index = document.getElementById('index');
const setRole = document.getElementById('set-role');

// elemen button
const cancelButton = document.getElementById('cancel-button');

// elemen form 
const formInput = document.getElementById('form-input');
const userId = document.getElementById('user-id');
const nama = document.getElementById('nama');
const role = document.getElementById('role');

const showUsersRole = async () => {
    let results = await getUsersRole();

    $("#table-body").empty();

    let i =  1;
    results.length && results.map(result => {
        let role = result.role[0] ? result.role[0] : '';
        $("#table-body")
        .append(`<tr>
                    <td>${i++}</td>
                    <td>${result.userName}</td>
                    <td>${role}</td>
                    <td>
                        <button class="btn btn-secondary btn-sm" onclick="showUserRole(${result.userId})">
                            ubah role
                        </button>
                    </td>
                </tr>`)
    })
}

const showUserRole = async (id) => {
    result = await getUserRole(id);
    index.classList.add('d-none');
    setRole.classList.remove('d-none');
    
    let roles = await getRoles();
    $('#role').empty();
    roles.length > 0  
    && roles.map(role => $('#role').append(`<option value="${role.name}">${role.name}</option>`))

    userId.value = result.userId;
    nama.value = result.userName;
    role.value = result.role[0];
}

window.addEventListener('load', function(){
    showUsersRole();
})

cancelButton.addEventListener('click', function(){
    index.classList.remove('d-none');
    setRole.classList.add('d-none');
})

formInput.addEventListener('submit', async function(e){
    e.preventDefault();
    let data = {
        role: role.value
    }

    await setUserRole(userId.value, data);
    index.classList.remove('d-none');
    setRole.classList.add('d-none');
    showUsersRole();
})