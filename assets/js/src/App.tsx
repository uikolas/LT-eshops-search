import * as React from "react";
import SearchBar from "./components/SearchBar";
import Search from "./services/Search";
import Table from "./components/table/Table";
import ProductSorter from "./services/ProductSorter";

export interface Product {
    name: string;
    image: string;
    price: string;
    url: string;
    shop: string;
}

export interface Response {
    data: Product[];
    total: number;
}

export interface States {
    products: Product[];
    isLoading: boolean;
    sortDescending: boolean;
}

export default class App extends React.Component<{}, States> {
    constructor(props) {
        super(props);

        this.state = {
            products: [],
            isLoading: true,
            sortDescending: false,
        };
    }

    private handleOnSearchPress(keyword: string) {
        Search
            .search(keyword)
            .then((response: Response) => {
                this.setState({
                    products: response.data
                });
            })
            .catch((error) => {
                //TODO: handle error
            });
    }

    private handleOnPricePress(sort: boolean) {
        this.setState({
            products: ProductSorter.sort(this.state.products, sort),
            sortDescending: sort,
        });
    }

    public render() {
        return (
            <div>
                <SearchBar onPress={(keyword) => this.handleOnSearchPress(keyword)}/>

                <Table
                    products={this.state.products}
                    sortDescending={this.state.sortDescending}
                    onPricePress={(sort) => this.handleOnPricePress(sort)}
                />
            </div>
        );
    }
}