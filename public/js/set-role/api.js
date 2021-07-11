
const getUsersRole = () => {
    return axios.get('/api/user-role')
                .then(res=>res.data.data)
                .catch(err=>err)
}

const getUserRole = (id) => {
    return axios.get(`/api/user-role/${id}`)
                .then(res=>res.data.data)
                .catch(err=>err)
}

const setUserRole = (id, data) => {
    return axios.put(`/api/user-role/${id}`, data)
                .then(res=>res.data.data)
                .catch(err=>err)
}