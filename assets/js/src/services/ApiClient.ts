import axios from "axios"

class ApiClient {
    public get(url) {
        return axios.get(url).then((response) => response.data);
    }
}

export default new ApiClient();