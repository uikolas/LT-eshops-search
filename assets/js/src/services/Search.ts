import {Product} from "../App";
import ApiClient from "./ApiClient";

class Search {
    public search(keyword: string) {
        //ApiClient.get('url')
        return new Promise((resolve, reject) => {
            resolve(ApiClient.get('url'));
        });
    }
}

export default new Search();