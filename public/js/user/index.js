// global state
let update = false;

// elemen button
const addButton = document.getElementById('add-button');
const cancelButton = document.getElementById('cancel-button');

// elemen card
const index = document.getElementById('index');
const register = document.getElementById('register');
const headerFormCard = document.getElementById('header-form-card');

// elemen form input
const idUser = document.getElementById('id-user');
const nama = document.getElementById('nama');
const validasiNama = document.getElementById('validasi-nama');

const email = document.getElementById('email');
const validasiEmail = document.getElementById('validasi-email');

const password = document.getElementById('password');
const validasiPassword = document.getElementById('validasi-password');

const submitForm = document.getElementById('submit-form');

// modal delete
const idDeleteUser = document.getElementById('id-user-delete');
const confirmModal = document.getElementById('confirm-modal');

const reset = () => {
    $('#table-body').empty();

    nama.value = '';
    email.value = '';
    password.value = 'blackcherry2020'
}

const showData = (data) => {
    let i = 1;

    data.length > 0 && 
    data.map(data => {
        $('#table-body')
        .append(`<tr>
                    <td>${i++}</td>
                    <td>${data.name}</td>
                    <td>${data.email}</td>
                    <td>
                        <button onclick="deleteUserButton(${data.id})" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal">
                            hapus
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="showUserButton(${data.id})">
                            edit
                        </button>
                    </td>
                </tr>`);
    })
}

const deleteUserButton = (id) => {
    idDeleteUser.value = id;
}

const showUserButton = async (id) => {
    index.classList.add('d-none');
    register.classList.remove('d-none');
    headerFormCard.innerText = "Ubah Pengguna";
    update = true;
    let result = await showUser(id);
    let data = result.data;

    idUser.value = data.id;
    nama.value = data.name;
    email.value = data.email;
    password.value = 'blackcherry2020';
    console.log(result);
}

window.addEventListener('load', async function(){
    let results = await getUsers();
    let users = results.data;
    reset();
    showData(users);
})

addButton.addEventListener('click', function(){
    index.classList.add('d-none');
    register.classList.remove('d-none');
    headerFormCard.innerText = "Tambah Pengguna";
    update = false;
})

cancelButton.addEventListener('click', function(){
    index.classList.remove('d-none');
    register.classList.add('d-none');
    validasiNama.classList.add('d-none');
    validasiEmail.classList.add('d-none');
})

submitForm.addEventListener('click', async function(){
    let data = {
        nama: nama.value,
        email: email.value,
        password: password.value
    }

    if (update) {
        let results = await updateUser(data, idUser.value);

        // cek error 
        if (results.response) {
            results.response.data.errors.nama 
            ? validasiNama.classList.remove('d-none')
            : validasiNama.classList.add('d-none');

            results.response.data.errors.email 
            ? validasiEmail.classList.remove('d-none')
            : validasiEmail.classList.add('d-none');

            results.response.data.errors.password 
            ? validasiPassword.classList.remove('d-none')
            : validasiPassword.classList.add('d-none');
        } else {
            let users = results.data;
            reset();
            showData(users);
            index.classList.remove('d-none');
            register.classList.add('d-none');
        }
    } else {
        let results = await registerUser(data);    

        // cek error 
        if (results.response) {
            results.response.data.errors.nama 
            ? validasiNama.classList.remove('d-none')
            : validasiNama.classList.add('d-none');

            results.response.data.errors.email 
            ? validasiEmail.classList.remove('d-none')
            : validasiEmail.classList.add('d-none');

            results.response.data.errors.password 
            ? validasiPassword.classList.remove('d-none')
            : validasiPassword.classList.add('d-none');
        } else {
            let users = results.data;
            reset();
            showData(users);
            index.classList.remove('d-none');
            register.classList.add('d-none');
        }
    }

    

})

confirmModal.addEventListener('click', async function(){
    let results = await deleteUser(idDeleteUser.value);

    let users = results.data;
    reset();
    showData(users);
    $('#deleteConfirmationModal').modal('toggle');

})



