// elemen button
const addButton = document.getElementById('add-button');
const cancelButton = document.getElementById('cancel-button');

// elemen card
const index = document.getElementById('index');
const createRole = document.getElementById('create-role');

// form input
const formInput = document.getElementById('form-input');
const name = document.getElementById('nama');
const validasiNama = document.getElementById('validasi-nama');

// modal
const idRoleDelete = document.getElementById('id-role-delete');
const confirmModal = document.getElementById('confirm-modal');

const showRole = async () => {
    results = await getRoles();

    $('#table-body').empty();

    let i = 1;
    results.length > 0 
    && results.map(result => {
        $('#table-body')
        .append(`<tr>
                    <td>${i++}</td>
                    <td>${result.name}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal" onClick="hapusData(${result.id})">hapus</button>
                    </td>
                </tr>`)
    })

    console.log(results);
}

const hapusData = (id) => {
    idRoleDelete.value = id;
}

window.addEventListener('load', function(){
    showRole();
});

addButton.addEventListener('click', function(){
    index.classList.add('d-none');
    createRole.classList.remove('d-none');
})

cancelButton.addEventListener('click', function(){
    index.classList.remove('d-none');
    createRole.classList.add('d-none');
})

formInput.addEventListener('submit', async function(e){
    e.preventDefault();
    let data = {
        name: nama.value
    }

    let results = await storeRole(data);

    if (results.response) {
        results.response.data.errors.name 
            ? validasiNama.classList.remove('d-none')
            : validasiNama.classList.add('d-none');
    } else {
        showRole();
        index.classList.remove('d-none');
        createRole.classList.add('d-none');
    }
})

confirmModal.addEventListener('click', async function(){
    await deleteRole(idRoleDelete.value);
    showRole();
    $('#deleteConfirmationModal').modal('toggle');
})

