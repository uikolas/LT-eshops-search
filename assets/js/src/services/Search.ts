import {Product} from "../App";
import ApiClient from "./ApiClient";

class Search {
    public search(keyword: string) {
        //ApiClient.get('url')
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve(ApiClient.get('url'));
            }, 1000)
        });
    }
}

export default new Search();