
const getRoles = () => {
    return axios.get(`/api/role`)
                .then(res=>res.data.data)
                .catch(err=>err);
}

const storeRole = (data) => {
    return axios.post(`/api/role`, data)
                .then(res=>res.data.data)
                .catch(err=>err);
}

const deleteRole = (id) => {
    return axios.delete(`/api/role/${id}`)
                .then(res=>res.data.data)
                .catch(err=>err);
}