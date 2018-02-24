import {Product} from "../App";

class ProductSorter {
    public sort(products: Product[], sort: boolean) {
        return products.sort((a, b) => {
            return sort ? parseFloat(b.price) - parseFloat(a.price) : parseFloat(a.price) - parseFloat(b.price);
        });
    }
}

export default new ProductSorter();