const getUsers = () => {
    return axios.get('/api/user')
            .then(res => res.data)
            .catch(err => err)
}

const registerUser = (data) => {
    return axios.post('/api/user', data)
            .then(res => res.data)
            .catch(err => err)
}

const deleteUser = (id) => {
    return axios.delete(`/api/user/${id}`)
            .then(res => res.data)
            .catch(err => err)
}

const showUser = (id) => {
    return axios.get(`/api/user/${id}`)
            .then(res => res.data)
            .catch(err => err)
}

const updateUser = (data, id) => {
    return axios.put(`/api/user/${id}`, data)
            .then(res => res.data)
            .catch(err => err)
}