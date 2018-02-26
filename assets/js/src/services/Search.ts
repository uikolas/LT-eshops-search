import {Product} from "../App";
import ApiClient from "./ApiClient";
import api from "../api";

class Search {
    public search(keyword: string) {
        return ApiClient.get(api.search(keyword));
    }
}

export default new Search();