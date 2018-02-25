import * as React from "react";
import SearchBar from "./components/SearchBar";
import Search from "./services/Search";
import Table from "./components/table/Table";
import ProductSorter from "./services/ProductSorter";
import Alert from "./components/Alert";

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
    errorText: string;
}

export default class App extends React.Component<{}, States> {
    constructor(props) {
        super(props);

        this.state = {
            products: [],
            isLoading: true,
            sortDescending: false,
            errorText: '',
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
                //TODO: handle error. Add error text? Use axios for that?
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
                <div className="container-full">
                    <div className="row justify-content-md-center">
                        <div className="col-5">
                            <SearchBar onPress={(keyword) => this.handleOnSearchPress(keyword)}/>

                            {this.state.errorText &&
                                <Alert text={this.state.errorText}/>
                            }
                        </div>
                    </div>
                </div>

                <div className="container">
                    <Table
                        products={this.state.products}
                        sortDescending={this.state.sortDescending}
                        onPricePress={(sort) => this.handleOnPricePress(sort)}
                    />
                </div>
            </div>
        );
    }
}