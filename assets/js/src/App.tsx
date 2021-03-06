import * as React from "react";
import SearchBar from "./components/SearchBar";
import Search from "./services/Search";
import Table from "./components/Table";
import ProductSorter from "./services/ProductSorter";
import Alert from "./components/Alert";
import Loading from "./components/Loading";

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
    total: number;
    isLoading: boolean;
    sortDescending: boolean;
    errorText: string;
}

export default class App extends React.Component<{}, States> {
    constructor(props) {
        super(props);

        this.state = {
            products: [],
            total: 0,
            isLoading: false,
            sortDescending: false,
            errorText: '',
        };
    }

    private handleOnSearchPress(keyword: string) {
        this.setState({
            isLoading: true,
            errorText: '',
        });

        Search
            .search(keyword)
            .then((response: Response) => {
                this.setState({
                    isLoading: false,
                    products: response.data,
                    total: response.total,
                    errorText: response.total === 0 ? 'No results.' : '',
                });
            })
            .catch((error) => {
                this.setState({
                    isLoading: false,
                    errorText: error.response ? error.response.data : error.message,
                })
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
                        <div className="col-sm-6">
                            <SearchBar
                                onPress={(keyword) => this.handleOnSearchPress(keyword)}
                                disabled={this.state.isLoading}
                            />

                            {this.state.isLoading &&
                                <Loading/>
                            }

                            {this.state.errorText &&
                                <Alert text={this.state.errorText}/>
                            }
                        </div>
                    </div>
                </div>

                <div className="container mt-2">
                    <h2>Total found: {this.state.total}</h2>
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