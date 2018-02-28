import * as React from "react";
import {Product} from "../App";
import TableRow from "./TableRow";
import Card from "./Card";

export interface Props {
    products: Product[];
    onPricePress(sort: boolean): void;
    sortDescending: boolean;
}

export interface States {
    //sortDescending: boolean;
}

export default class Table extends React.Component<Props, States> {
    constructor(props: Props) {
        super(props);

        /*this.state = {
            sortDescending: false
        };*/
    }

    private handleOnPriceClick() {
        this.props.onPricePress(!this.props.sortDescending);
    }

    public render() {
        const products = this.props.products;
        const sortIcon = this.props.sortDescending ? <i className="fas fa-chevron-down"></i> : <i className="fas fa-chevron-up"></i>;

        return (
            <Card>
                <div id="table">
                    <table className="table table-striped">
                        <thead>
                        <tr>
                            <th className="image-width">Image</th>
                            <th className="name">Name</th>
                            <th className="price">
                                <a href="#" onClick={() => this.handleOnPriceClick()}>
                                    Price {sortIcon}
                                </a>
                            </th>
                            <th className="shop">Shop</th>
                        </tr>
                        </thead>
                        <tbody>
                        {products.map((product, index) => {
                            return <TableRow product={product} key={index}/>
                        })}
                        </tbody>
                    </table>
                </div>
            </Card>
        );
    }
}